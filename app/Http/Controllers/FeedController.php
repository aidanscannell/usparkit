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
        $adverts = $this->selectAllAdverts();

        $this->makeDisplayAdverts($adverts);

        return view('sponsorship-adverts', [
          'user' => Auth::user(),
          'adverts' => $adverts,
        ]);
    }

    public function getSponsorshipRequests()
    {
        $adverts = $this->selectAllAdverts();

        $this->makeDisplayAdverts($adverts);

        return view('sponsorship-requests', [
          'user' => Auth::user(),
          'adverts' => $adverts,
        ]);
    }

    public function postSponsorshipAdverts(Request $request){
      if (Auth::user()->userType == 'looking_to_sponsor'){
          return $this->postSearchRequests($request);
      } elseif (Auth::user()->userType == 'looking_to_get_sponsored'){
        return $this->postSearchAdverts($request);
      }
    }

    public function postSearchAdverts(Request $request)
    {
        $this->validate($request, [
            'sponsorshipType' => 'required',
            'minValue' => 'required|numeric',
            // 'eligibleGroups' => '',
        ]);

        $other_userType = $this->getOtherUserType();

        // Create search logic for sponsorship type
      	$sponsorshipType = '';
      	$counter = 0;
        $allSelected = false;
      	foreach ($request['sponsorshipType'] as $valueType){
      		if ($valueType == 'all'){
      			$allSelected = true;
      		}
      	}
      	if ($allSelected == false){
      		foreach ($request['sponsorshipType'] as $valueType){
      			if ($counter == 0){
      				$sponsorshipType .= '(sponsorshipType=\''.$valueType.'\'';
      			} else {
      				$sponsorshipType .= ' OR sponsorshipType=\''.$valueType.'\'';
      			}
      			$counter++;
      		}
      		if ($counter > 0){
      			$sponsorshipType .= ') AND ';
      		}
      	} else if ($allSelected == true) {
      		$sponsorshipType = '';
      	}

      	// Create search logic for ELIGIBLE GROUPS
        $eligibleGroupsLogic = '';
        if (!is_null($request['eligibleGroups'])){
        	$counter = 0;
        	foreach ($request['eligibleGroups'] as $valueType){
        		if ($counter == 0){
        			$eligibleGroupsLogic .= '(eligible LIKE \'%'.$valueType.'%\'';
        		} else {
        			$eligibleGroupsLogic .= ' OR eligible LIKE \'%'.$valueType.'%\'';
        		}
        		$counter++;
        	}
        	if ($counter > 0){
        		$eligibleGroupsLogic .= ') AND ';
        	}
        }

        // Get adverts from database
      	$sql = 'SELECT * FROM sponsorship_adverts WHERE '.$sponsorshipType.' '.$eligibleGroupsLogic.' (userType=\''.$other_userType.'\') AND (amount>'.$request['minValue'].') ORDER BY senttime DESC';
        $adverts = \DB::select($sql);
        foreach ($adverts as $advert){
            $advert->avatar = \App\User::where('username', '=', $advert->user)->get()->first()->avatar;
        }

        $this->makeDisplayAdverts($adverts);

        return view('sponsorship-adverts', [
          'adverts' => $adverts,
          'user' => Auth::user(),
        ]);
    }

    public function postSearchRequests(Request $request)
    {
        $this->validate($request, [
            'sponsorshipType' => 'required',
            'GroupType' => 'required',
            'universitySearch' => 'required',
        ]);

        $other_userType = $this->getOtherUserType();

        // Create search logic for sponsorship type
      	$sponsorshipType = '';
      	$counter = 0;
        $allSelected = false;
      	foreach ($request['sponsorshipType'] as $valueType){
      		if ($valueType == 'all'){
      			$allSelected = true;
      		}
      	}
      	if ($allSelected == false){
      		foreach ($request['sponsorshipType'] as $valueType){
      			if ($counter == 0){
      				$sponsorshipType .= '(sponsorshipType=\''.$valueType.'\'';
      			} else {
      				$sponsorshipType .= ' OR sponsorshipType=\''.$valueType.'\'';
      			}
      			$counter++;
      		}
      		if ($counter > 0){
      			$sponsorshipType .= ') AND ';
      		}
      	} else if ($allSelected == true) {
      		$sponsorshipType = '';
      	}

        // Create search logic for GROUPS TYPES
      	$GroupTypeLogic = '';
      	$counter = 0;
      	$allSelected = false;
      	foreach ($request['GroupType'] as $valueType){
      		if ($valueType == 'AllTypes'){
      			$allSelected = true;
      		}
      	}
      	if ($allSelected == false){
      		foreach ($request['GroupType'] as $valueType){
      			if ($counter == 0){
      				$GroupTypeLogic .= 'SELECT * FROM users WHERE (groupType=\''.$valueType.'\'';
      			} else {
      				$GroupTypeLogic .= ' OR groupType=\''.$valueType.'\'';
      			}
      			$counter++;
      		}
      		if ($counter > 0){
      			$GroupTypeLogic .= ')';
      		}

          $usersGroup = '';
          if ($GroupTypeLogic){
            $usersGroup = \DB::select($GroupTypeLogic);
          }

          $groupTypeUsers = '';
      		$counter = 0;
      		foreach($usersGroup as $userGroup){
      			$groupUsers = $userGroup->username;
      			if ($counter == 0){
      				$groupTypeUsers .= '(user=\''.$groupUsers.'\'';
      			} else {
      				$groupTypeUsers .= ' OR user=\''.$groupUsers.'\'';
      			}
      			$counter++;
      		}
      		if ($counter > 0){
      			$groupTypeUsers .= ') AND ';
      		}
      	} else if ($allSelected == true) {
      		$groupTypeUsers = '';
      	}

        // Create search logic for UNIVERSITY
      	$universityLogic = '';
      	$counter = 0;
      	$allSelected = false;
      	foreach ($request['universitySearch'] as $valueType){
      		if ($valueType == 'AllUniversities'){
      			$allSelected = true;
      		}
      	}
      	if ($allSelected == false){
      		foreach ($request['universitySearch'] as $valueType){
      			if ($counter == 0){
      				$universityLogic .= 'SELECT * FROM users WHERE (university=\''.$valueType.'\'';
      			} else {
      				$universityLogic .= ' OR university=\''.$valueType.'\'';
      			}
      			$counter++;
      		}
      		if ($counter > 0){
      			$universityLogic .= ')';
      		}

          $usersUni = '';
          if ($universityLogic){
            $usersUni = \DB::select($universityLogic);
          }

      		$universitySearchUsers = '';
      		$counter = 0;
      		foreach($usersUni as $userUni){
      			$universityUsers = $userUni->username;
      			if ($counter == 0){
      				$universitySearchUsers .= '(user=\''.$universityUsers.'\'';
      			} else {
      				$universitySearchUsers .= ' OR user=\''.$universityUsers.'\'';
      			}
      			$counter++;
      		}
      		if ($counter > 0){
      			$universitySearchUsers .= ') AND ';
      		}
      	} else if ($allSelected == true) {
      		$universitySearchUsers = '';
      	}

        // Get requests from database
      	$sql = "SELECT * FROM sponsorship_adverts WHERE $sponsorshipType $groupTypeUsers $universitySearchUsers (userType='$other_userType') ORDER BY senttime DESC";
        $adverts = \DB::select($sql);
        foreach ($adverts as $advert){
            $advert->avatar = \App\User::where('username', '=', $advert->user)->get()->first()->avatar;
        }

        $this->makeDisplayAdverts($adverts);

        return view('sponsorship-requests', [
          'adverts' => $adverts,
          'user' => Auth::user(),
        ]);
    }

    public function selectAllAdverts(){
        $adverts = \DB::table('sponsorship_adverts')->leftJoin('users', 'sponsorship_adverts.user', '=', 'users.username')
                                                  ->where('sponsorship_adverts.userType','!=',Auth::user()->userType)
                                                  ->where('deletedAdvert','=','0')
                                                  ->orWhere('sponsorship_adverts.userType','!=',Auth::user()->userType)
                                                  ->where('deletedAdvert','=','0')
                                                  ->get()->all();
        return $adverts;
    }

    public function makeDisplayAdverts($adverts){
        foreach ($adverts as $advert) {
            // Creat list of eligible groups
            $advert->eligibleGroups = '';
            $eligibleGroupsArray = explode(",", $advert->eligible);
            foreach ($eligibleGroupsArray as $value) {
              $advert->eligibleGroups .= ''.$value.', ';
            }
            $advert->eligibleGroups = rtrim($advert->eligibleGroups, ', ');
            $advert->eligibleGroups = preg_replace('/(?<!\ )[A-Z]/', ' $0', $advert->eligibleGroups);

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
            $advert->pageUsernameSpace = str_replace("-", " ", $advert->user);
        }
    }

    public function getOtherUserType(){
      if (Auth::user()->userType != 'looking_to_get_sponsored') {
        $other_userType = 'looking_to_get_sponsored';
      } elseif (Auth::user()->userType != 'looking_to_sponsor') {
        $other_userType = 'looking_to_sponsor';
      }
      return $other_userType;
    }

}
