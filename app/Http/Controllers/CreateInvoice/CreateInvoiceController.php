<?php

namespace App\Http\Controllers\CreateInvoice;

use App\Http\Controllers\Controller;
use App\Mail\SendPDFMail;
use App\Models\ClientModule\Client;
use App\Models\CreateManualInvoice\CreateManualInvoiceModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DataTables;
use Illuminate\Http\Request;
use Mail;
use PDF;

class CreateInvoiceController extends Controller
{

    //__Function for get all Client Data__//
    public function GetClientData()
    {
        $clientData = Client::where('client_status', 1)->get();

        return view('admin.pages.create-invoice-module.index', compact([
            'clientData',
        ]));
    }

    //__Function for Show Single Client Data__//
    public function GetSingleClientData($id)
    {

        $clientinfo = Client::find($id);
        return view('admin.pages.create-invoice-module.single-client', compact([
            'clientinfo',
        ]));
    }

    //__Function for Create Manual Invoice__//
    public function CreateInvoice($id)
    {
        $clientinfo = Client::find($id);

        $invoiceNumber = $this->generateUniqueCode();
        date_default_timezone_set("Asia/Dhaka");
        $invoice_date = date("d/m/Y");
        return view('admin.pages.create-invoice-module.create-invoice', compact([
            'clientinfo', 'invoiceNumber', 'invoice_date',
        ]));
    }
    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (CreateManualInvoiceModel::where("id", "=", $code)->first());

