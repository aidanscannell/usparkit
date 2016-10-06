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
      $friends = $this->getFriends();

      $this->sponsorshipType($friends);

      return view('connections', [
        'friends' => $friends,
        'searchResults' => null,
      ]);
    }

    /**
    * Search users for connections
    *
    * @param \Illuminate\Http\Request  $request
    * @return mixed
    */
    public function postSearchConnections(Request $request)
    {
      // Validate Input
      $this->validate($request, [
        'userType' => 'required|in:looking_to_sponsor,looking_to_get_sponsored',
      ]);
      if ($request->userType == 'looking_to_sponsor'){
        $this->validate($request, [
          'organisationType' => 'required',
        ]);
        if($request['organisationType'] == 'AllTypes'){
            $searchResults = \App\User::where('userType', '=', $request['userType'])->get();
        } elseif($request['organisationType'] != 'AllTypes'){
            $searchResults = \App\User::where('userType', '=', $request['userType'])
                                    ->where('sponsor', '=', $request['organisationType'])
                                    ->get();
        }
      } else if ($request->userType == 'looking_to_get_sponsored'){
        $this->validate($request, [
          'university' => 'required',
          'clubType' => 'required',
        ]);
        if($request['university'] == 'AllUniversities' && $request['clubType'] == 'AllTypes'){
          $searchResults = \App\User::where('userType', '=', $request['userType'])
                                  ->get();
        } elseif($request['university'] == 'AllUniversities' && $request['clubType'] != 'AllTypes'){
          $searchResults = \App\User::where('userType', '=', $request['userType'])
                                  ->where('groupType', '=', $request['clubType'])
                                  ->get();
        } elseif($request['university'] != 'AllUniversities' && $request['clubType'] == 'AllTypes'){
          $searchResults = \App\User::where('userType', '=', $request['userType'])
                                  ->where('university', '=', $request['university'])
                                  ->get();
        } elseif($request['university'] != 'AllUniversities' && $request['clubType'] != 'AllTypes'){
          $searchResults = \App\User::where('userType', '=', $request['userType'])
                                  ->where('groupType', '=', $request['clubType'])
                                  ->where('university', '=', $request['university'])
                                  ->get();
        }
      }

      $this->sponsorshipType($searchResults);

      $friends = $this->getFriends();

      $this->sponsorshipType($friends);

      return view('connections', [
        'friends' => $friends,
        'searchResults' => $searchResults,
      ]);

    }

    /**
    * Select users friends
    *
    */
    public function getFriends(){
      $friends1 = \App\Friends::select('user1')
                              ->where('user2','=',Auth::user()->username)
                              ->where('accepted','=','1')->get();
      $friends2 = \App\Friends::select('user2')
                              ->where('user1','=',Auth::user()->username)
                              ->where('accepted','=','1')->get();
      $all_friends = array();
      foreach($friends1 as $friend1){array_push($all_friends, $friend1->user1);}
      foreach($friends2 as $friend2){array_push($all_friends, $friend2->user2);}
      $friends = \DB::table('users')->whereIn('username', $all_friends)->get();
      return $friends;
    }

    /**
    * Format the user type for display
    *
    */
    public function sponsorshipType($friends){
        foreach($friends as $friend){
          if ($friend->userType == 'looking_to_get_sponsored'){
      			$friend->userType = 'Seeking Sponsorship';
      		} else if($friend->userType == 'looking_to_sponsor'){
      			$friend->userType = 'Offering Sponsorship';
      		}
        }
    }


}
