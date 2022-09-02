<?php
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\BillingModule\BillingController;
use App\Http\Controllers\BillingSetting\BillingStatusController;
use App\Http\Controllers\ClientModule\ClientController;
use App\Http\Controllers\CreateInvoice\CreateInvoiceController;
use App\Http\Controllers\FrontEnd\ClientControler;
use App\Http\Controllers\invoice\InvoiceController;
use App\Http\Controllers\ManualInvoice\ManualInvoiceController;
use App\Http\Controllers\MemberShip\MemberShipInfoController;
use App\Http\Controllers\PaymentType\PaymentTypeController;
use App\Http\Controllers\SubscriptionPlan\SubscriptionPlanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/newClient', [ClientControler::class, 'index'])->name('newClient');
Route::post('/newClientSave', [ClientControler::class, 'store'])->name('newClientSave');
Route::get('/LoginAdmin', [AdminAuthController::class, 'index'])->name('login');

Route::post('/AdminLogin', [AdminAuthController::class, 'adminLogin'])->name('auth.login');

/* Route::view('/admin', 'admin'); */

Route::group(['middleware' => ['auth:admin']], function () {

    /*  Route::view('/', [HomePageController::class, 'index'])->name('dashboard'); */
    Route::view('/', 'admin.pages.dashboard')->name('admin.adminDashboard');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name("auth.logout");

    //Admin List
    Route::get('/Adminregister', [UserAdminController::class, 'showAdminRegisterForm'])->name('auth.register');
    Route::post('/Adminregisters', [UserAdminController::class, 'createAdmin'])->name('auth.userSave');
    Route::get('/AdminList', [UserAdminController::class, 'index'])->name("adminlist");
    Route::get('/loadall', [UserAdminController::class, 'adminList'])->name("admin.adminlist");
    Route::post('/Adminactive/{id}', [UserAdminController::class, 'AdminActive'])->name("auth.active");
    Route::post('/Admindeactive/{id}', [UserAdminController::class, 'AdminInActive'])->name("auth.deactive");
    Route::get('/auth/resetpassword', [UserAdminController::class, 'resetPassword'])->name('auth.resetpass');
    Route::post('/auth/updatePassword', [UserAdminController::class, 'updatePassword'])->name('auth.upadatePass');
    
    //new Client
    Route::get('/newClientList', [HomePageController::class, 'ClientList'])->name("client.newClientList");
    Route::post('/Clientactive', [HomePageController::class, 'ClientActive'])->name("client.active");
    Route::post('/Clientdeactive/{id}', [HomePageController::class, 'ClientInActive'])->name("client.deactive");
    Route::get('/ClientData/{id}', [HomePageController::class, 'CleintDataGet'])->name("client.data");
    Route::get('/SubscriptionData', [HomePageController::class, 'SubscriptionData'])->name("client.subsplan");
    Route::get('/MemberShipData', [HomePageController::class, 'MemberShipData'])->name("client.membershipdata");

    
    
//admin side
    /*  Route::get('/adminlists', [HomePageController::class, 'adminList'])->name("auth.adminlist");
    Route::get('/adminlists', [HomePageController::class, 'adminList'])->name("auth.adminlist");
    Route::post('/Adminactive/{id}', [HomePageController::class, 'AdminActive'])->name("auth.active");
    Route::post('/Admindeactive/{id}', [HomePageController::class, 'AdminInActive'])->name("auth.deactive"); */
    /*   Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');
    Route::get('/auth/resetpassword', [MainController::class, 'resetPassword'])->name('auth.resetpass');
    Route::get('/auth/updatePassword', [MainController::class, 'updatePassword'])->name('auth.upadatePass');
    Route::get('/admin/dashboard', [MainController::class, 'dashboard'])->name('admin.adminDashboard');
     */
  /*   Route::get('/admin/pay-type', [PaymentTypeController::class, 'index'])->name('admin.pay-type');
    Route::get('/admin/add-paytype', [PaymentTypeController::class, 'create'])->name('admin.add-paytype');
    Route::post('/admin/save-paytype', [PaymentTypeController::class, 'store'])->name('admin.save-paytype');
    Route::get('/admin/edit-paytype/{id}', [PaymentTypeController::class, 'edit']);
    Route::put('/admin/update-paytype/{id}', [PaymentTypeController::class, 'update']);
    Route::delete('/admin/update-paytype/{id}', [PaymentTypeController::class, 'destroy']); */

  /*   Route::get('/admin/subscrip-plan', [SubscriptionPlanController::class, 'index'])->name('admin.subscrip-plan');
    Route::get('/admin/add-subscrip', [SubscriptionPlanController::class, 'create'])->name('admin.add-subscrip');
    Route::post('/admin/save-subscrip', [SubscriptionPlanController::class, 'store'])->name('admin.save-subscrip'); */

   /*  Route::get('/admin/member-plan', [MemberShipInfoController::class, 'index'])->name('admin.member-plan');
    Route::get('/admin/add-memberplan', [MemberShipInfoController::class, 'create'])->name('admin.add-memberplan');
    Route::post('/admin/save-memberplan', [MemberShipInfoController::class, 'store'])->name('admin.save-memberplan');
    Route::get('/admin/edit-memberplan/{id}', [MemberShipInfoController::class, 'edit']);
    Route::put('/admin/update-memberplan/{id}', [MemberShipInfoController::class, 'update']);
    Route::delete('/admin/delete-memberplan/{id}', [MemberShipInfoController::class, 'destroy']);
    Route::get('/all-memberplan', [MemberShipInfoController::class, 'allmemberplan']); */

   /*  Route::get('/admin/billing-status', [BillingStatusController::class, 'index'])->name('admin.billing-status');
    Route::get('/admin/add-bilingstatus', [BillingStatusController::class, 'create'])->name('admin.add-bilingstatus');
    Route::post('/admin/save-bilingstatus', [BillingStatusController::class, 'store'])->name('admin.save-bilingstatus'); */

    Route::get('/admin/clinet-info', [ClientController::class, 'index'])->name('admin.clinet-info');
    Route::get('/admin/clinet-load', [ClientController::class, 'LoadAll'])->name('admin.clinet-load');
    Route::get('/admin/add-clientinfo', [ClientController::class, 'create'])->name('admin.add-clientinfo');
    Route::post('/admin/save-clientinfo', [ClientController::class, 'store'])->name('admin.save-clientinfo');
    Route::get('/admin/edit-clientinfo/{id}', [ClientController::class, 'edit'])->name('admin.edit-clientinfo');
    Route::put('/admin/update-clientinfo/{id}', [ClientController::class, 'update']);
    Route::delete('/admin/delete-clientinfo/{id}', [ClientController::class, 'destroy']);
    Route::get('/admin/clinet-Inactive', [ClientController::class, 'Inactivecleint'])->name('admin.clinet-info-inactive');
    Route::get('/admin/clinet-load-inactive', [ClientController::class, 'LoadInactive'])->name('admin.clinet-load-inactive');

   /*  Route::get('/admin/billing-info', [BillingController::class, 'index'])->name('admin.billing-info');
    Route::get('/admin/add-billinginfo', [BillingController::class, 'create'])->name('admin.add-billinginfo');
    Route::post('/admin/save-billinginfo', [BillingController::class, 'store'])->name('admin.save-billinginfo'); */

 /*    Route::get('/admin/show-customerinfo', [ManualInvoiceController::class, 'showAllCustomerinfo'])->name('admin.show-customerinfo');
    Route::get('/admin/show-singlecustomerinfo/{id}', [ManualInvoiceController::class, 'showSingleCustomerinfo']);
    Route::post('/admin/sendreport/{id}', [ManualInvoiceController::class, 'Sendemail']); */

  /*   Route::get('/admin/GetClientData/', [CreateInvoiceController::class, 'GetClientData'])->name('admin.client-data');
    Route::get('/admin/GetSingleClientData/{id}', [CreateInvoiceController::class, 'GetSingleClientData']);
    Route::post('/admin/CreateInvoice/{id}', [CreateInvoiceController::class, 'CreateInvoice']);
    Route::post('/admin/StoreInvoice/{id}', [CreateInvoiceController::class, 'StoreManualInvoice']);
    Route::post('/admin/Sendemail', [CreateInvoiceController::class, 'Sendemail']);
    Route::get('/admin/AllInvoice/', [CreateInvoiceController::class, 'GetAllInvoice'])->name('admin.all-invoice');
    Route::get('/admin/LoadInvoice', [CreateInvoiceController::class, 'LoadAll'])->name('admin.loadInvoice');
    Route::post('/admin/Invoice-Payment/{id}', [CreateInvoiceController::class, 'Payment'])->name('admin.Invoice-Payment');
    Route::get('/admin/InvoicePdfLoad/{id}', [CreateInvoiceController::class, 'InvoicePdf'])->name('admin.InvoicePdfLoad');
    Route::get('/admin/AutomaticMail', [CreateInvoiceController::class, 'AutometicMail'])->name('admin.InvoicePdfLoad'); */
    // Route::get("sendreport", [EmailController::class, "index"]);


   Route::get('/admin/InvoiceHistory',[InvoiceController::class,'index'])->name('invoices');
   Route::get('/admin/InvoiceHistory/Loadall',[InvoiceController::class,'LoadAll'])->name('invoice.loadall');
   Route::get('/admin/InvoiceHistory/pdf/{id}',[InvoiceController::class,'InvoicePdf'])->name('invoice.pdf');
   Route::get('/admin/InvoiceHistory/clientinfo',[InvoiceController::class,'clientInfo'])->name('invoice.clientinfo');
   Route::get('/admin/InvoiceHistory/clientinfo/loadall',[InvoiceController::class,'ClientInfoLoad'])->name('invoice.clientinfo.loadall');
   Route::get('/admin/InvoiceHistory/clientinfo/billInfo/{id}', [InvoiceController::class, 'FetchGetData'])->name('invoice.clientinfo.billinfo');
   Route::post('/admin/InvoiceHistory/clientinfo/clientInvoice',[InvoiceController::class,'MakeInvoice'])->name('invoice.clientCreateInvoice');
   Route::get('/admin/InvoiceHistory/clientinfo/clientInvoiceAutomatic',[InvoiceController::class,'AutomaticMail'])->name('invoice.clientCreateInvoiceAuto');

    // Route::get('/openPDF', [StudentController::class, "generatePdfandOpen"]);
    // Route::get('/exportPDF', [StudentController::class, "generatePdfandDownload"]);
});
