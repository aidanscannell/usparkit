<?php

namespace App\Http\Controllers;

use App\pm_inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use App\User;

use App\Http\Requests;

use DateTime;

class MessageController extends Controller
{
    public function getMessages(Request $request){

        $user = Auth::user();

        // Gather messages user sent
        $messagesSender = \DB::table('pm_inbox')->join('users', 'receiver', '=', 'username')
                                          ->where('sender','=',$user->username)
                                          ->where('sdelete','=','0')
                                          ->where('parent','=','x')
                                          ->where('hasreplies','=','1')
                                          ->orderBy('senttime', 'DESC')
                                          ->get();

        // Gather message user received
        $messages = \DB::table('pm_inbox')->join('users', 'sender', '=', 'username')
                                          ->where('receiver','=',$user->username)
                                          ->where('parent','=','x')
                                          ->where('rdelete','=','0')
                                          ->orderBy('senttime', 'DESC')
                                          ->get();

        // Gather replies to messages user received
        $replies = \DB::table('pm_inbox')->join('users', 'receiver', '=', 'username')
                                          ->where('parent','=','0')
                                          ->where('rdelete','=','0')
                                          ->where('sdelete','=','0')
                                          ->orderBy('senttime', 'ASC')
                                          ->get();

        // Gather replies to messages user sent
        $repliesSender = \DB::table('pm_inbox')->join('users', 'sender', '=', 'username')
                                          ->where('parent','=','0')
                                          ->where('rdelete','=','0')
                                          ->where('sdelete','=','0')
                                          ->orderBy('senttime', 'ASC')
                                          ->get();

        return view('inbox', [
          'messagesSender' => $messagesSender,
          'messages' => $messages,
          'replies' => $replies,
          'repliesSender' => $repliesSender,
        ]);
    }

    public function postSendMsg(Request $request)
    {
      // Select all users usernames for validation of recipient
      $users = \App\User::select('username')->get();
      // Create username string
      $string = '';
      foreach($users as $user){
        if($user->username != Auth::user()->username){
          $string .= $user->username.',';
        }
      }

      // Validate input
      $this->validate($request, [
        'recipient' => 'required|in:'.$string.'',
        'subject' => 'required|max:200',
        'message' => 'required|max:5000',
      ]);

      $message = new pm_inbox;
      $message->receiver = $request['recipient'];
      $message->sender = Auth::user()->username;
      $message->subject = $request['subject'];
      $message->message = $request['message'];
      $message->parent = 'x';

      $message->save();

      return response()->json([
        'message' => 'Message sent successfully!'],
        200);
    }
}
