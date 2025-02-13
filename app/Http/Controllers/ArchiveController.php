<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Offer;
use App\Models\Order;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    // display all archived offers
    public function freelancerArchivedOffers()
    {
        $offers = Offer::where('freelancer_archived', true)->get();
        return view('freelancer.offers.archived', compact('offers'));
    }

    // display all archived orders
    public function freelancerArchivedOrders()
    {
        $orders = Order::where('freelancer_archived', true)->get();
        return view('freelancer.orders.archived', compact('orders'));
    }


    // display all admin archived offers
    public function adminArchivedOffers()
    {
        $offers = Offer::where('admin_archived', true)->get();
        return view('admin.offers.archived', compact('offers'));
    }
    // display all admin archived orders
    public function adminArchivedOrders()
    {
        $orders = Order::where('admin_archived', true)->get();
        return view('admin.orders.archived', compact('orders'));
    }
    // display all admin archived chats
    public function adminArchivedChats()
    {
        $chats = Chat::where('archived', true)->get();
        return view('admin.chats.archived', compact('chats'));
    }

    // freelancer archive offer
    public function freelancerArchiveOffer(Offer $offer)
    {
        $offer->update(['freelancer_archived' => true]);
        flash()->success(__('Offer archived successfully'));
        return to_route('freelancer.offers.index');
    }
    // freelancer unarchive offer
    public function freelancerUnarchiveOffer(Offer $offer)
    {
        $offer->update(['freelancer_archived' => false]);
        flash()->success(__('Offer unarchived successfully'));
        return to_route('freelancer.offers.index');
    }
    // freelancer archive order
    public function freelancerArchiveOrder(Order $order)
    {
        $order->update(['freelancer_archived' => true]);
        flash()->success(__('Order archived successfully'));
        return to_route('freelancer.orders.index');
    }
    // freelancer unarchive order
    public function freelancerUnarchiveOrder(Order $order)
    {
        $order->update(['freelancer_archived' => false]);
        flash()->success(__('Order unarchived successfully'));
        return to_route('freelancer.orders.index');
    }

    // admin archive offer
    public function adminArchiveOffer(Offer $offer)
    {
        $offer->update(['admin_archived' => true]);
        flash()->success(__('Offer archived successfully'));
        return to_route('offers.index');
    }
    // admin unarchive offer
    public function adminUnarchiveOffer(Offer $offer)
    {
        $offer->update(['admin_archived' => false]);
        flash()->success(__('Offer unarchived successfully'));
        return to_route('offers.index');
    }
    // admin archive order
    public function adminArchiveOrder(Order $order)
    {
        $order->update(['admin_archived' => true]);
        flash()->success(__('Order archived successfully'));
        return to_route('orders.index');
    }
    // admin unarchive order
    public function adminUnarchiveOrder(Order $order)
    {
        $order->update(['admin_archived' => false]);
        flash()->success(__('Order unarchived successfully'));
        return to_route('orders.index');
    }
    // admin archive chat
    public function adminArchiveChat(Chat $chat)
    {
        $chat->update(['archived' => true]);
        // flash()->success(__('Chat archived successfully'));
        return response()->json(['success' => true]);
    }
    // admin unarchive chat
    public function adminUnarchiveChat(Chat $chat)
    {
        $chat->update(['archived' => false]);
        // flash()->success(__('Chat unarchived successfully'));
        return to_route('chats.index');
    }
}
