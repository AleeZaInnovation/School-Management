<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Slider;
use Hash;

class sliderController extends Controller
{
    //
    public function view(){
        $data['sliders'] = Slider::all();
        //dd($users->toArray());
        
      return view('backend.layouts.slider.slidersView', $data);
    }
    //---- users Add ----//
    public function add(){
        return view('backend.layouts.slider.slidersAdd');
    }
    //---- users Store ----//
    public function store(Request $request){
        // image
         
       // insert data
        
       $data = new Slider;
       $data->short_title = $request->short_title;
       $data->long_title = $request->long_title;
       $data->created_by = Auth::user()->id;
       if($request->file('image')){
         $file = $request->file('image');
          $fileName = date('YmdHi'). $file->getClientOriginalName();
          $file->move(public_path('assets/backend/images/sliders'), $fileName);
       $data['image'] = $fileName;          
       }
       $data->save();

       // Redirect 
      return redirect()->route('sliders.view')->with('success', 'Slider Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        $sliderEdit['edits'] = Slider::find($id);
        return view('backend.layouts.slider.slidersEdit', $sliderEdit);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
        // update
        $userUpdate = Slider::find($id);
        $userUpdate->updated_by = Auth::user()->id;
        // Image Check
       // Update
       $userUpdate->short_title = $request->short_title;
       $userUpdate->long_title = $request->long_title;
       if($request->file('image')){
         $file = $request->file('image');
          @unlink(public_path('assets/backend/images/sliders/'.$userUpdate->image));
          $fileName = date('YmdHi'). $file->getClientOriginalName();
          $file->move(public_path('assets/backend/images/sliders'), $fileName);
          $userUpdate['image'] = $fileName;
       }
       $userUpdate->save();
       // Redirect
       return redirect()->route('sliders.view')->with('success', 'Slider Updated Successfully');
    }
    //---- users Delete ----//
    public function delete($id){
        $slider = Slider::find($id);
        if (file_exists('public/assets/backend/images/sliders/'. $slider->image) AND ! empty($slider->image)){
        unlink('public/assets/backend/images/sliders/'. $slider->image);
        }
        $slider->delete();
        return redirect()->route('sliders.view')->with('success', 'Slider Deleted Successfully');
    }
}
