@if (auth()->user()->role == 'customer')
    @extends('layouts.home')
@else
    @extends('layouts.admin')
@endif

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Chat list sidebar -->
            <div class="col-md-4 col-lg-3 chat-sidebar">
                @yield('chat_list')
            </div>

            <!-- Chat messages -->
            <div class="col-md-8 col-lg-9 chat-messages">
                @yield('chat_messages')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Pusher configuration
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        const channel = pusher.subscribe('chat');
        channel.bind('new-message', function(data) {
            // Handle new message
            appendMessage(data.message);
        });

        function appendMessage(message) {
            // Append new message to the chat
            const chatMessages = document.querySelector('#chat-messages');
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', message.sender_id === {{ auth()->id() }} ? 'message-out' :
                'message-in');
            messageElement.innerHTML = `
                <div class="message-body">
                    <div class="message-content">
                        <p>${message.message}</p>
                    </div>
                    <div class="message-meta">
                        <span class="time">${message.created_at}</span>
                    </div>
                </div>
            `;
            chatMessages.appendChild(messageElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
@endsection
