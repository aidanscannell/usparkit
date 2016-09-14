<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use DateTime;
use App\User;
use App\Photos;

class ImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImage()
    {
        return view('resizeImage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImagePost(Request $request)
    {
        $this->validate($request, [
          'description' => 'required',
              'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

          $username = Auth::user()->username;

          $image = $request->file('image');
          $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

          $destinationPath = public_path('/userz/'.$username);
          $thumb_img = Image::make($image->getRealPath());
          $thumb_img->resize(150, 150, function ($constraint) {
                      $constraint->aspectRatio();
                    })->save($destinationPath.'/thumb_'.$input['imagename']);

          $resized_img = Image::make($image->getRealPath());
          $resized_img->resize(300, 300, function ($constraint) {
                      $constraint->aspectRatio();
                    })->save($destinationPath.'/resized_'.$input['imagename']);

          $destinationPath = public_path('/userz/'.$username);
          $image->move($destinationPath, $input['imagename']);

          //$this->postImage->add($input);

          $photos = new Photos;
          $photos->filename = $input['imagename'];
          $photos->user = $username;
          $photos->gallery = $request['description'];
          $photos->avatar = 1;
          $photos->save();

          return back()
            ->with('message','Image Upload successful');
    }
}
