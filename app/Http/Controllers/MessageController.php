<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
//use App\User;
use App\pm_inbox;
use App\Http\Requests;

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

          $allUsers = \App\User::all();
          return view('inbox', [
            'messagesSender' => $messagesSender,
            'messages' => $messages,
            'replies' => $replies,
            'repliesSender' => $repliesSender,
        ]);
    }
}
