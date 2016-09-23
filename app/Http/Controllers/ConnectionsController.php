<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Friends;
use App\User;
use Illuminate\Support\Facades\Auth;

class ConnectionsController extends Controller
{
    public function getConnections(Request $request)
    {
      $friends1 = \App\Friends::select('user1')
                              ->where('user2','=',Auth::user()->username)
                              ->where('accepted','=','1')
                              ->get();

      $friends2 = \App\Friends::select('user2')
                              ->where('user1','=',Auth::user()->username)
                              ->where('accepted','=','1')
                              ->get();

      $all_friends = array();
      foreach($friends1 as $friend1){
        array_push($all_friends, $friend1->user1);
      }
      foreach($friends2 as $friend2){
        array_push($all_friends, $friend2->user2);
      }

      $friends = \DB::table('users')->whereIn('username', $all_friends)->get();

      foreach($friends as $friend){
        if ($friend->userType == 'looking_to_get_sponsored'){
    			$friend->userType = 'Seeking Sponsorship';
    		} else if($friend->userType == 'looking_to_sponsor'){
    			$friend->userType = 'Offering Sponsorship';
    		}
      }

      return view('connections', [
        'friends' => $friends,
      ]);
    }

    public function postSearchConnections(Request $request)
    {
      $this->validate($request, [
        'userType' => 'required',
        'university' => 'required',
        'clubType' => 'required',
        'organisationType' => 'required',
      ]);
      $friends1 = \App\Friends::select('user1')
                              ->where('user2','=',Auth::user()->username)
                              ->where('accepted','=','1')
                              ->get();

      $friends2 = \App\Friends::select('user2')
                              ->where('user1','=',Auth::user()->username)
                              ->where('accepted','=','1')
                              ->get();

      $all_friends = array();
      foreach($friends1 as $friend1){
        array_push($all_friends, $friend1->user1);
      }
      foreach($friends2 as $friend2){
        array_push($all_friends, $friend2->user2);
      }

      $friends = \DB::table('users')->whereIn('username', $all_friends)->get();

      foreach($friends as $friend){
        if ($friend->userType == 'looking_to_get_sponsored'){
    			$friend->userType = 'Seeking Sponsorship';
    		} else if($friend->userType == 'looking_to_sponsor'){
    			$friend->userType = 'Offering Sponsorship';
    		}
      }

      return view('connections', [
        'friends' => $friends,
      ]);
    }
}
