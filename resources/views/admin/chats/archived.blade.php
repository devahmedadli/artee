@extends('layouts.admin')

@section('title', __('Admin Chats'))

@vite(['resources/js/echo.js', 'resources/js/bootstrap.js'])
@section('content')
    <div class="card p-3">
        <div class="card-body p-0">
            <div class="container-fluid">
                <div class="row">
                    <!-- Chat list sidebar -->
                    <div class="col-md-4 col-lg-3 chat-sidebar mb-3 mb-md-0">
                        <h3>{{ __('All Chats') }}</h3>
                        <ul class="list-group" id="chat-list">
                            @foreach ($chats as $chat)
                                <li class="bg-light px-2 py-3 chat-list-item border-bottom position-relative"
                                    data-chat-id="{{ $chat->id }}">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span>
                                                {{ $chat->chatable->name }}
                                            </span>
                                            <span
                                                class="badge bg-{{ $chat->chatable->role == 'customer' ? 'primary' : 'success' }} capitalize">
                                                {{ __($chat->chatable->role) }}
                                            </span>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-dark" type="button"
                                                id="dropdownMenuButton{{ $chat->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton{{ $chat->id }}">
                                                <li><a class="dropdown-item unarchive-chat" href="#"
                                                        data-chat-id="{{ $chat->id }}">{{ __('Unarchive') }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    @if ($chat->lastMessage)
                                        <p
                                            class="mb-0 {{ $chat->lastMessage->read_at == null && $chat->lastMessage->sender_id != auth()->id() ? 'fw-bold' : '' }}">
                                            {{ Str::limit($chat->lastMessage->message, 30) }}
                                        </p>
                                    @endif
                                    <small
                                        class="text-muted">{{ $chat->lastMessage ? $chat->lastMessage->created_at->diffForHumans() : __('No messages') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Chat messages -->
                    <div class="col-md-8 col-lg-9 chat-messages">
                        <div id="chat-messages" class="chat-container bg-light border">
                            <div class="text-center text-muted d-flex justify-content-center align-items-center"
                                style="height: 100%;">
                                {{ __('Select a chat to view messages.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-styles')
    <style>
        .chat-sidebar {
            height: 300px;
            overflow-y: auto;
        }

        .chat-container {
            height: 400px;
            overflow-y: auto;
            padding: 1rem;
            background-color: #ffffff;
        }

        @media (min-width: 768px) {

            .chat-sidebar,
            .chat-container {
                height: calc(100vh - 200px);
            }
        }

        .chat-list-item.active {
            background-color: #d7eaff !important;
        }

        .message {
            margin-bottom: 1rem;
        }

        .message-in {
            text-align: left;
        }

        .message-out {
            text-align: right;
        }

        .message-content {
            max-width: 70%;
            word-wrap: break-word;
        }

        @media (max-width: 576px) {
            .message-content {
                max-width: 90%;
            }
        }

        .message-in .message-content {
            background-color: #f0f0f0;
        }

        .message-out .message-content {
            background-color: #dcf8c6;
        }
    </style>
@endsection

@section('page-scripts')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentChatId = null;
            const chatMessages = $('#chat-messages');
            const messageForm = $('#message-form');
            const messageInput = $('#message-input');
            const chatList = $('#chat-list');

            function scrollToBottom() {
                const scrollHeight = chatMessages[0].scrollHeight;
                chatMessages.scrollTop(scrollHeight);
            }

            function appendMessage(message) {
                const isOutgoing = message.sender_id == {{ auth()->id() }};
                const messageElement = $('<div>').addClass(
                    `message ${isOutgoing ? 'message-out' : 'message-in'} d-flex ${isOutgoing ? 'justify-content-end' : 'justify-content-start'} mb-2`
                );
                messageElement.html(`
                    <div class="message-body text-${isOutgoing ? 'end' : 'start'}" style="max-width: 70%;">
                        <div class="message-content ${isOutgoing ? 'bg-primary text-white' : 'bg-success-subtle'} rounded p-2">
                            <p class="mb-0">${message.message}</p>
                        </div>
                        <div class="message-meta text-${isOutgoing ? 'light' : 'muted'} small">
                            <span class="time text-muted" style="font-size: 12px;">${moment(message.created_at).format('LLL')}</span>
                        </div>
                    </div>
                `);
                chatMessages.append(messageElement);
                scrollToBottom();
            }

            function updateChatListItem(chatId, lastMessage) {
                const chatItem = chatList.find(`[data-chat-id="${chatId}"]`);
                if (chatItem.length) {
                    const lastMessageElement = chatItem.find('p');
                    lastMessageElement.text(lastMessage.message);
                    lastMessageElement.toggleClass('fw-bold', lastMessage.sender_id != {{ auth()->id() }});
                    chatItem.find('small').text(moment(lastMessage.created_at).fromNow());
                    chatList.prepend(chatItem);
                }
            }

            function loadMessages(chatId) {
                $.ajax({
                    url: `/chats/${chatId}/messages`,
                    method: 'GET',
                    success: function(messages) {
                        chatMessages.empty();
                        messages.forEach(appendMessage);
                        scrollToBottom();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading messages:', error);
                    }
                });
            }

            function listenForMessages(chatId) {
                const channelName = `chat.${chatId}`;
                // Check if we're already listening to this channel
                if (!Echo.connector.channels[channelName]) {
                    Echo.private(channelName)
                        .listen('NewMessage', (e) => {
                            console.log('New message received:', e.message);
                            if (e.message.chat_id == currentChatId) {
                                if (e.message.sender_id != {{ auth()->id() }}) {
                                    appendMessage(e.message);
                                    scrollToBottom();
                                }
                            }
                            updateChatListItem(e.message.chat_id, e.message);
                        });
                }
            }

            $('#chat-list').on('click', '.chat-list-item', function(e) {
                e.preventDefault();
                currentChatId = $(this).data('chat-id');
                $('.chat-list-item').removeClass('active');
                $(this).addClass('active');
                loadMessages(currentChatId);
                listenForMessages(currentChatId); // Add this line
            });


            listenForMessages({{ $chats->first()->id ?? 'null' }});

            // Add this new function to handle chat archiving
            function unarchiveChat(chatId) {
                url = '/admin/chats/' + chatId + '/unarchive';
                console.log(url);
                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $(`#chat-list li[data-chat-id="${chatId}"]`).remove();
                            if (currentChatId == chatId) {
                                currentChatId = null;
                                chatMessages.html(
                                    '<div class="text-center text-muted d-flex justify-content-center align-items-center" style="height: 100%;">{{ __('Select a chat to view messages.') }}</div>'
                                );
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error unarchiving chat:', error);
                    }
                });
            }

            // Add click event listener for unarchive button
            $(document).on('click', '.unarchive-chat', function(e) {
                chatMessages.empty();
                e.preventDefault();
                e.stopPropagation();
                const chatId = $(this).data('chat-id');
                if (confirm('{{ __('Are you sure you want to unarchive this chat?') }}')) {
                    unarchiveChat(chatId);
                    $(this).closest('.chat-list-item').remove();
                }
            });

        });
    </script>
@endsection
