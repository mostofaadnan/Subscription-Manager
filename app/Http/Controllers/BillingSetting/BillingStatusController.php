<?php

namespace App\Http\Controllers\BillingSetting;

use App\Http\Controllers\Controller;
use App\Models\BillingSetting\BillingStatus;
use Illuminate\Http\Request;

class BillingStatusController extends Controller
{
    
    //__Fucntion for Billing Setting__//
    public function index()
    {
        $billing = BillingStatus::orderBy('id', 'DESC')->get();

        return view('admin.pages.billing-setting.index', compact('billing'));
    }

    //__Function for create Billing Setting__//
    public function create()
    {
        return view('admin.pages.billing-setting.create');
    } 

    //__Function for Save Billing Setting__//
    public function store(Request $request)
    {
        $validation = $request->validate([
            'status' => 'required | unique:billing_statuses|max:20',
        ]);

        $billingSetting = new BillingStatus();

        $billingSetting->status = $request->input('status');
        $billingSetting->remark = $request->input('remark');

        $billingSetting->save();

        return redirect()->route('admin.billing-status')->with('message', 'Billing Settings Saved Successfully');
    }

}
