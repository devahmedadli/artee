<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Chat;
use App\Models\User;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['chat', 'sender', 'receiver'])->get();
        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $chats = Chat::all();
        $users = User::all();
        return view('messages.create', compact('chats', 'users'));
    }

    public function store(StoreMessageRequest $request)
    {
        $message = Message::create($request->validated());
        return to_route('messages.index')->with('success', 'Message sent successfully.');
    }

    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    public function edit(Message $message)
    {
        $chats = Chat::all();
        $users = User::all();
        return view('messages.edit', compact('message', 'chats', 'users'));
    }

    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->validated());
        return to_route('messages.index')->with('success', 'Message updated successfully.');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return to_route('messages.index')->with('success', 'Message deleted successfully.');
    }
}