<?php
namespace App\Http\Controllers;

use App\User;
use App\Display;
use App\Photos;
use App\SponsorshipAdvert;
use App\pm_inbox;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests;

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

        $sponsorship_adverts = \DB::table('sponsorship_adverts')->leftJoin('users', 'user', '=', 'username')
                                                  ->where('user','=',$pageOwner->username)
                                                  ->where('deletedAdvert','=','0')
                                                  ->orderBy('senttime', 'desc')
                                                  ->limit(4)
                                                  ->get();

        foreach($sponsorship_adverts as $sponsorship_advert){
          $datetime = new DateTime($sponsorship_advert->senttime);
      		$sponsorship_advert->day= $datetime->format('d');
      		$sponsorship_advert->year= $datetime->format('Y');
      		$monthNum = $datetime->format('m');
      		$sponsorship_advert->monthName = date('M', mktime(0, 0, 0, $monthNum, 10)); // March
      		$sponsorship_advert->time = $datetime->format('H:i:s');

          if($sponsorship_advert->userType == 'looking_to_get_sponsored'){
            $sponsorship_advert->modalRef = '#requestModal';
            $sponsorship_advert->modalRef2 = 'requestModal';
            $sponsorship_advert->modalRef3 = 'is Seeking Sponsorship of';
          } elseif($sponsorship_advert->userType == 'looking_to_sponsor'){
            $sponsorship_advert->modalRef = '#advertModal';
            $sponsorship_advert->modalRef2 = 'advertModal';
            $sponsorship_advert->modalRef3 = 'is Sponsoring up to';
          }

          if ($sponsorship_advert->amount_units == 'amount'){
          	$sponsorship_advert->amount_units = '£';
          	$sponsorship_advert->amount_units_percent = '';
          } else if ($sponsorship_advert->amount_units == 'percent'){
          	$sponsorship_advert->amount_units_percent = '	%';
          	$sponsorship_advert->amount_units = '';
          }
        }

        return view('user', [
          'user' => Auth::user(),
          'pageOwner' => $pageOwner,
          'display' => $display,
          'photos' => $photos,
          'friendsLogic' => $friendsLogic,
          'oFriends' => $oFriends,
          'sponsorship_adverts' => $sponsorship_adverts,
        ]);
    }

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

    public function postSaveWYSIWYG(Request $request)
    {
        $this->validate($request, [
          'richTextField' => 'required|max:1000',
        ]);

        $user = \App\User::where('username','=',Auth::user()->username)->get()->first();

        Storage::disk('uploads')->put($user->username.'/wysiwyg_'.$user->username.'.html', $request['richTextField']);

        $user->About = $request['richTextField'];
        $user->save();
        Storage::put('wysiwyg_'.$user->username.'.html', $request['richTextField']);

        // return response()->json([
        //   'richTextFieldSentBack' => $request['richTextField'],
        //   'message' => 'Description updated successfully!'],
        //   200);

        // If AJAX was used return message using json
        if($request->ajax()){
          return response()->json([
            'richTextFieldSentBack' => $request['richTextField'],
            'message' => 'Description updated successfully!'],
            200);
        }

        // Redirect with message if HTTP (Javescript turned off)
        return redirect()->back()->with('message', 'Description updated successfully!');

    }

    public function postSelectPic(Request $request)
    {
      // Select all photos id for validation of recipient
      $photosID = \App\Photos::select('id')->get();
      $string = '';
      foreach($photosID as $photoID){
        $string .= $photoID->id.',';
      }
      $this->validate($request, [
        'id' => 'required|numeric|in:'.$string.'',
      ]);
      // Set avatar in users table
      $newProfile = \App\Photos::where('id', '=',$request['id'])
                                  ->where('user','=',Auth::user()->username)
                                  ->get()->first();
      $users = \App\User::where('username','=',Auth::user()->username)->first();
      $users->avatar = $newProfile['filename'];
      $users->save();
      // Set the old avatar to not be avatar in photos table
      $oldProfile = \App\Photos::where('avatar','=','1')->where('user','=',Auth::user()->username)->first();
      $oldProfile->avatar = '0';
      $oldProfile->save();
      // Set the new avatar to be the avatar in the photos table
      $newProfile = \App\Photos::find($request['id']);
      $newProfile->avatar = '1';
      $newProfile->save();
      // If AJAX was used return message using json
      if($request->ajax()){
        return response()->json([
          'username' => Auth::user()->username,
          'filename' => $newProfile['filename'],
          'message' => 'Profile Picture Changed Successfully!'],
          200);
      }
      // Redirect with message if HTTP (Javescript turned off)
      return redirect()->back()->with('message', 'Profile Picture Changed Successfully!');
    }

    public function postDeletePic(Request $request)
    {
      // Select all photos id for validation of recipient
      $photosID = \App\Photos::select('id')->get();
      $string = '';
      foreach($photosID as $photoID){
        $string .= $photoID->id.',';
      }
      $this->validate($request, [
        'id' => 'required|numeric|in:'.$string.'',
      ]);

      // Select the photo to delete
      $image = \App\Photos::where('id', '=',$request['id'])->where('user','=',Auth::user()->username)->get()->first();
      $fileToDelete = $image->filename;

      // Count the number of images the user has
      $imagesCount = \App\Photos::where('user','=',Auth::user()->username)->count();

      // If the image being deleted is the profile picture and there are more photos asign a new profile picture
      if($image->avatar == 1 && $imagesCount > 1){
        // Set an avatar in the photos table
        $newProfile = \App\Photos::where('user','=', Auth::user()->username)
                                  ->where('avatar','=', '0')->first();
        $newProfile->avatar = '1';
        $newProfile->save();

        $users = \App\User::where('username','=',Auth::user()->username)->first();
        $users->avatar = $newProfile['filename'];
        $users->save();
      }

      // Delete image files in userz folder
      File::delete('userz/'.Auth::user()->username.'/' . $image->filename);
      File::delete('userz/'.Auth::user()->username.'/' . 'thumb_'.$image->filename);
      File::delete('userz/'.Auth::user()->username.'/' . 'resized_'.$image->filename);

      // Delete the old image row from photos table
      $image = \App\Photos::where('id', '=',$request['id'])->where('user','=',Auth::user()->username)->delete();

      // If AJAX was used return message using json
      if($request->ajax()){
        return response()->json([
          'filename' => $fileToDelete,
          'message' => 'Picture Deleted Successfully!'],
          200);
      }
      // Redirect with message if HTTP (Javescript turned off)
      return redirect()->back()->with('message', 'Picture Deleted Successfully!');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

}
