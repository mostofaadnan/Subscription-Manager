<?php

namespace App\Http\Controllers\ManualInvoice;

use App\Http\Controllers\Controller;
use App\Mail\SendPDFMail;
use App\Models\ClientModule\Client;
use Illuminate\Http\Request;
use Mail;
use PDF;

class ManualInvoiceController extends Controller
{

    //__Function for all customer list__//
    public function showAllCustomerinfo()
    {

        $clientData = Client::all();

        return view('admin.pages.manual-invoice.index', compact('clientData'));
    }

    //__Functio for show single customer info__//
    public function showSingleCustomerinfo($id)
    {
        $clientinfo = Client::find($id);

        return view('admin.pages.manual-invoice.singleinvoice', compact([
            'clientinfo',
        ]));
    }

    //__Function for send Customer Report to Email__//
    public function Sendemail(Request $request, $id)
    {
        $emails = Client::select('email')->where('id', $id)->get();
        $report = Client::where('id', $id)->where('client_status', 1)->get();
        $reportData['clientReport'] = $report;
        $pdf = PDF::loadView('pdf.clientreportpdf', $reportData);
        $to_email = $emails;

        Mail::to($to_email)->send(new SendPDFMail($pdf));

        return redirect()->back()->with('message', 'Email Sent to client Successfully');
    }
 

}
