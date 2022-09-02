<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ClientModule\Client;
use App\Models\MemberShip\MebserShip;
use App\Models\SubscriptionPlan\SubscriptionPlan;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        dd("Login done");
        /*   return view('admin.pages.index');  */

    }

    public function ClientList()
    {
        $clients = Client::orderBy('id', 'DESC')
            ->where('new_request', 0)
            ->latest()
            ->get();
        return Datatables::of($clients)
            ->addIndexColumn()
            ->addColumn('status', function (Client $clients) {
                return $clients->client_status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($clients) {
                $button = '<div class="btn-group" role="group">';
                /*     $button .= '<a class="btn btn-warning btn-sm" id="inactive" data-id="' . $clients->id . '" >Inactive</a>'; */
                $button .= '<button class="btn btn-info btn-sm" id="data-show" data-id="' . $clients->id . '" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Show</button>';

                return $button;
            })
            ->make(true);

    }

    public function ClientActive(Request $request)
    {
        /*  date_default_timezone_set("Asia/Dhaka"); */
        /*  $billingstartdate = date("Y-m-d"); */


        $Client = Client::find($request->id);
        $Client->fleet_rate = $request->fleet_rate;
        $Client->fleet_qty = $request->fleet_qty;
        $Client->user_domain = $request->user_domain;

        $Client->client_status = 1;
        $Client->new_request = 1;
        $Client->update();
        
        return response()->json([
            'status' => 200,
            'message' => 'Client Activate Succesfuly']);
    }

    public function CleintDataGet($id)
    {
        $Client = Client::find($id);
        return response()->json([
            'status' => 200,
            'message' => 'Admin Activate Succesfuly',
            'client' => $Client,

        ]);

    }

    public function ClientInActive($id)
    {
        $Client = Client::find($id);
        $Client->client_status = 0;
        $Client->update();
        return response()->json([
            'status' => 200,
            'message' => 'Admin Diactivate Succesfuly']);
    }


}