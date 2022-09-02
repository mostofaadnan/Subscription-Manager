@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">

            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Create Invoice for Customer: <b>{{$clientinfo->company_name}}</b>
                        <a href="{{route('admin.client-data')}}"><button class="btn btn-info btn-sm float-end">View
                                All</button></a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/StoreInvoice/'.$clientinfo->id)}}" method="POST" class="row">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $clientinfo->id }}">
                        <input type="hidden" name="subscription_id" value="{{ $clientinfo->subscription_plans->id }}">
                        <!-- @method('PUT') -->
                        <div class="col-md-6">
                            <label for="CompanyName" class="form-label">Invoice Number</label>
                            <input type="text" name="invoice_number" value="{{$invoiceNumber}}" class="form-control"
                                id="CompanyName" style="background-color: #fff;">
                        </div>
                        <div class="col-md-6">
                            <label for="CompanyName" class="form-label">Invoice Date</label>
                            <input type="text" name="company_name" value="{{$invoice_date}}" class="form-control"
                                id="CompanyName" disabled style="background-color: #fff;">
                        </div>

                        <div class="col-md-6">
                            <label for="CompanyName" class="form-label">Company Name</label>
                            <input type="text" name="company_name" value="{{$clientinfo->company_name}}"
                                class="form-control" id="CompanyName">
                        </div>
                        <div class="col-md-6">
                            <label for="Email" class="form-label">Email</label>
                            <input type="text" name="email" value="{{$clientinfo->email}}" class="form-control"
                                id="Email">
                        </div>
                        <div class="col-md-6">
                            <label for="City" class="form-label">City</label>
                            <input type="text" name="city" value="{{$clientinfo->city}}" class="form-control" id="City">
                        </div>
                        <div class="col-md-6">
                            <label for="PostCode" class="form-label">Post Code</label>
                            <input type="text" name="post_code" value="{{$clientinfo->post_code}}" class="form-control"
                                id="PostCode">
                        </div>

                        <div class="col-md-6">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="text" name="phone" value="{{$clientinfo->phone}}" class="form-control"
                                id="Phone">
                        </div>
                        <div class="col-md-6">
                            <label for="TaxNumber" class="form-label">Tax Number</label>
                            <input type="text" name="tax_number" value=" {{$clientinfo->tax_number}}" id="tax_number"
                                class="form-control">
                        </div>

                        <div class="col-md-12 mt-2">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subscription Plan</th>
                                        <th>Monthly Subscription Bill</th>
                                        <th>Total Unpaid Month</th>
                                        <th>Invoice Amount</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td><input type="text" name="subscription_plan"
                                                value="{{$clientinfo->subscription_plans->name}}" class="form-control"
                                                id="SubscriptionPlan"></td>
                                        <td>
                                            <input type="text" id="bill" name="monthly_subs_billamount"
                                                value=" {{$clientinfo->subscription_plans->amount}}"
                                                class="form-control" id="MonthlyBill">
                                        </td>
                                        <td>
                                            <input type="number" id="month" value="1" name="total_unpaid_month" min="1"
                                                class="form-control">
                                            @error('total_unpaid_month')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" id="totalamount" name="totalamount"
                                                class="form-control text-sm-right" placeholder="Total Amount"
                                                style="background-color: #fff;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="right"><input type="checkbox" name="membership_amount"
                                                id="showField" onchange="RegistrationFee()">Membership
                                            Amount(Registration Fee)</b></td>
                                        <td> <input type="text" name="membership_amount"
                                                class="membership_amount form-control text-sm-right"
                                                id="registartionfee"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="right"><b>Amount</b></td>
                                        <td align="right">
                                            <input type="text" name="main_amount" id="mainamount" class="form-control"
                                                style="background-color: #fff;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="right"><b>Vat</b></td>
                                        <td align="right">
                                            <input type="text" name="vat_amount" id="itemvatamt" class="form-control"
                                                style="background-color: #fff;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="right"><b>Total Amount</b></td>
                                        <td align="right">
                                            <input type="text" id="netamt" name="total_billing_amount"
                                                class="form-control" style="background-color: #fff;">
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="col-md-6">
                            <label for="Address">Billing Address</label>
                            <textarea name="address" class="form-control" placeholder="Description here" id="Address"
                                style="height: 128px">{{$clientinfo->address}}</textarea>
                        </div>

                        <div class="col-md-6">

                            <label for="InvoiceMonth">Invoice Month</label>
                            <div class="input-group"><select class="custom-select form-control" id="inputmonth">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="July">July</option>
                                    <option value="Agust">Agust</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="Nobember">Nobember</option>
                                    <option value="December">December</option>
                                </select>
                                <input type="text" id="year" value="2022" class="form-control">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" id="entryMonth" type="button">Add</button>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" id="clear" type="button">Clear</button>
                                </div>
                            </div>

                            <textarea name="invoice_months" class="form-control" placeholder="Invoice for the Month of"
                                id="InvoiceMonth" style="height: 80px" required></textarea>
                            @error('invoice_months')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>



                        <!--
                        <div class="col-md-6 mt-3">
                        <input type="checkbox" name="membership_amount" id="showField"
                        value="{{$clientinfo->mebser_ships->amount}}" onchange="RegistrationFee()">
                        <label for="TaxNumber">Checked  if You Want to Include Membership Fee</label>
                         <input type="text" value="Registration Fee: {{$clientinfo->mebser_ships->amount}}"
                         id="membership_amount" class="form-control">
                         </div> -->

                        <button type="submit" class="btn btn-primary mt-3">Create Invoice & Send to Client
                            Email</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
