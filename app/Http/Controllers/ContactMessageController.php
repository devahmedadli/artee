<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Requests\SendMessageRequest;
use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Requests\UpdateContactMessageRequest;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactMessages = ContactMessage::latest()->paginate(10);
        return view('admin.contact-messages.index', compact('contactMessages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact-messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());
        flash()->success(__('Message sent successfully!'));
        return to_route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        return view('contact-messages.show', compact('contactMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactMessage $contactMessage)
    {
        return view('contact-messages.edit', compact('contactMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactMessageRequest $request, ContactMessage $contactMessage)
    {
        $contactMessage->update($request->validated());
        flash()->success(__('Message updated successfully!'));
        return to_route('contact-messages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        flash()->success(__('Message deleted successfully!'));
        return to_route('contact-messages.index');
    }

    public function sendMessage(StoreContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());
        flash()->success(__('Message sent successfully!'));
        return to_route('index');
    }
}
