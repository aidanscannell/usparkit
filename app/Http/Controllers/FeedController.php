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

        $adverts = \DB::table('sponsorship_adverts')->leftJoin('users', 'sponsorship_adverts.user', '=', 'users.username')
                                                  ->where('sponsorship_adverts.userType','!=',$user->userType)
                                                  ->where('deletedAdvert','=','0')
                                                  // ->where($user->groupType,'in','eligible')
                                                  ->orWhere('sponsorship_adverts.userType','!=',$user->userType)
                                                  ->where('deletedAdvert','=','0')
                                                  //->where('eligible','=','AllTypes')
                                                  ->get()->all();

        //return $adverts;
        foreach ($adverts as $advert) {
            // Creat list of eligible groups
            $advert->eligibleGroups = '';
            $eligibleGroupsArray = explode(",", $advert->eligible);
            foreach ($eligibleGroupsArray as $value) {
              $advert->eligibleGroups .= ''.$value.', ';
            }
            $advert->eligibleGroups = rtrim($advert->eligibleGroups, ', ');

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

    public function postSearchAdverts(Request $request)
    {
        $this->validate($request, [
            'sponsorshipType' => 'required',
            'minValue' => 'required|numeric',
            'eligibleGroups' => 'required'
        ]);

        // $adverts = \App\Sponsorship_adverts::where('amount','>',$request['minValue']);

        // foreach ($request['sponsorshipType'] as $sType){
        //   if($sType == 'all'){
        //     break;
        //   }
        //
        //   if($count > 0){
        //     $eligible .= "";
        //   } else{
        //     $eligible = "['eligible','like','%AllSports%'";
        //   }
        //   $count++;
        // }
        //
        // return $adverts->get()->all();

        $count = 0;
        foreach ($request['eligibleGroups'] as $gType){
            if($count > 0){
              $eligible .= ", 'or', 'eligible','like','%AllTypes%'";
            } else{
              $eligible = "['eligible','like','%AllSports%'";
            }
            $count++;
        }
        $eligible .= "]";

        // foreach ($request['eligibleGroups'] as $gType){
        //     $adverts = $adverts->orwhere('eligible','like','%'.$gType.'%')
        //                         ->where('amount','>',$request['minValue']);
        //
        // }

        $adverts = \DB::table('sponsorship_adverts')->leftJoin('users', 'sponsorship_adverts.user', '=', 'users.username')
                                                    ->where([
                                                        ['sponsorship_adverts.amount','>',(int)$request['minValue']],
                                                        ['sponsorship_adverts.userType','!=',Auth::user()->userType],
                                                        //['eligible','like','%AllSports%', 'or', 'eligible','like','%AllTypes%']
                                                        ['sponsorshipType', 'like', '%donation%']//, 'or', 'sponsorshipType', 'like', '%voucher%']
                                                    ])
                                                    ->get()
                                                    ->all();

        foreach ($adverts as $advert) {
            // Creat list of eligible groups
            $advert->eligibleGroups = '';
            $eligibleGroupsArray = explode(",", $advert->eligible);
            foreach ($eligibleGroupsArray as $value) {
              $advert->eligibleGroups .= ''.$value.', ';
            }
            $advert->eligibleGroups = rtrim($advert->eligibleGroups, ', ');

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
          'adverts' => $adverts,
          'user' => Auth::user(),
        ]);
    }

    public function getSponsorshipRequests()
    {
        $eligibleType = 'sponsor';

        $user = \App\User::where('username','=',Auth::user()->username)->get()->first();

        $adverts = \DB::table('sponsorship_adverts')->leftJoin('users', 'user', '=', 'username')
                                                  //->where('userType','!=',Auth::user()->userType)
                                                  ->where('deletedAdvert','=','0')
                                                  ->where('eligible','=',$eligibleType)
                                                  //->orWhere('userType','!=',Auth::user()->userType)
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
}
