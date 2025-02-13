@extends('layouts.home')

@section('title', __('Chat'))

@section('content')
    @include('partials.page-hero', [
        'title' => __('Chat'),
        'description' => __('Chat with Admin'),
    ])
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                @livewire('customer-chat-component')
            </div>
        </div>
    </div>
@endsection

@section('page-styles')
    <style>
        .chat-container {
            height: calc(100vh - 300px);
            overflow-y: auto;
            padding: 1rem;
            background-color: #ffffff;
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
