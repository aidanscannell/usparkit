<?php
namespace App\Http\Controllers;

use App\User;
use App\Display;
use App\Photos;
use App\SponsorshipAdvert;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DateTime;

class UserController extends Controller
{

    public function getUser(Request $request)
    {
        // Select page owner from database
        $pageOwner = \App\User::where('username', '=', $request->username)->get()->first();

        // Select authenticated user
        $user = Auth::user();

        // Select page owners photos
        $photos = \App\Photos::where('user', $pageOwner->username)->get();

        // Select page owners friends where accepted
        $oFriends = \App\Friends::where('user1', '=', $pageOwner->username)
                                ->where('accepted', '=', '1')
                                ->orWhere('user2', '=', $pageOwner->username)
                                ->where('accepted', '=', '1')->get();

        // Select the people that the page owner has blocked
        /*$oBlocked = \App\Blockedusers::where('blocker', '=', $pageOwner->username)->orWhere('blockee', '=', $pageOwner->username)->get();*/

        // Create object for displaying data
        $display = new Display();
        $display->pageUsernameSpace = str_replace("-", " ", $request->username);

        // Initialize any variables that the page might echo
        $display->isFriend = false;

        // Friends Logic for authenticated users profile page
        $friends_view_all_link = '';
        $friendsLogic = '';

        $count = 0;
        if($oFriends->count() >= 1){
        	$max = 5;
          $orLogic = '';
          foreach ($oFriends as $oFriend){
            if ($oFriend->user1 != $user->username && $count <=5){
              $orLogic .= "username='$oFriend->user1' OR ";
            } else if ($oFriend->user2 != $user->username && $count <=5){
              $orLogic .= "username='$oFriend->user2' OR ";
            }
            $count++;
          }
        	$orLogic = chop($orLogic, "OR ");
          $friendsLogic = \DB::select('select * from users where '.$orLogic.'');
        }

        // WYSIWYG
        /*$sponsorshipAdvert = \App\SponsorshipAdvert::where('deletedAdvert', '=', '0')
                                                            ->where('user', '=', $pageOwner->username)
                                                            ->orderBy('senttime', 'desc')
                                                            ->get();*/

        return view('user', [
          'user' => Auth::user(),
          'pageOwner' => $pageOwner,
          'display' => $display,
          'photos' => $photos,
          'friendsLogic' => $friendsLogic,
          'oFriends' => $oFriends
        ]);
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }

    /*public function getLogout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }*/

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
           'first_name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $old_name = $user->first_name;
        $user->first_name = $request['first_name'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['first_name'] . '-' . $user->id . '.jpg';
        $old_filename = $old_name . '-' . $user->id . '.jpg';
        $update = false;
        if (Storage::disk('local')->has($old_filename)) {
            $old_file = Storage::disk('local')->get($old_filename);
            Storage::disk('local')->put($filename, $old_file);
            $update = true;
        }
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

}
