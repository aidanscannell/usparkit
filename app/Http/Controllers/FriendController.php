<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\User;
use \App\Friends;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{

    public function postSendRequest(Request $request)
    {
        $users = \App\User::select('username')->get()->all();
        $validNames = '';
        foreach ($users as $user){
          $validNames .= $user->username.',';
        }
        $validNames = rtrim($validNames, ',');
        $this->validate($request, [
          'username' => 'required|in:'.$validNames.''
        ]);
        $connection = new Friends;
        $connection->user1 = Auth::user()->username;
        $connection->user2 = $request->username;
        $connection->save();
        return redirect()->back()->with('message', 'Connection request sent successfully');
    }

    public function postAcceptRequest(Request $request){
        $this->validate($request, [
          'user1' => 'required',
          'user2' => 'required',
          'id' => 'required'
        ]);
        $connection = \App\Friends::find($request['id']);
        $this->validate($request, [
          'user1' => 'required|in:'.$connection->user1.'',
          'user2' => 'required|in:'.$connection->user2.'',
        ]);

        $connection->accepted = '1';
        $connection->save();

        return redirect()->back()->with('message', 'Connection Request Accepted Successfully!');

    }

}
