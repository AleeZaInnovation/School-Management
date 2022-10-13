<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

class usersController extends Controller
{
    //---- users view ----//
    public function view(){
        $users = User::where('usertype','Admin')->get();
        //dd($users->toArray());
    	
      return view('backend.layouts.users.usersView', compact('users'));
    }
    //---- users Add ----//
    public function add(){
    	return view('backend.layouts.users.usersAdd');
    }
    //---- users Store ----//
    public function store(Request $request){
        // Validation
        $request->validate([
          'name'     => 'required',
          'email'    => 'required|unique:users,email',
        ]);
        if($request->file('image')){
         $file = $request->file('image');
          $fileName = date('YmdHi'). $file->getClientOriginalName();
          $file->move(public_path('assets/backend/images'), $fileName);          
       }
 
       // insert data
       $code = rand(0000,9999);
       $data = new User;
       $data->usertype = 'Admin';
       $data->role     = $request->role;
       $data->name     = $request->name;
       $data->email    = $request->email;
       $data->password =bcrypt($code);
       $data->code   = $code;
       if($request->file('image')){
         $file = $request->file('image');
          $fileName = date('YmdHi'). $file->getClientOriginalName();
          $file->move(public_path('assets/backend/images'), $fileName);
       $data['image'] = $fileName;          
       }
       $data->save();

       // Redirect 
      return redirect()->route('users.view')->with('success', 'User Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
    	$userEdit['edits'] = User::find($id);
    	return view('backend.layouts.users.usersEdit', $userEdit);
    }
    //---- users Update ----//
    public function update($id, Request $request){
         // Validation 
    	$request->validate([
          'name'     => 'required',
          'email'    => 'required',
        ]);
        // update
        $userUpdate = User::find($id);
        // Image Check
       // Update 
       $userUpdate->name     = $request->name;
       $userUpdate->email    = $request->email;
       $userUpdate->role     = $request->role;
       if($request->file('image')){
         $file = $request->file('image');
          @unlink(public_path('assets/backend/images/'.$userUpdate->image));
          $fileName = date('YmdHi'). $file->getClientOriginalName();
          $file->move(public_path('assets/backend/images'), $fileName);
          $userUpdate['image'] = $fileName;
       }
       $userUpdate->save();
       // Redirect
       return redirect()->route('users.view')->with('success', 'User Updated Successfully');
    }
    //---- users Delete ----//
    public function delete($id){
        $userDelete = User::find($id);
        if (file_exists('public/assets/backend/images/'. $userDelete->image) AND ! empty($userDelete->image)){
        unlink('public/assets/backend/images/'. $userDelete->image);
        }
        $userDelete->delete();
        return redirect()->route('users.view')->with('success', 'User Deleted Successfully');
    }
    //---- users Password View ----//
    public function passwordView(){
      return view('backend.layouts.users.passwordChange');
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
            return redirect()->back()->with('success','Your Password Update Successfully');
          } else{
            return redirect()->back()->with('error','Your Current Password Not Match');
          }
    }
}
