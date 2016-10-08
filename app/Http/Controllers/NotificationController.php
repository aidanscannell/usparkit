<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Notification;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notifications = \DB::table('notifications')->where('username','LIKE',Auth::user()->username)
                                                    ->where('did_read','=','0')
                                                    ->orderby('created_at', 'desc')
                                                    ->get();

        foreach($notifications as $notification){
          $notification->avatar = \App\User::where('username','=', $notification->initiator)->get()->first()->avatar;
          $notification->userSpace = str_replace('_', ' ', $notification->initiator);
          $noteSplit = explode("|", $notification->note);
          $id = $noteSplit[1];
          $st = $noteSplit[2];
     			$value = $noteSplit[3];
     			$units = $noteSplit[4];
          $UT = $noteSplit[5];

          // Date and time
          $notification->datetime = $this->date($notification->created_at);

     			// Make the sponsorship type text
     			if ($st == 'custom_stash'){
     				$notification->advert_st = 'Custom Stash';
     				$notification->modalAdvert_st = 'Custom Stash';
     			} else if ($st == 'voucher'){
     				$notification->advert_st = 'Voucher';
     				$notification->modalAdvert_st = 'Vouchers';
     			} else if ($st == 'gift_card'){
     				$notification->advert_st = 'Gift Card';
     				$notification->modalAdvert_st = 'Gift Cards';
     			} else if ($st == 'donation'){
     				$notification->advert_st = 'Donation';
     				$notification->modalAdvert_st = 'Donations';
     			}

     			// Make correct sign for perecent or gbp
     			if ($units == 'amount'){
     				$notification->advert_amount_units = '£';
     				$notification->advert_amount_units_percent = '';
     			} else if ($units == 'percent'){
     				$notification->advert_amount_units_percent = '%';
     				$notification->advert_amount_units = '';
     			}

     			if ($UT == 'looking_to_sponsor'){
     				$notification->userTypeNotification = 'Advert';
     			} else if ($UT == 'looking_to_get_sponsored'){
     				$notification->userTypeNotification = 'Request';
     			}
        }

        $messages = \App\Pm_inbox::where('rread','=','0')
                                  ->where('receiver','=',Auth::user()->username)
                                  ->get();

        foreach($messages as $message){
          $message->avatar = \App\User::where('username','=', $message->sender)->get()->first()->avatar;
          $message->userSpace = str_replace('_', ' ', $message->sender);
          $message->dateTime = $this->date($message->created_at);
        }

        $friendRequests = \App\Friends::where('user2','=',Auth::user()->username)
                                      ->where('accepted','=','0')
                                      ->get();
        foreach ($friendRequests as $friendRequest){
          $friendRequest->avatar = \App\User::where('username','=', $friendRequest->user1)->get()->first()->avatar;
          $friendRequest->userSpace = str_replace('_', ' ', $friendRequest->user1);
          $friendRequest->dateTime = $this->date($friendRequest->created_at);
        }

        // $this->date($friendRequests);

        return view('notifications', [
          'messages' => $messages,
          'friendRequests' => $friendRequests,
          'notifications' => $notifications,
          'pageOwner' => Auth::user(),
        ]);
    }

    public function postMarkAsRead(Request $request)
    {
        // Select id's that belong to user
        $notifications = \App\Notification::where('username','=',Auth::user()->username)->get()->all();
        $ids = '';
        foreach ($notifications as $notification){
          $ids .= $notification->id.',';
        }
        $ids = rtrim($ids, ',');

        // Validate input
        $this->validate($request, [
          'id' => 'required|numeric|in:'.$ids.'',
        ]);

        // Update database as read
        $notification = \App\Notification::find($request['id']);
        $notification->did_read = '1';
        $notification->save();

        // If AJAX was used return message using json
        if($request->ajax()){
          return response()->json([
            'id' => $request['id'],
            'message' => 'Notification marked as read.'],
            200);
        }

        // Redirect with message if HTTP (Javescript turned off)
        // return redirect()->back()->with('message', 'Notification marked as read.');
    }

    public function date($time){
        // foreach($notifications as $notification){
          $datetime = new DateTime($time);
          return $datetime->format('d M H:i');
        // }
    }
}
