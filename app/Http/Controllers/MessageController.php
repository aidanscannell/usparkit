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

use App\Photos;
use App\SponsorshipAdvert;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


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

    public function postSendMsgTo(Request $request)
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

      $datetime = new DateTime();
      $message = new pm_inbox;
      $message->receiver = $request['recipient'];
      $message->sender = Auth::user()->username;
      $message->senttime = $datetime;
      $message->subject = $request['subject'];
      $message->message = $request['message'];
      $message->parent = 'x';

      $message->save();

      // If AJAX was used return message using json
      if($request->ajax()){
        return response()->json([
          'message' => 'Message sent successfully!'],
          200);
      }

      // Redirect with message if HTTP (Javescript turned off)
      return redirect()->back()->with('message', 'Message sent successfully!');

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
        'recipient' => 'in:'.$string.'',
        'subject' => 'required|max:200',
        'message' => 'required|max:5000',
      ]);

      // Add message to database
      $datetime = new DateTime();
      $message = new pm_inbox;
      $message->receiver = $request['recipient'];
      $message->sender = Auth::user()->username;
      $message->senttime = $datetime;
      $message->subject = $request['subject'];
      $message->message = $request['message'];
      $message->parent = 'x';
      $message->save();

      // If AJAX was used return message using json
      if($request->ajax()){
        return response()->json([
          'id' => $request['id'],
          'message' => 'Message sent successfully!'],
          200);
      }

      // Redirect with message if HTTP (Javescript turned off)
      return redirect()->back()->with('message', 'Message sent successfully!');

    }

    public function postSendReply(Request $request)
    {
      // return response()->json([
      //   'request' => $request->all(),
      //   'message' => 'Message sent successfully!'],
      //   200);

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
        'recipient' => 'in:'.$string.'',
        'message' => 'required|max:5000',
        'id' => 'required|numeric',
      ]);

      // Add message to database
      $datetime = new DateTime();
      $message = new pm_inbox;
      $message->receiver = $request['recipient'];
      $message->sender = Auth::user()->username;
      $message->senttime = $datetime;
      $message->message = $request['message'];
      $message->parent = '0';
      $message->messageID = $request['id'];
      $message->save();

      // If AJAX was used return message using json
      if($request->ajax()){
        return response()->json([
          'message' => 'Reply sent successfully!'],
          200);
      }

      // Redirect with message if HTTP (Javescript turned off)
      return redirect()->back()->with('message', 'Reply sent successfully!');

    }

    public function postDeleteReply(Request $request)
    {
      //return 'hi';
      // return response()->json([
      //   'request' => $request->all(),
      //   'message' => 'Message sent successfully!'],
      //   200);

      // Select all users usernames for validation of recipient
      $photosID = \App\Pm_inbox::select('inbox_id')->get()->all();

      // Create username string
      $string = '';
      foreach($photosID as $photoID){
          $string .= $photoID->inbox_id.',';
      }

      // Validate input
      $this->validate($request, [
        'msg_id' => 'required|numeric|in:'.$string.'',
        'reply_id' => 'required|numeric|in:'.$string.'',
      ]);

      // Mark message as deleted by user
      $message = \App\Pm_inbox::where('inbox_id','=',$request['reply_id'])
                              ->where('messageID','=',$request['msg_id'])
                              ->get()->first();

      if ($message->sender == Auth::user()->username){
          $message->sdelete = '1';
          $message->save();
          return 'here';

          // If AJAX was used return message using json
          if($request->ajax()){
            return response()->json([
              //'request' => $request->all(),
              'message' => 'Reply deleted successfully!'],
              200);
          }

          // Redirect with message if HTTP (Javescript turned off)
          return redirect()->back()->with('message', 'Reply deleted successfully!');

      } elseif ($message->receiver == Auth::user()->username){
          $message->rdelete = '1';
          $message->save();

          // If AJAX was used return message using json
          if($request->ajax()){
            return response()->json([
              'request' => $request->all(),
              'message' => 'Reply deleted successfully!'],
              200);
          }

          // Redirect with message if HTTP (Javescript turned off)
          return redirect()->back()->with('message', 'Reply deleted successfully!');
      }

      // If AJAX was used return message using json
      if($request->ajax()){
        return response()->json([
          'request' => $request->all(),
          'message' => 'Unknown error occured!'],
          200);
      }

      // Redirect with message if HTTP (Javescript turned off)
      return redirect()->back()->with('message', 'Unknown error occured!');

    }

}
