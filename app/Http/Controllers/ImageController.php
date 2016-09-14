<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Auth;

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
          'title' => 'required',
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

          return back()
            ->with('message','Image Upload successful')
            ->with('imageName',$input['imagename']);
    }
}
