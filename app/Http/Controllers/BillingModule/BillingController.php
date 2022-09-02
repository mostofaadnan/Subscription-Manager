<?php

namespace App\Http\Controllers\BillingModule;

use App\Http\Controllers\Controller;
use App\Models\BillingModule\BillingInfo;
use App\Models\ClientModule\Client;
use App\Models\SubscriptionPlan\SubscriptionPlan;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    
     //__Fucntion for Billing Info__//
     public function index()
     {
        $billing_info = BillingInfo::orderBy('id', 'DESC')->get();
 
        //  return view('admin.pages.billing-setting.index', compact('billing'));
        return view('admin.pages.billing-module.index', compact([

            'billing_info',
        ]));
     }

       //__Function for create Billing info//
    public function create()
    {
        $client_info = Client::orderBy('id', 'DESC')
        ->where('client_status', 1)
        ->get();
        $mshipfee = SubscriptionPlan::orderBy('id', 'DESC')->get();
        return view('admin.pages.billing-module.create', compact([
            
            'client_info',
            'mshipfee',
        ]));
    } 


    //__Function for Save Billing Info//
    public function store(Request $request)
    {

        $billinginfo = new BillingInfo();

        $billinginfo->client_id = $request->input('client_id');
        $billinginfo->subcriptplan_id = $request->input('subcriptplan_id');
       

        $billinginfo->save();

        return redirect()->route('admin.billing-info')->with('message', 'Billing info Saved Successfully');
    }

    public function FetchGetData(){

        $apiLiink="https://dus11.octuply.de/riders";
        
    
     //   $url = urlencode ("http://maps.googleapis.com/maps/api/directions/json?origin=" . $origin . "&destination=" . $destination . "&sensor=false");
    
        $datas = json_decode(file_get_contents($apiLiink));

     

      //  return view('admin.pages.billing-module.BillingInfo',compact('datas'));

    }


}
