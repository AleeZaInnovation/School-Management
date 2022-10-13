<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountOtherCost;

class OtherCostController extends Controller
{
    //
    public function view(){        
        $data['data'] = AccountOtherCost::orderBy('id','DESC')->get();
        
      return view('backend.layouts.account.cost.view', $data);
    }
    //---- employee Add ----//
    public function add(){
        return view('backend.layouts.account.cost.add-edit');
    }
    //---- users Store ----//
    public function store(Request $request){

        $data = new AccountOtherCost();
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->amount = $request->amount;
          if($request->file('image')){
            $file = $request->file('image');
              $fileName = date('YmdHi'). $file->getClientOriginalName();
              $file->move(public_path('assets/backend/images/cost'), $fileName);
          $data['image'] = $fileName;          
          }
        $data->description = $request->description;
        $data->save();

      return redirect()->route('accounts.others.cost.view')->with('success', 'Others Cost Added Successfully');

    }
    //---- users Edit ----//
    public function edit($id){
        //dd('ok');
        $data['edits'] = AccountOtherCost::find($id);       
        return view('backend.layouts.account.cost.add-edit',$data);
    }
    //---- users Update ----//
    public function update($id, Request $request){
        $data = AccountOtherCost::find($id);
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->amount = $request->amount;
        $data->amount = $request->amount;
          if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('assets/backend/images/cost/'.$data->image));
              $fileName = date('YmdHi'). $file->getClientOriginalName();
              $file->move(public_path('assets/backend/images/cost'), $fileName);
          $data['image'] = $fileName;          
          }
        $data->description = $request->description;
        $data->save();
      
        return redirect()->route('accounts.others.cost.view')->with('success', 'Others Cost Updated Successfully');
      
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

  public function details($id){
    $data['details'] = AccountOtherCost::find($id);
    $pdf = PDF::loadView('backend.layouts.pdf.employee-details', $data);
    //$pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('Employee_Registration_Card.pdf');
  }

  
  //
}
