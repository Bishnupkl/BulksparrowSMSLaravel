<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messageList()
    {
        $messages = Message::all();
        $users = User::all();
        return view('message-list', compact('messages','users'));
    }


    public function send_message(Request  $request)
    {
        $message = Message::where('id', $request->message_id)->first();
        if ($message) {

            $users = User::whereIn('id', $request->user_id)->get();

            if ($users->count() > 0) {
                foreach ($users as $user) {
                    $composeMessage = str_replace('[USER]', $user->name,$message->message);
                    $args = http_build_query(array(
                        'token' => '<token-provided>',
                        'from'  => '<Identity>',
                        'to'    => '<comma_separated 10-digit mobile numbers>',
                        'text'  => 'SMS Message to be sent'));

                    $url = "http://api.sparrowsms.com/v2/sms/";

                    # Make the call using API.
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                    // Response
                    $response = curl_exec($ch);
                    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);

                }
            }

        }
    }

}
