<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;

class profileController extends Controller
{
    public function view(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.layouts.profile.view-profile', compact('user'));
    }

    public function edit(){
        $id = Auth::user()->id;
        $edits = User::find($id);
        return view('backend.layouts.profile.edit-profile', compact('edits'));
    }

    public function update(Request $request){
         // Validation 
        $request->validate([
          'name'     => 'required',
          'email'    => 'required',
          'mobile'   => 'required'
        ]);
        // update
        $userUpdate = User::find(Auth::user()->id);
        // Image Check
       // Update 
       $userUpdate->name     = $request->name;
       $userUpdate->email    = $request->email;
       $userUpdate->mobile   = $request->mobile;
       $userUpdate->designation_id = $request->designation_id;
       $userUpdate->address  = $request->address;
       $userUpdate->gender  = $request->gender;
       if($request->file('image')){
         $file = $request->file('image');
          @unlink(public_path('assets/backend/images/'.$userUpdate->image));
          $fileName = date('YmdHi'). $file->getClientOriginalName();
          $file->move(public_path('assets/backend/images'), $fileName);
          $userUpdate['image'] = $fileName;
       }
       $userUpdate->save();
       // Redirect
       return redirect()->route('profile.view')->with('success', 'Profile Updated Successfully');
    }

    public function passwordView(){
      return view('backend.layouts.profile.passwordChange');
    }
    //---- users Password Update ----//
    public function passwordUpdate(Request $request){
          if(Auth::attempt(['id'=>Auth::user()->id, 'password'=>$request->current_password])){
            // validation
            $validation = $request->validate([
              'password' => 'required|confirmed'
            ]);
            // Change Password
            $user = User::find(Auth::user()->id);
            $user->update([
              'password' => Hash::make($request->password)
            ]);
            // Redirect
            return redirect()->route('profile.view')->with('success','Your Password Update Successfully');
          } else{
            return redirect()->back()->with('error','Your Current Password Does Not Match');
          }
    }
}
