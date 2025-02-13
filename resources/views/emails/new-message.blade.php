<x-mail::message>
    # New Message Received

    Hello {{ $user->name }},

    You have received a new message in your chat.

    <x-mail::button :url="route('chat.show', $chat->id)">
        View Message
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
