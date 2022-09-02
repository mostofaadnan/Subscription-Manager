<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\ClientModule\Client;
use App\Models\SubscriptionPlan\SubscriptionPlan;
use Illuminate\Http\Request;

class ClientControler extends Controller
{
    public function index()
    {
        return view('FrontEnd.newClient');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'company_name' => 'required | max:700',
            'full_name' => 'required | max:50',
            'email' => 'required | unique:client|max:50',
            'phone' => 'required | max:20',
            'instance_name' => 'required | max:300',
            'city' => 'required | max:700',
        ]);

        $clientinfo = new Client();

        $clientinfo->company_name = $request->input('company_name');
        $clientinfo->full_name = $request->input('full_name');
        $clientinfo->email = $request->input('email');
        $clientinfo->phone = $request->input('phone');
        $clientinfo->city = $request->input('city');
        $clientinfo->post_code = $request->input('post_code');
        $clientinfo->instance_name = $request->input('instance_name');
        $clientinfo->client_status = 0;
        $clientinfo->new_request = 0;
        $clientinfo->address = $request->input('address');
        if ($clientinfo->save()) {
            return redirect()->route('newClient')->with('success', 'Client Request Successfully! we Will Approved after check your information');
        } else {

            return redirect()->route('newClient')->with('fail', 'Fail to send New Client Request');
        }

    }
}
