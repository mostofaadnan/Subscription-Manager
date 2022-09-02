<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\Models\clientInvoice;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ClientModule\Client;
use Illuminate\Http\Request;
use PDF;
use Mail;
use App\Mail\SendPDFMail;
class InvoiceController extends Controller
{

    public function index()
    {

        return view('admin.pages.invoice.index');
    }

    public function LoadAll()
    {
        $InvoiceList = clientInvoice::orderBy('id', 'DESC')->get();
        return Datatables::of($InvoiceList)
            ->addIndexColumn()
            ->addColumn('name', function (clientInvoice $InvoiceList) {
                return $InvoiceList->clinet_Info->full_name;
            })
            ->addColumn('email', function (clientInvoice $InvoiceList) {
                return $InvoiceList->clinet_Info->email;
            })
            ->addColumn('company', function (clientInvoice $InvoiceList) {
                return $InvoiceList->clinet_Info->company_name;
            })
        /*  ->addColumn('payment-status', function (InvoiceList $InvoiceList) {
        return $InvoiceList->invoice_status == 1 ? 'Paid' : 'Unpaid';
        }) */
            ->addColumn('action', function ($InvoiceList) {
                $button = '<div class="btn-group" role="group">';
                $button .= '<a class="btn btn-success btn-sm" id="invoicePdf" data-id="' . $InvoiceList->id . '">View</a>';
                /*     if ($InvoiceList->invoice_status == 0) {
            $button .= '<a class="btn btn-primary btn-sm" id="paymentInvoice" data-id="' . $InvoiceList->id . '">Payment</a>';
            } else {
            $button .= '<a class="btn btn-success btn-sm" id="invoicePdf" data-id="' . $InvoiceList->id . '">PDF</a>';
            } */
                return $button;
            })
            ->make(true);
    }

    public function InvoicePdf($invoiceId)
    {
        $clientInvoice = clientInvoice::find($invoiceId);
        $year = date("Y");
        $clientinfo = Client::find($clientInvoice->client_id);
        $pdf = PDF::loadView('pdf.invoice', compact('clientInvoice', 'clientinfo','year'));
        return $pdf->stream('invoice.pdf');
    }


    //Manually Invoice
    public function clientInfo(){

        return view('admin.pages.invoice.clientinfo');
    }
    public function ClientInfoLoad()
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
                if ($clients->user_domain != null) {
                    $button .= '<a href="' . route('invoice.clientinfo.billinfo', $clients->id) . '"><button class="btn btn-success btn-sm px-3">Make Invoice</button></a>';
                }

                return $button;
            })
            ->make(true);
    }



    public function FetchGetData($id)
    {

        $clientinfo = Client::find($id);
        $invoiceNumber = $this->generateUniqueCode($id);
        date_default_timezone_set("Asia/Dhaka");
        $invoice_date = date("d/m/Y");
        $apiLiink = $clientinfo->user_domain;
        $datas = json_decode(file_get_contents($apiLiink));
        $totalDrivers = count($datas);

        return view('admin.pages.invoice.BillingInfo', compact('datas', 'clientinfo', 'invoiceNumber', 'invoice_date', 'totalDrivers'));

    }

    public function generateUniqueCode($id)
    {
        /*  do {
        $code = random_int(100000, 999999);
        } while (clientInvoice::where("id", "=", $code)
        ->where('client_id', $id)
        ->first());

        return $code; */
      
        $clientinfo = clientInvoice::where('client_id', $id)
            ->latest()
            ->first();
        if (!is_null($clientinfo)) {
            $invoiceNumber = ($clientinfo->invoice_number + 1);
        } else {
            $invoiceNumber = 1;
        }
        return $invoiceNumber;
    }

    public function MakeInvoice(Request $request)
    {

        $clientInvoice = new clientInvoice();
        $clientInvoice->client_id = $request->client_id;
        $clientInvoice->invoice_number = $request->invoice_number;
        $clientInvoice->invoice_date = $request->invoice_date;
        $clientInvoice->client_rate = $request->client_rate;
        $clientInvoice->client_qty = $request->client_qty;
        $clientInvoice->client_amount = $request->client_amount;
        $clientInvoice->driver_rate = $request->driver_rate;
        $clientInvoice->driver_qty = $request->driver_qty;
        $clientInvoice->driver_amount = $request->driver_amount;
        $clientInvoice->total_amount = $request->total_amount;
        $clientInvoice->total_vat = $request->total_vat;
        $clientInvoice->nettotal = $request->nettotal;
        if ($clientInvoice->save()) {
            $this->Sendemail($clientInvoice);
        }
        return redirect()->route('invoice.clientinfo')->with('message', 'Client Invoice Saved Successfully');

    }

    public function AutomaticMail()
    {

        $clientlist = Client::all();
        foreach ($clientlist as $list) {

            $apiLiink = $list->user_domain;

            if ($apiLiink != null) {
                $datas = json_decode(file_get_contents($apiLiink));
                $totalDrivers = count($datas);

                $invoiceNumber = $this->generateUniqueCode($list->id);
                date_default_timezone_set("Asia/Dhaka");
                $invoice_date = date("d/m/Y");

                $client_fleet_rate = $list->fleet_rate;
                $client_fleet_qty = $list->fleet_qty;
                $client_amount = number_format($client_fleet_rate * $client_fleet_qty, 2);

                $driver_rate = 5.5;
                $dirver_qty = $totalDrivers;
                $driver_amount = number_format($driver_rate * $dirver_qty, 2);

                $totalamount = number_format($client_amount + $client_amount, 2);
                $vat = 0.19;
                $itemvat = number_format($totalamount * $vat, 2);
                $nettotal = number_format($totalamount + $itemvat, 2);

                $clientInvoice = new clientInvoice();
                $clientInvoice->client_id = $list->id;
                $clientInvoice->invoice_number = $invoiceNumber;
                $clientInvoice->invoice_date = $invoice_date;
                $clientInvoice->client_rate = $client_fleet_rate;
                $clientInvoice->client_qty = $client_fleet_qty;
                $clientInvoice->client_amount = $client_amount;
                $clientInvoice->driver_rate = $driver_rate;
                $clientInvoice->driver_qty = $dirver_qty;
                $clientInvoice->driver_amount = $driver_amount;
                $clientInvoice->total_amount = $totalamount;
                $clientInvoice->total_vat = $itemvat;
                $clientInvoice->nettotal = $nettotal;
                if ($clientInvoice->save()) {
                    $this->Sendemail($clientInvoice);
                }
            }
        }
    }

    public function Sendemail($clientInvoice)
    {
        $year = date("Y");
        $clientinfo = Client::find($clientInvoice->client_id);
        $to_email = $clientinfo->email;
        $pdf = PDF::loadView('pdf.invoice', compact('clientInvoice', 'clientinfo','year'));
        /* $createInvoice->email */;
        Mail::to($to_email)->send(new SendPDFMail($pdf));

    }
}