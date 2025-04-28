<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ChatHistory;


class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $reply = $this->generateReply($userMessage);

        // Save chat history to the database
        $chatHistory = new ChatHistory();
        $chatHistory->user_message = $userMessage;
        $chatHistory->bot_reply = $reply;
        $chatHistory->user_id = auth()->id();  // assuming you're saving the user id
        $chatHistory->save();

        return redirect('/chat');
    }

    public function index()
    {
        // Retrieve chat history from the database
        $chatHistory = ChatHistory::where('user_id', auth()->id())->get();

        return view('chat', compact('chatHistory'));
    }

    public function clear()
    {
        ChatHistory::where('user_id', auth()->id())->delete();
        return redirect('/chat');
    }

    private function generateReply($message)
    {
        $apiKey = env('OPENAI_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are RizzBot, a helpful assistant that gives boys advice on how to talk to girls, how to act around them, and pick-up lines. Always be fun, confident, and respectful.'],
                ['role' => 'user', 'content' => $message],
            ],
            'temperature' => 0.7,
            'max_tokens' => 150,
        ]);

        if ($response->successful()) {
            return $response['choices'][0]['message']['content'];
        } else {
            return "Sorry, something went wrong with RizzBot. Try again later!";
        }
    }
}
