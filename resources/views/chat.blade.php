<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RizzBot Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        header {
            background-color: #4f46e5;
            color: white;
            padding: 1rem;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            background-color: #4f46e5;
            border-radius: 5px;
            padding: 0.5rem;
            cursor: pointer;
            color: white;
            font-weight: 500;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            top: 100%;
            right: 0;
            border: 1px solid #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a, .dropdown-content form button {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            color: black;
            font-size: 1rem;
            background-color: white;
            border: none;
            text-align: left;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover, .dropdown-content form button:hover {
            background-color: #f3f4f6;
        }

        .clear-chat {
            margin-top: 0.5rem;
            text-align: center;
        }

        .clear-chat form button {
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .clear-chat form button:hover {
            background-color: #dc2626;
        }

        .chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .message {
            max-width: 70%;
            padding: 0.75rem 1rem;
            border-radius: 20px;
            font-size: 1rem;
            line-height: 1.4;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .user {
            align-self: flex-end;
            background-color: #34d399;
            color: white;
        }

        .bot {
            align-self: flex-start;
            background-color: white;
            color: #333;
        }

        .typing-indicator {
            align-self: flex-start;
            background-color: white;
            color: #666;
            font-style: italic;
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% { opacity: 0.5; }
            50% { opacity: 1; }
            100% { opacity: 0.5; }
        }

        .chat-form {
            display: flex;
            padding: 1rem;
            background-color: white;
            border-top: 1px solid #ddd;
        }

        .chat-form textarea {
            flex: 1;
            resize: none;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            outline: none;
            height: 42px;
            margin-right: 0.5rem;
        }

        .chat-form button {
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0.5rem 1.2rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .chat-form button:hover {
            background-color: #4338ca;
        }
    </style>
</head>

<body>

<header>
    <div>RizzBot Chat</div>

    <div class="dropdown">
        {{ Auth::user()->name }}
        <div class="dropdown-content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
</header>

<div class="clear-chat">
    <form action="/chat/clear" method="POST">
        @csrf
        <button type="submit">Clear Chat</button>
    </form>
</div>

<div id="chat" class="chat-container">
    @foreach($chatHistory as $chat)
        <div class="message {{ $chat->sender === 'user' ? 'user' : 'bot' }}">
            {{ $chat->sender === 'user' ? $chat->user_message : $chat->bot_reply }}
        </div>
    @endforeach
</div>

<div id="typing" style="display: none;" class="typing-indicator">
    RizzBot is typing...
</div>

<form id="chat-form" action="/chat" method="POST" class="chat-form">
    @csrf
    <textarea name="message" placeholder="Type your message..." required></textarea>
    <button type="submit">Send</button>
</form>

<script>
    const chatForm = document.getElementById('chat-form');
    const chatContainer = document.getElementById('chat');
    const typingIndicator = document.getElementById('typing');

    chatForm.addEventListener('submit', function() {
        typingIndicator.style.display = 'block';
        setTimeout(() => {
            typingIndicator.style.display = 'none';
        }, 3000);
    });

    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    window.onload = scrollToBottom;
</script>

</body>
</html>
