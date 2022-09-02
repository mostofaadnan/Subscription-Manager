<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendPDFMail;
use Mail;
use PDF;
use App\Models\CreateManualInvoice\CreateManualInvoiceModel;
use App\Http\Controllers\CreateInvoice\CreateInvoiceController;
use App\Http\Controllers\ClientModule\ClientController;
use App\Http\Controllers\invoice\InvoiceController;

class SendMail extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:sendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        ini_set('memory_limit','256M');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

      $InvoiceControll=new InvoiceController();
        $this->$InvoiceControll->AutomaticMail();
      /*   $id=1;
        $createInvoice = CreateManualInvoiceModel::find($id);
        $to_email = $createInvoice->clinet_Info->email;
        $pdf = PDF::loadView('pdf.invoicereportpdf', compact('createInvoice'));
        /* $createInvoice->email */;
      //  Mail::to($to_email)->send(new SendPDFMail($pdf));
       // return redirect()->back()->with('message', 'Email Sent to client Successfully');
       // return 0; */
    }
}