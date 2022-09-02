@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-12">

            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Billing info
                    </h4>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <h6 class="alert alert-success">{{ session('message') }}</h6>
                    @endif

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Client Name">Client Name</label>
                                <input type="text" value="{{ $clientinfo->full_name }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Client Name">Client Company</label>
                                <input type="text" value="{{ $clientinfo->company_name }}" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Client Name">Mobile</label>
                                <input type="text" value="{{ $clientinfo->phone }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Client Name">Email</label>
                                <input type="text" value="{{ $clientinfo->email }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Client Name">Address</label>
                                <input type="text" value="{{ $clientinfo->address }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Client Name">City</label>
                                <input type="text" value="{{ $clientinfo->city }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Client Name">Postal Code</label>
                                <input type="text" value="{{ $clientinfo->post_code }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Client Name">User Domain</label>
                                <input type="text" value="{{ $clientinfo->user_domain }}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped" id="billingtable">
                        <thead>
                            <tr>
                                <th>Sl.NO</th>
                                <th>Ban Time</th>
                                <th>Ban Message</th>
                                <th>ID</th>
                                <th>Chat ID</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn_count = 1;?>
                            @foreach($datas as $data)
                            <tr>
                                <td> {{ $sn_count }}</td>
                                <td>{{ $data->banTime}}</td>
                                <td>{{ $data->banMsg}}</td>
                                <td>{{ $data->_id}}</td>
                                <td>{{ $data->chatId}}</td>
                                <td>{{ $data->name}}</td>
                            </tr>
                            <?php $sn_count++;?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <button class="btn btn-lg btn-info" data-bs-toggle="modal" href="#BillingInvoice"
                            role="button">Invoice</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-xl" id="BillingInvoice" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('invoice.clientCreateInvoice') }}" method="POST" class="row">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ $clientinfo->id }}">
                    
                    <div class="col-md-6">
                        <label for="CompanyName" class="form-label">Invoice Number</label>
                        <input type="text" name="invoice_number" value="{{ $invoiceNumber }}" class="form-control"
                            style="background-color: #fff;">
                    </div>
                    <div class="col-md-6">
                        <label for="CompanyName" class="form-label">Invoice Date</label>
                        <input type="text" name="invoice_date" value="{{ $invoice_date }}" class="form-control"
                            style="background-color: #fff;">
                    </div>

                    <div class="col-md-6">
                        <label for="CompanyName" class="form-label">Company Name</label>
                        <input type="text" name="company_name" value="{{$clientinfo->company_name}}"
                            class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="Email" class="form-label">Email</label>
                        <input type="text" name="email" value="{{$clientinfo->email}}" class="form-control" id="Email">
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
                        <input type="text" name="phone" value="{{$clientinfo->phone}}" class="form-control" id="Phone">
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
                                    <th>Sl.No</th>
                                    <th width="30%">Details</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>Fleet</td>
                                    <td><input type="text" value="{{ $clientinfo->fleet_qty }}" name="client_qty" id="singl_fleet_qty"
                                            class="form-control"></td>
                                    <td><input type="text" value="{{ $clientinfo->fleet_rate }}" name="client_rate" id="singl_fleet_rate"
                                            class="form-control"></td>
                                    <td><input type="text" name="client_amount" id="single_amount"
                                            class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Drivers</td>
                                    <td><input type="text" name="driver_qty" id="driverqty"
                                            value="{{ $totalDrivers }}" class="form-control"></td>
                                    <td><input type="text" name="driver_rate" id="driverrate" value="5.5"
                                            class="form-control"></td>
                                    <td><input type="text" name="driver_amount" id="driverTotalamount"
                                            class="form-control"></td>
                                </tr>

                                <tr>
                                    <td colspan="4" align="right"><b>Amount</b></td>
                                    <td align="right">
                                        <input type="text" name="total_amount" id="mainamount" class="form-control"
                                            style="background-color: #fff;">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right"><b>Vat</b></td>
                                    <td align="right">
                                        <input type="text" name="total_vat" id="itemvatamt" class="form-control"
                                            style="background-color: #fff;">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right"><b>Total Amount</b></td>
                                    <td align="right">
                                        <input type="text" id="netamt" name="nettotal" class="form-control"
                                            style="background-color: #fff;">
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="col-md-12">
                        <label for="Address">Billing Address</label>
                        <textarea name="address" class="form-control" placeholder="Description here" id="Address"
                            style="height: 50px">{{$clientinfo->address}}</textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn btn-outline-success btn-sm activebtn">Create Invoice & Send to
                    Client
                    Email</button>
                <button class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $vat = (19 / 100);
    $singl_fleet_qty = parseFloat($("#singl_fleet_qty").val());
    $singl_fleet_rate = parseFloat($("#singl_fleet_rate").val());
    $single_amount = 0;

    $single_amount = $singl_fleet_qty * $singl_fleet_rate;
    $("#single_amount").val($single_amount);
    $driverqty = parseFloat($("#driverqty").val());
    $driverrate = parseFloat($("#driverrate").val());
    $driversAmount = 0;

    $driversAmount = ($driverqty * $driverrate);
    $("#driverTotalamount").val($driversAmount.toFixed(2));

    $amount = 0;
    $amount = $single_amount + $driversAmount;
    $("#mainamount").val($amount.toFixed(2));

    $totalvat = ($vat * $amount);
    $("#itemvatamt").val($totalvat.toFixed(2));
    $nettotal = ($amount + $totalvat);
    $("#netamt").val($nettotal.toFixed(2));

});
</script>

@endsection