        return $code;
    }
    //__Fucntion for Store Manual Invoice__//
    public function StoreManualInvoice(Request $request)
    {
        $currentD = Carbon::now();
        $c = $currentD->format('Y-m-d');
        $lasPaymentDate = $currentD->addDays(7)->format('Y-m-d');

        $createInvoice = new CreateManualInvoiceModel;
        $createInvoice->invoice_number = $request->input('invoice_number');
        $createInvoice->client_id = $request->input('client_id');
        $createInvoice->subscription_id = $request->input('subscription_id');
        $createInvoice->monthly_subs_billamount = $request->input('monthly_subs_billamount');
        $createInvoice->total_unpaid_month = $request->input('total_unpaid_month');
        $createInvoice->invoice_months = $request->input('invoice_months');
        $createInvoice->total_billing_main_amount = $request->input('main_amount');
        $createInvoice->total_billing_vat_amount = $request->input('vat_amount');
        $createInvoice->total_billing_amount = $request->input('totalamount');
        $createInvoice->nettotal = $request->input('total_billing_amount');
        $createInvoice->invoice_status = 0;
        date_default_timezone_set("Asia/Dhaka");
        $invoice_date = date("d/m/Y");
        $invoice_time = date("h:i:sa");
        $createInvoice->invoice_date = $invoice_date;
        $createInvoice->invoice_time = $invoice_time;
        /* $lastDate_of_payment = strtotime("+7 day"); */
        $createInvoice->last_date_of_payment =$lasPaymentDate;
        $createInvoice->membership_amount = $request->input('membership_amount');
        $createInvoice->save();
        $this->Sendemail($createInvoice);
        return redirect()->route('admin.client-data')->with('message', 'Manual Invoice Created And Sent to Client Email Successfully');
    }

    //__Function for send Customer Report to Email__//

    //__Fucntion for Show ALl Manual Invoice__//
    public function LoadAll()
    {
        $InvoiceList = CreateManualInvoiceModel::orderBy('id', 'DESC')->get();
        return Datatables::of($InvoiceList)
            ->addIndexColumn()
            ->addColumn('clientInfo-name', function (CreateManualInvoiceModel $InvoiceList) {
                return $InvoiceList->clinet_Info->full_name;
            })
            ->addColumn('clientInfo-email', function (CreateManualInvoiceModel $InvoiceList) {
                return $InvoiceList->clinet_Info->email;
            })
            ->addColumn('subscription-Plan', function (CreateManualInvoiceModel $InvoiceList) {
                return $InvoiceList->subscription_plans->name;
            })
            ->addColumn('payment-status', function (CreateManualInvoiceModel $InvoiceList) {
                return $InvoiceList->invoice_status == 1 ? 'Paid' : 'Unpaid';
            })
            ->addColumn('action', function ($InvoiceList) {
                $button = '<div class="btn-group" role="group">';
                if ($InvoiceList->invoice_status == 0) {
                    $button .= '<a class="btn btn-primary btn-sm" id="paymentInvoice" data-id="' . $InvoiceList->id . '">Payment</a>';
                } else {
                    $button .= '<a class="btn btn-success btn-sm" id="invoicePdf" data-id="' . $InvoiceList->id . '">PDF</a>';
                }
                return $button;
            })
            ->make(true);
    }
    public function GetAllInvoice()
    {
        return view('admin.pages.create-invoice-module.allinvoice');
    }
    public function Payment($invoiceId)
    {

        $invoice = CreateManualInvoiceModel::find($invoiceId);
        $memberShipAmt = $invoice->membership_amount;
        $PaymentlastPaymentDate = $invoice->last_date_of_payment;

        $start_bilingDate = $PaymentlastPaymentDate;
        $last = Carbon::parse($PaymentlastPaymentDate);

        $lastPayment_Date_update = $last->addDays(30)->format('Y-m-d');
        $client_id = $invoice->client_id;
        $this->ClientUpdate($client_id, $start_bilingDate, $lastPayment_Date_update, $memberShipAmt);
        $invoice->invoice_status = 1;
        $invoice->update();
        return response()->json([
            'status' => 200,
            'message' => 'Payment Invoice Successfuly',
        ]);
    }
    public function ClientUpdate($id, $start_bilingDate, $lastPayment_Date, $memberShipAmt)
    {
        $client = Client::find($id);
        $client->billing_startdate = $start_bilingDate;
        $client->lastpasyment = $lastPayment_Date;
        if ($memberShipAmt > 0) {
            $client->subscription_payment = 1;
        }
        $client->update();

    }

    public function InvoicePdf($invoiceId)
    {
        $createInvoice = CreateManualInvoiceModel::find($invoiceId);
        $pdf = PDF::loadView('pdf.invoicereportpdf', compact('createInvoice'));
        return $pdf->stream('invoice.pdf');
    }

    /* public function AutometicMail()
    {
    date_default_timezone_set("Asia/Dhaka");
    $clients = Client::where('client_status', 1)->get();

    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
    echo '<div class="container"><div class="row"><div class="mt-3">';
    echo '<h1>Invoice Information</h1>';
    echo '<table class="table table-bordered">';
    echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Amount</th>';
    echo '<th>Unpaid Month</th>';
    echo '<th>Total Amount</th>';
    echo '<th>Main Amount</th>';
    echo '<th>Item vat</th>';
    echo '<th>Membership Amount</th>';
    echo '<th>Nettotal</th>';
    echo '</tr>';
    $currentD = Carbon::now();
    $c = $currentD->format('Y-m-d');
    echo '<h2>Current Date:' . $c . '</h2>';
    foreach ($clients as $client) {
    //membership amount
    $membershipamount = $this->CheckMembershipAmount($client->id);
    $name = $client->full_name;
    //Upadte Date

    $billingstartdate = $client->billing_startdate;
    $lastpaymentdate = $client->lastpasyment;

    $start = Carbon::parse($billingstartdate);
    $checkDealine = Carbon::parse($lastpaymentdate);

    //  current Date

    $totalDay_after_last_Payment = $start->diffInDays($c);
    if ($checkDealine->isPast()) {
    if ($totalDay_after_last_Payment > 29) {
    $Day = $totalDay_after_last_Payment;
    $month = (int) ($Day / 30);
    $end = $start->addMonths($month)->format('Y-m-d');
    $this->UpdateLastPayment($client->id, $end);
    } else {
    $end = Carbon::parse($lastpaymentdate);
    $Day = $start->diffInDays($checkDealine);
    $month = (int) ($Day / 30);
    }

    } else {

    $end = Carbon::parse($lastpaymentdate);
    $Day = $start->diffInDays($checkDealine);
    $month = (int) ($Day / 30);

    }

    //Create Invoice

    $vat = (19 / 100);
    $amount = $client->subscription_plans->amount;
    $unpaidmonth = $month;
    $totalamount = number_format($amount * $unpaidmonth, 2);
    $mainamount = number_format(($totalamount / ($vat + 1)), 2);
    $itemvat = number_format(($totalamount - $mainamount), 2);
    $netttoal = number_format(($totalamount + $membershipamount), 2);
    //Invoice Month
    $result = CarbonPeriod::create($start, '1 month', $end);
    $invoicemonth = array();
    foreach ($result as $dt) {
    $invoicemonth[] = $dt->format("M-Y");

    }
    $invmonth = implode(",", $invoicemonth);

    echo '<tr>';
    echo '<td>' . $name . '</td>';
    echo '<td>' . $amount . '</td>';
    echo '<td>' . $unpaidmonth . '</td>';
    echo '<td>' . $totalamount . '</td>';
    echo '<td>' . $mainamount . '</td>';
    echo '<td>' . $itemvat . '</td>';
    echo '<td>' . $membershipamount . '</td>';
    echo '<td>' . $netttoal . '</td>';
    echo '</tr>';

    $CreateManualInvoiceModel = CreateManualInvoiceModel::where('client_id', $client->id)->where('invoice_status', 0)->first();
    $invoiceNumber = $this->generateUniqueCode();
    $createInvoice = new CreateManualInvoiceModel;
    $createInvoice->invoice_number = $invoiceNumber;
    $createInvoice->client_id = $client->id;
    $createInvoice->subscription_id = $client->subscription_plans->id;
    $createInvoice->monthly_subs_billamount = $amount;
    $createInvoice->total_unpaid_month = $unpaidmonth;
    $createInvoice->invoice_months = $invmonth;
    $createInvoice->total_billing_main_amount = $mainamount;
    $createInvoice->total_billing_vat_amount = $itemvat;
    $createInvoice->total_billing_amount = $totalamount;
    $createInvoice->nettotal = $netttoal;
    $createInvoice->invoice_status = 0;
    $invoice_date = date("d/m/Y");
    $invoice_time = date("h:i:sa");
    $createInvoice->invoice_date = $invoice_date;
    $createInvoice->invoice_time = $invoice_time;
    $createInvoice->last_date_of_payment = $end;
    $createInvoice->membership_amount = $membershipamount;

    if ($this->CheckDuplicate($CreateManualInvoiceModel, $createInvoice)) {

    if (!is_null($CreateManualInvoiceModel)) {
    $CreateManualInvoiceModel->delete();
    }
    $createInvoice->emailsend = 0;
    $createInvoice->save();
    }
    }
    $checkLastDateFromNow = $currentD->addDays(7)->format('Y-m-d');

    $sendMailInvoices = CreateManualInvoiceModel::where('invoice_status', 0)
    ->where('emailsend', 0)
    ->where('last_date_of_payment', $checkLastDateFromNow)
    ->get();

    foreach ($sendMailInvoices as $sendmailInvoice) {
    echo 'name:' . $sendmailInvoice->clinet_Info->full_name . '<br>Invoice Number:' . $sendmailInvoice->invoice_number . '<br>' . $sendmailInvoice->last_date_of_payment . '<br><hr>';
    $this->SendAutoMail($sendmailInvoice);
    }

    echo '</table></div></div></div>';

    }
     */

    public function AutometicMail()
    {
        date_default_timezone_set("Asia/Dhaka");
        $currentD = Carbon::now();
        $c = $currentD->format('Y-m-d');
        $checkLastDateFromNow = $currentD->addDays(7)->format('Y-m-d');
     
        $clients = Client::where('client_status', 1)
            ->where('new_request', 1)
            ->where('lastpasyment', $checkLastDateFromNow)
            ->get();

        foreach ($clients as $client) {
            //membership amount
            $membershipamount = $this->CheckMembershipAmount($client->id);
            //Upadte Date
            $billingstartdate = $client->billing_startdate;
            $lastpaymentdate = $client->lastpasyment;

            $start = Carbon::parse($billingstartdate);
            $checkDealine = Carbon::parse($lastpaymentdate);
            //  current Date
            $totalDay_after_last_Payment = $start->diffInDays($c);
            if ($checkDealine->isPast()) {
                if ($totalDay_after_last_Payment > 29) {
                    $Day = $totalDay_after_last_Payment;
                    $month = (int) ($Day / 30);
                    $end = $start->addMonths($month)->format('Y-m-d');
                    $this->UpdateLastPayment($client->id, $end);
                } else {
                    $end = Carbon::parse($lastpaymentdate);
                    $Day = $start->diffInDays($checkDealine);
                    $month = (int) ($Day / 30);
                }

            } else {

                $end = Carbon::parse($lastpaymentdate);
                $Day = $start->diffInDays($checkDealine);
                $month = (int) ($Day / 30);

            }
            //Create Invoice
            $vat = (19 / 100);
            $amount = $client->subscription_plans->amount;
            $unpaidmonth = $month;
            $totalamount = number_format($amount * $unpaidmonth, 2);
            $mainamount = number_format(($totalamount / ($vat + 1)), 2);
            $itemvat = number_format(($totalamount - $mainamount), 2);
            $netttoal = number_format(($totalamount + $membershipamount), 2);
            //Invoice Month
            $result = CarbonPeriod::create($start, '1 month', $end);
            $invoicemonth = array();
            foreach ($result as $dt) {
                $invoicemonth[] = $dt->format("M-Y");
            }
            $invmonth = implode(",", $invoicemonth);
            //Create New Invoice
            $CreateManualInvoiceModel = CreateManualInvoiceModel::where('client_id', $client->id)->where('invoice_status', 0)->first();
            $invoiceNumber = $this->generateUniqueCode();
            $createInvoice = new CreateManualInvoiceModel;
            $createInvoice->invoice_number = $invoiceNumber;
            $createInvoice->client_id = $client->id;
            $createInvoice->subscription_id = $client->subscription_plans->id;
            $createInvoice->monthly_subs_billamount = $amount;
            $createInvoice->total_unpaid_month = $unpaidmonth;
            $createInvoice->invoice_months = $invmonth;
            $createInvoice->total_billing_main_amount = $mainamount;
            $createInvoice->total_billing_vat_amount = $itemvat;
            $createInvoice->total_billing_amount = $totalamount;
            $createInvoice->nettotal = $netttoal;
            $createInvoice->invoice_status = 0;
            $invoice_date = date("d/m/Y");
            $invoice_time = date("h:i:sa");
            $createInvoice->invoice_date = $invoice_date;
            $createInvoice->invoice_time = $invoice_time;
            $createInvoice->last_date_of_payment = $end;
            $createInvoice->membership_amount = $membershipamount;

            if ($this->CheckDuplicate($CreateManualInvoiceModel, $createInvoice)) {
                if (!is_null($CreateManualInvoiceModel)) {
                    $CreateManualInvoiceModel->delete();
                }
                $createInvoice->emailsend = 0;
                $createInvoice->save();
            }
        }

        $sendMailInvoices = CreateManualInvoiceModel::where('invoice_status', 0)
            ->where('emailsend', 0)
            ->where('last_date_of_payment', $checkLastDateFromNow)
            ->get();

        foreach ($sendMailInvoices as $sendmailInvoice) {
            $this->SendAutoMail($sendmailInvoice);
        }

    }

    public function CheckMembershipAmount($id)
    {

        $client = Client::find($id);
        if ($client->subscription_payment == 0) {
            $amount = $client->mebser_ships->amount;
        } else {
            $amount = 0;
        }
        return $amount;

    }

    public function CheckDuplicate($CreateManualInvoiceModel, $createInvoice): bool
    {

        if ($CreateManualInvoiceModel['client_id'] == $createInvoice['client_id']
            && $CreateManualInvoiceModel['total_unpaid_month'] == $createInvoice['total_unpaid_month']
            && $CreateManualInvoiceModel['total_billing_main_amount'] == $createInvoice['total_billing_main_amount']
            && $CreateManualInvoiceModel['total_billing_vat_amount'] == $createInvoice['total_billing_vat_amount']
            && $CreateManualInvoiceModel['nettotal'] == $createInvoice['nettotal']
            && $CreateManualInvoiceModel['invoice_months'] == $createInvoice['invoice_months']
            && $CreateManualInvoiceModel['last_date_of_payment'] == $createInvoice['last_date_of_payment']) {

            return false;
        } else {

            return true;
        }

    }
    public function UpdateLastPayment($id, $date)
    {
        $client = Client::find($id);
        $client->lastpasyment = $date;
        $client->update();

    }
    public function SendAutoMail($createInvoice)
    {

        $to_email = $createInvoice->clinet_Info->email;
        $pdf = PDF::loadView('pdf.invoicereportpdf', compact('createInvoice'));
        Mail::to($to_email)->send(new SendPDFMail($pdf, $createInvoice));
        $createInvoice->emailsend = 1;
        $createInvoice->update();

    }
    public function Sendemail($createInvoice)
    {
        /*  $emails = CreateManualInvoiceModel::select('email')->where('id', $id)->get();

        $report = CreateManualInvoiceModel::where('id', $id)->get(); */

        $to_email = $createInvoice->clinet_Info->email;
        $pdf = PDF::loadView('pdf.invoicereportpdf', compact('createInvoice'));
        /* $createInvoice->email */;
        Mail::to($to_email)->send(new SendPDFMail($pdf));
        $createInvoice->emailsend = 1;
        $createInvoice->update();
        return redirect()->back()->with('message', 'Email Sent to client Successfully');
    }

}
