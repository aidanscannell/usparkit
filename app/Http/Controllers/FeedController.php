<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Sponsorship_adverts;
use DateTime;

use App\Http\Requests;

class FeedController extends Controller
{
    public function getSelectSponsorshipPage()
    {
      if (Auth::user()->userType == 'looking_to_sponsor'){
          return $this->getSponsorshipRequests();
      } elseif (Auth::user()->userType == 'looking_to_get_sponsored'){
        return $this->getSponsorshipAdverts();
      }
    }

    public function getSponsorshipAdverts()
    {
        $user = \App\User::where('username','=',Auth::user()->username)->get()->first();

        //return $user->groupType;

        /*$adverts = \App\Sponsorship_adverts::where('userType','!=',Auth::user()->userType)
                                            ->where('deletedAdvert','=','0')
                                            ->where('eligible','=',$eligibleType)
                                            ->orWhere('userType','!=',Auth::user()->userType)
                                            ->where('deletedAdvert','=','0')
                                            ->where('eligible','=','AllTypes')
                                            ->orderby('senttime','desc')
                                            ->get()->all();*/

        $adverts = \DB::table('sponsorship_adverts')->leftJoin('users', 'user', '=', 'username')
                                                  // ->where('userType','=',$user->userType)
                                                  ->where('deletedAdvert','=','0')
                                                  ->where('eligible','in',$user->groupType)
                                                  //->orWhere('userType','!=',$user->userType)
                                                  ->orwhere('deletedAdvert','=','0')
                                                  ->where('eligible','=','AllTypes')
                                                  ->get()->all();

        foreach ($adverts as $advert) {
            // Creat list of eligible groups
            $advert->eligibleGroups = '';
            $eligibleGroupsArray = explode(",", $advert->eligible);
            foreach ($eligibleGroupsArray as $value) {
                $advert->eligibleGroups .= ''.$value.', ';
            }

            // Make the sponsorship type text
    				if ($advert->sponsorshipType == 'custom_stash'){
    					$advert->sponsorshipType = 'Custom Stash';
    					$advert->modalSponsorshipType = 'Custom Stash';
    				} else if ($advert->sponsorshipType == 'voucher'){
    					$advert->sponsorshipType = 'Voucher';
    					$advert->modalSponsorshipType = 'Vouchers';
    				} else if ($advert->sponsorshipType == 'gift_card'){
    					$advert->sponsorshipType = 'Gift Card';
    					$advert->modalSponsorshipType = 'Gift Cards';
    				} else if ($advert->sponsorshipType == 'donation'){
    					$advert->sponsorshipType = 'Donation';
    					$advert->modalSponsorshipType = 'Donations';
    				}

            // Make date
            $datetime = new DateTime($advert->senttime);
        		$advert->day= $datetime->format('d');
        		$advert->year= $datetime->format('Y');
        		$monthNum = $datetime->format('m');
        		$advert->monthName = date('M', mktime(0, 0, 0, $monthNum, 10)); // March
        		$advert->time = $datetime->format('H:i:s');

            // Username with space
            $advert->pageUsernameSpace = str_replace("-", " ", $advert->username);
    		}

        return view('sponsorship-adverts', [
          'user' => Auth::user(),
          'adverts' => $adverts,
        ]);
    }

    public function getSponsorshipRequests()
    {
        $eligibleType = 'sponsor';

        $user = \App\User::where('username','=',Auth::user()->username)->get()->first();

        /*$adverts = \App\Sponsorship_adverts::where('userType','!=',Auth::user()->userType)
                                            ->where('deletedAdvert','=','0')
                                            ->where('eligible','=',$eligibleType)
                                            ->orWhere('userType','!=',Auth::user()->userType)
                                            ->where('deletedAdvert','=','0')
                                            ->where('eligible','=','AllTypes')
                                            ->orderby('senttime','desc')
                                            ->get()->all();*/
        // return Auth::user()->userType;
        $adverts = \DB::table('sponsorship_adverts')->leftJoin('users', 'user', '=', 'username')
                                                  //->where('userType','!=',Auth::user()->userType)
                                                  ->where('deletedAdvert','=','0')
                                                  ->where('eligible','=',$eligibleType)
                                                  //->orWhere('userType','!=',Auth::user()->userType)
                                                  ->orwhere('deletedAdvert','=','0')
                                                  ->where('eligible','=','AllTypes')
                                                  ->get()->all();
        //return $adverts;
        //return $user->$eligibleType;



        foreach ($adverts as $advert) {
            // Creat list of eligible groups
            $advert->eligibleGroups = '';
            $eligibleGroupsArray = explode(",", $advert->eligible);
            foreach ($eligibleGroupsArray as $value) {
                $advert->eligibleGroups .= ''.$value.', ';
            }

            // Make the sponsorship type text
    				if ($advert->sponsorshipType == 'custom_stash'){
    					$advert->sponsorshipType = 'Custom Stash';
    					$advert->modalSponsorshipType = 'Custom Stash';
    				} else if ($advert->sponsorshipType == 'voucher'){
    					$advert->sponsorshipType = 'Voucher';
    					$advert->modalSponsorshipType = 'Vouchers';
    				} else if ($advert->sponsorshipType == 'gift_card'){
    					$advert->sponsorshipType = 'Gift Card';
    					$advert->modalSponsorshipType = 'Gift Cards';
    				} else if ($advert->sponsorshipType == 'donation'){
    					$advert->sponsorshipType = 'Donation';
    					$advert->modalSponsorshipType = 'Donations';
    				}

            // Make date
            $datetime = new DateTime($advert->senttime);
        		$advert->day= $datetime->format('d');
        		$advert->year= $datetime->format('Y');
        		$monthNum = $datetime->format('m');
        		$advert->monthName = date('M', mktime(0, 0, 0, $monthNum, 10)); // March
        		$advert->time = $datetime->format('H:i:s');

            // Username with space
            $advert->pageUsernameSpace = str_replace("-", " ", $advert->username);
    		}



        return view('sponsorship-adverts', [
          'user' => Auth::user(),
          'adverts' => $adverts,
        ]);
    }
}
