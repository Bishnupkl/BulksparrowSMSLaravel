<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messageList()
    {
        $messages = Message::all();
        return view('message-list', compact('messages'));
    }


}
