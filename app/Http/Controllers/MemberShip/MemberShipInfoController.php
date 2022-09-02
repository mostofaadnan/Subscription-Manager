<?php

namespace App\Http\Controllers\MemberShip;

use App\Http\Controllers\Controller;
use App\Models\MemberShip\MebserShip;
use Illuminate\Http\Request;

class MemberShipInfoController extends Controller
{
     //__Fucntion for Membership info__//
     public function index()
     {
         $membership = MebserShip::orderBy('id', 'DESC')->get();
 
         return view('admin.pages.membership.index', compact('membership'));
     }
 
     //__Function for create Membership info__//
     public function create()
     {
         return view('admin.pages.membership.create');
     } 
 
     //__Function for Save Membership info__//
     public function store(Request $request)
     {
         $validation = $request->validate([
             'name' => 'required | unique:mebser_ships|max:20',
             'amount' => 'required |max:11',
         ]);
 
         $membership = new MebserShip();
 
         $membership->name = $request->input('name');
         $membership->amount = $request->input('amount');
         $membership->description = $request->input('description');
 
         $membership->save();
 
         return redirect()->route('admin.member-plan')->with('message', 'Membership info Saved Successfully');
     }

     //__Function for Edit membership plan__//
    public function edit($id)
    {
        $membership = MebserShip::find($id);

        return view('admin.pages.membership.edit', compact('membership'));
    }


    
      //__Fucntion for Update  membership plan__//
      public function update(Request $request, $id)
      {
          $membership = MebserShip::find($id);
  
          $membership->name = $request->input('name');
          $membership->amount = $request->input('amount');
  
          $membership->update();
  
          return redirect()->route('admin.member-plan')->with('message', 'Membership Plan Updated Successfully');
      }

        //__function for Delete membership plan__//
    public function destroy($id)
    {
        $membership = MebserShip::find($id);
        $membership->delete();
        return redirect()->back()->with('message', 'Membership info deleted Successfully');
    }


    //__Function for get all membership plan__//
    public function allmemberplan()
    {
       $membership = MebserShip::orderBy('id', 'DESC')->get();
       return view('admin.pages.membership.memberplan', compact('membership'));
    }

}
