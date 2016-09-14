<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DateTime;

use App\Http\Requests;

class AuthController extends Controller
{
  public function getSignUp(Request $request)
  {
      return view('signup');
  }

  public function getLogIn(Request $request)
  {
      return view('auth.login');
  }

  public function postSignUp(Request $request)
  {
      // Get users ip address and validate it
      $ip = $request->ip();

      // Validate the input data
      $this->validate($request, [
          'userType' => 'required|max:40',
          'username' => 'required|max:50|min:3|unique:users',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:10|max:100|confirmed|case_diff|numbers|letters|symbols',
          'password_confirmation' => 'required|min:4',
          'country' => 'required|max:120',
          'check' => 'required',
      ]);

      // Get current time
      $now = new DateTime();

      // Get variables posted in form
      $userType = $request['userType'];
      $username = $request['username'];
      $email = $request['email'];
      $country = $request['country'];
      $password = bcrypt($request['pass1']);
      $lastlogin = $now;
      $notescheck = $now;
      $signup = $now;

      // Create new user and record their details
      $user = new User();
      $user->userType = $userType;
      $user->username = $username;
      $user->email = $email;
      $user->country = $country;
      $user->password = $password;
      $user->lastlogin = $lastlogin;
      $user->notescheck = $notescheck;
      $user->signup = $signup;
      $user->ip = $ip;

      // Check userType and validate/record as required
      if ($request['userType'] == 'looking_to_sponsor'){
          $this->validate($request, [
            'sponsor' => 'required|max:120',
          ]);
          $sponsor = $request['sponsor'];
          $user->sponsor = $sponsor;
      } elseif ($request['userType'] == 'looking_to_get_sponsored'){
          $this->validate($request, [
              'groupType' => 'required|max:120',
              'university' => 'required|max:120',
          ]);
          $groupType = $request['groupType'];
          $university = $request['university'];
          $user->groupType = $groupType;
          $user->university = $university;
      }

      // Save user to database
      $user->save();

      Auth::login($user);

      return redirect('User/'.$username.'');
  }

  public function postSignIn(Request $request)
  {
      $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required'
      ]);


      if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
          $username = Auth::user()->username;
          return redirect("/User/$username");
      }
      return redirect()->back();
  }

  public function getLogout()
  {
      Auth::logout();
      return redirect()->route('homepage');
  }

}
