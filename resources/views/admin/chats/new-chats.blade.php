@extends('layouts.admin')

@section('title', __('Admin Chats'))

@section('content')
    <div class="card p-3">
        <div class="card-body p-0">
            <div class="container-fluid">
                @livewire('admin-chat-component')
            </div>
        </div>
    </div>
@endsection

@section('page-styles')
    <style>
        .chat-sidebar {
            height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .chat-container {
            height: calc(100vh - 300px);
            overflow-y: auto;
            padding: 1rem;
            background-color: #ffffff;
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
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 1rem;
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
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('messageSent', function() {
                const chatMessages = document.getElementById('chat-messages');
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
        });
    </script>
@endsection
