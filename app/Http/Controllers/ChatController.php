<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\Order;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\NewMessageEvent;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use Chatify\Facades\ChatifyMessenger as Chatify;
use App\Notifications\NewMessageNotification;


class ChatController extends Controller
{
    public function index($id = null)
    {
        $messenger_color = Auth::user()->messenger_color;
        $view = Auth::user()->role == 'admin' ? 'admin.chats.chats' : (Auth::user()->role == 'freelancer' ? 'freelancer.chats.chats' : 'customer.chats.chats');
        return view($view, [
            'id' => $id ?? 0,
            'messengerColor' => $messenger_color ? $messenger_color : Chatify::getFallbackColor(),
            'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
        ]);
    }

    public function freelancerIndex()
    {
        $chats = auth()->user()->chats()->with('order')->get();

        return view('freelancer.chats.chats', compact('chats'));
    }

    public function create()
    {
        $orders = Order::all();
        return view('chats.create', compact('orders'));
    }

    public function store(StoreChatRequest $request)
    {
        $chat = Chat::firstOrCreate($request->validated());
        $chat->load('receiver', 'sender');
        // just created or exists
        return response()->json(['success' => $chat->wasRecentlyCreated, 'chat' => $chat]);
    }

    public function show(Order $order)
    {
        $chat = Chat::firstOrCreate(
            [
                'order_id'          => $order->id,
                'freelancer_id'     => auth()->user()->id,
                'customer_id'       => $order->customer_id,
            ]
        );
        $chat->load('messages', 'messages.sender');
        if (auth()->user()->role == 'freelancer') {
            return view('freelancer.chats.show', compact('chat'));
        }
        if (auth()->user()->role == 'customer') {

            return view('customer.chats.show', compact('chat'));
        }
        if (auth()->user()->role == 'admin') {
            return view('admin.chats.show', compact('chat'));
        }
        flash()->error(__('Something went wrong.'));
        return back();
    }

    public function edit(Chat $chat)
    {
        $orders = Order::all();
        return view('chats.edit', compact('chat', 'orders'));
    }


    public function destroy(Chat $chat)
    {
        $chat->delete();
        return to_route('chats.index')->with('success', 'Chat deleted successfully.');
    }


    public function customerChats()
    {
        $chat       = auth()->user()->chat;
        $messages   = $chat->messages;
        return view('customer.chats.chats', compact('messages', 'chat'));
    }

    public function freelancerChats()
    {
        $chat       = auth()->user()->chat;
        $messages   = $chat->messages;
        return view('freelancer.chats.chats', compact('messages', 'chat'));
    }


    /**
     * Get messages for a chat
     * @param Chat $chat
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages(Chat $chat)
    {
        $messages = $chat->messages()->with('sender')->orderBy('created_at', 'asc')->get();
        $messages->each(function ($message) {
            if ($message->sender_id != auth()->id()) {
                $message->read_at = now();
                $message->save();
            }
        });
        return response()->json($messages);
    }

    /**
     * Store a new message
     * @param Request $request
     * @param Chat $chat
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeMessage(Request $request, Chat $chat)
    {
        $sender = auth()->user();
        if (!$sender) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $message = Message::create([
            'chat_id'     => $chat->id,
            'sender_id'   => $sender->id,
            'message'     => $request->message,
        ]);

        // Update the last_message_at field in the chat
        $chat->update(['last_message_at' => now()]);

        // Determine the recipient
        $recipient =  match ($chat->chatable->id) {
            $sender->id => $chat->admin,
            default => $chat->chatable
        };

        // Send notification after a delay if message is not read
        // dispatch(function () use ($message, $recipient) {
        //     // Check if message is still unread after 5 minutes
        //     if (!$message->read_at) {
        //         $recipient->notify(new NewMessageNotification($message));
        //     }
        // })->delay(now()->addMinutes(3));

        // try {
        //     $recipient->notify(new NewMessageNotification($message));
        // } catch (\Exception $e) {
        //     Log::error('Error sending notification: ' . $e->getMessage());
        // }

        // Broadcast the new message event
        broadcast(new NewMessageEvent($message))->toOthers();

        return response()->json(['success' => true, 'message' => $message]);
    }


    /**
     * Get updates for the chat
     * @param Chat $chat
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updates(Chat $chat, Request $request)
    {
        // return response()->json($request->last_message_at);
        $chats = Chat::with('chatable', 'lastMessage')->where('archived', false)->get();

        // Validate and parse the last_message_at parameter
        $lastMessageAt = $request->has('last_message_at')
            ? \Carbon\Carbon::parse($request->last_message_at)
            : now()->subDay(); // Default to 24 hours ago if not provided

        $newMessages = Message::where('created_at', '>', $lastMessageAt)->get();

        return response()->json(['chats' => $chats, 'new_messages' => $newMessages]);
    }

    /**
     * Get new messages for a chat
     * @param Chat $chat
     * @param int $lastMessageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNewMessages(Chat $chat, $lastMessageId)
    {
        $newMessages = $chat->messages()->where('id', '>', $lastMessageId)->get();
        return response()->json($newMessages);
    }
}
