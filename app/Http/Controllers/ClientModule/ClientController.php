<?php

namespace App\Http\Controllers\ClientModule;

use App\Http\Controllers\Controller;
use App\Mail\SendPDFMail;
use App\Models\clientInvoice;
use App\Models\ClientModule\Client;
use App\Models\MemberShip\MebserShip;
use App\Models\SubscriptionPlan\SubscriptionPlan;
use DataTables;
use Illuminate\Http\Request;
use Mail;
use PDF;

class ClientController extends Controller
{

    //__Fucntion for Billing Setting__//
    public function index()
    {

        /*   $clients = Client::orderBy('id', 'DESC')->get();
        // $membership = MebserShip::orderBy('id', 'DESC')->get();

        return view('admin.pages.client-module.index', compact([
        'clients',
        // 'membership',
        ])); */

        return view('admin.pages.client-module.index');
    }
    public function LoadAll()
    {
        $clients = Client::orderBy('id', 'ASC')
            ->where('client_status', 1)
            ->latest()
            ->get();
        return Datatables::of($clients)
            ->addIndexColumn()
            ->addColumn('status', function (Client $clients) {
                return $clients->client_status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($clients) {
                $button = '<div class="btn-group" role="group">';
                $button .= '<a href="' . route('admin.edit-clientinfo', $clients->id) . '"><button class="btn btn-success btn-sm px-3">Edit</button></a>';
                $button .= '<a class="btn btn-info btn-sm" id="inactive" data-id="' . $clients->id . '">InActive</a>';
                return $button;
            })
            ->make(true);
    }
    //__Function for create Billing Setting__//
    public function create()
    {
       
        return view('admin.pages.client-module.create');
    }

    //__Function for Save Client info//
    public function store(Request $request)
    {
        $validation = $request->validate([
            'company_name' => 'required | max:700',
            'full_name' => 'required | max:100',
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
        $clientinfo->billing_startdate = $request->input('billing_startdate');
        $clientinfo->user_domain = $request->input('user_domain');
        $clientinfo->fleet_rate = $request->input('fleet_rate');
        $clientinfo->fleet_qty = $request->input('fleet_qty');
        $clientinfo->client_status = 0;
        $clientinfo->new_request = 0;
        $clientinfo->address = $request->input('address');

        $clientinfo->save();

        return redirect()->route('admin.clinet-info')->with('message', 'Client info Saved Successfully');
    }

    //__Function for Edit Client info__//
    public function edit($id)
    {

        $clientinfo = Client::find($id);

        return view('admin.pages.client-module.edit', compact([
            'clientinfo',
        ]));
    }

    //__Fucntion for Update  Client info__//
    public function update(Request $request, $id)
    {

        $clientinfo = Client::find($id);

        $clientinfo->company_name = $request->input('company_name');
        $clientinfo->full_name = $request->input('full_name');
        $clientinfo->email = $request->input('email');
        $clientinfo->phone = $request->input('phone');
        $clientinfo->city = $request->input('city');
        $clientinfo->post_code = $request->input('post_code');
        $clientinfo->instance_name = $request->input('instance_name');
        /* $clientinfo->billing_startdate = $request->input('billing_startdate'); */
        $clientinfo->user_domain = $request->input('user_domain');
        $clientinfo->fleet_rate = $request->input('fleet_rate');
        $clientinfo->fleet_qty = $request->input('fleet_qty');
        $clientinfo->client_status = $request->input('client_status');
        $clientinfo->address = $request->input('address');

        // return $clientinfo;

        $clientinfo->update();

        return redirect()->route('admin.clinet-info')->with('message', 'Client info Updated Successfully');
    }

    //__function for Delete Client info__//
    public function destroy($id)
    {
        $membership = Client::find($id);

        $membership->delete();

        return redirect()->back()->with('message', 'Client info deleted Successfully');
    }

    //inactive Client

    public function Inactivecleint()
    {
        return view('admin.pages.client-module.inactive');
    }
    public function LoadInactive()
    {
        $clients = Client::orderBy('id', 'DESC')
            ->where('client_status', 0)
            ->latest()
            ->get();
        return Datatables::of($clients)
            ->addIndexColumn()
            ->addColumn('status', function (Client $clients) {
                return $clients->client_status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($clients) {
                $button = '<div class="btn-group" role="group">';
                $button .= '<a href="' . route('admin.edit-clientinfo', $clients->id) . '"><button class="btn btn-success btn-sm px-3">Edit</button></a>';
                $button .= '<a class="btn btn-warning btn-sm" id="inactive" data-id="' . $clients->id . '">InActive</a>';
                return $button;
            })
            ->make(true);
    }

    

}