<script>
//__Script for Total Billing Amount __//
window.onload = TotalAmount(), RegistrationFee();
$('#month').change(function(e) {
    RegistrationFee();
    TotalAmount();

});

function TotalAmount() {

    $qty = parseFloat($("#month").val());
    $price = parseFloat($("#bill").val());
    if ($qty < 0) {
        $("#totalamount").val();
    } else {
        $totalamounts = parseFloat($qty * $price).toFixed(2);
        $vat = (19 / 100);
        $refre = 0;
        $registrationfee = $("#registartionfee").val();
        if ($registrationfee == null) {
            $refre = 0;
        } else {
            $refre = parseFloat($("#registartionfee").val());
        }
        /*  console.log(totalamount); */
        $("#totalamount").val($totalamounts);
        /* parseFloat(this.value).toFixed(2); */
        $mainprice = parseFloat($totalamounts / ($vat + 1)).toFixed(2);
        $itemvat = parseFloat($totalamounts - $mainprice).toFixed(2);
        $("#mainamount").val($mainprice);
        $("#itemvatamt").val($itemvat);
        var nettotals = parseFloat($totalamounts) + parseFloat($refre);

        $("#netamt").val(nettotals);
    }
}

//__Script for Membership Amount Only__//
/* $('#membership_amount').css('display','none'); */ // Hide the text input box in default
function RegistrationFee() {
    if ($('#showField').prop('checked')) {
        var amount = <?php echo $clientinfo->mebser_ships->amount; ?>;
        $('.membership_amount').val(amount);

    } else {
        $('.membership_amount').val('0');
    }

    TotalAmount();
}
var monthtext = '';
var pretext = '';
$("#entryMonth").click(function() {

    monthtext = $('#InvoiceMonth').val();
    var pretext = monthtext;
    var month = $('#inputmonth').find(":selected").text();
    var year = $('#year').val();
    if (monthtext == '') {
        monthtext = month + '-' + year
    } else {
        monthtext = ',' + month + '-' + year
    }

    $('#InvoiceMonth').val(pretext + monthtext);
});

$("#clear").click(function() {
    $('#InvoiceMonth').val('');

});
</script>

@endsection