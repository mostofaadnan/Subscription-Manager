<?php

namespace App\Http\Controllers\MailAttachment;

use App\Http\Controllers\Controller;
use App\Mail\SendPDFMail;
use App\Models\BillingModule\BillingInfo;
use PDF;
use Mail;
use App\Models\ClientModule\Client;
use Illuminate\Http\Request;

class EmailController extends Controller
{
  public function index()
  {

    /**
     * get data from db
     * and
     * 
     * pass it into array and extract 
     * throw the
     * loop
     */

    $emails = Client::select('email')->get();

    //setup an array and define an object
    $emailList = [];
    $emailNumber = 0;

    //fill the array element by looping corespond of emails query
    foreach ($emails as $clientEmail) {
      $emailList[$emailNumber] = $clientEmail->email;
      $emailNumber++;
    }
    // return $emails;
    //return $emailNumber;
    return $emailList;

    // $client = Client::all();
    // $data['client'] = $client;
    // $pdf = PDF::loadView('pdf.clientreportpdf', $data);
    // $to_email = "badmin@hasanur.com";
    // Mail::to($to_email)->send(new SendPDFMail($pdf));
    // return response()->json(['status' => 'success', 'message' => 'Report has been sent successfully.']);
  }


  //__This Function is for Test Purpose__//
  public function getAllEmail()
  {

    // $client_id = Client::select('id')->first();

    

      $emails = BillingInfo::select('email')->get();

  
        $clientData = BillingInfo::select('id','email')->where('id', 3)->get();

        return $clientData;
       
       
        $clientInvoice['client'] = $clientData;
        
      $pdf = PDF::loadView('pdf.clientreportpdf', $clientInvoice);

      Mail::to($emails)->send(new SendPDFMail($pdf));
      

    
      return response()->json(['status' => 'success', 'message' => 'Report has been sent successfully.']);
    
  }


}
