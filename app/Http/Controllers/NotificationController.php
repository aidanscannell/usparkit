<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DateTime;

class NotificationController extends Controller
{
    public function getNotifications(){

        $friendRequests = \App\Friends::where('user2','=',Auth::user()->username)
                                      ->where('accepted','=','0')
                                      ->get();
        foreach ($friendRequests as $friendRequest){
          $friendRequest->avatar = \App\User::where('username','=', $friendRequest->user1)->get()->first()->avatar;
          $friendRequest->userSpace = preg_replace('/(?<!\ )[A-Z]/', ' $0', $friendRequest->user1);
        }

        $this->date($friendRequests);

        return view('notifications', [
          'friendRequests' => $friendRequests,
          'pageOwner' => Auth::user(),
        ]);
    }

    public function date($notifications){
        foreach($notifications as $notification){
          $datetime = new DateTime($notification->created_at);
          $notification->day= $datetime->format('d');
          $notification->year= $datetime->format('Y');
          $monthNum = $datetime->format('m');
          $notification->monthName = date('M', mktime(0, 0, 0, $monthNum, 10)); // March
          $notification->time = $datetime->format('H:i:s');
        }
    }
}
