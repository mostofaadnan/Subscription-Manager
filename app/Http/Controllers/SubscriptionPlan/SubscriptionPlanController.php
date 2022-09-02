<?php

namespace App\Http\Controllers\SubscriptionPlan;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    
       //__Fucntion for Subscription Plan__//
       public function index()
       {
           $subscriptPlan = SubscriptionPlan::orderBy('id', 'DESC')->get();
           return view('admin.pages.subscripion-plan.index', compact('subscriptPlan'));
       }
   
       //__Function for create Payment Type__//
       public function create()
       {
           return view('admin.pages.subscripion-plan.create');
       } 
   
       //__Function for Save Subscription Plan__//
       public function store(Request $request)
       {
           $validation = $request->validate([
               'name' => 'required | unique:subscription_plans|max:20',
               'amount' => 'required |max:11',
           ]);
   
           $subscriptPlan = new SubscriptionPlan();
   
           $subscriptPlan->name = $request->input('name');
           $subscriptPlan->amount = $request->input('amount');
           $subscriptPlan->description = $request->input('description');
   
           $subscriptPlan->save();
   
           return redirect()->route('admin.subscrip-plan')->with('message', 'Subscription Plan Saved Successfully');
       }
   

}
