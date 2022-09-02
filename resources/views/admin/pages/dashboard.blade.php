@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">


        <div class="col-md-12 mx-auto mt-3">

            <div class="mr-2">
                <div class="card">
                    <div class="card-header">
                        <h3>New Client Request</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <!--  <th scope="col">Registration Amount</th> -->
                                    <th scope="col">Billing Start Date</th>
                                    <th scope="col">Client Status</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Post Code</th>
                                    <!--  <th scope="col">Subscription Plan</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <!--    <th scope="col">Registration Amount</th> -->
                                    <th scope="col">Billing Start Date</th>
                                    <th scope="col">Client Status</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Post Code</th>
                                    <!--   <th scope="col">Subscription Plan</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
var table;
$(document).ready(function() {
    $('#datatable').DataTable({
        responsive: true,
        paging: true,
        scrollY: 400,
        ordering: true,
        searching: true,
        colReorder: true,
        autoWidth: true,
        keys: true,
        processing: true,
        serverSide: true,
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: 100,

        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "ajax": {
            "url": "{{ route('client.newClientList') }}",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },
            {
                data: 'company_name',
                name: 'company_name',

            },

            {
                data: 'full_name',
                name: 'full_name'
            },
            {
                data: 'email',
                name: 'email',

            },
            {
                data: 'phone',
                name: 'phone',
                className: "text-right"
            },
            /*      {
                     data: 'membership-amount',
                     name: 'membership-amount',
                     className: "text-right"
                 }, */
            {
                data: 'billing_startdate',
                name: 'billing_startdate',

            },
            {
                data: 'status',
                name: 'status',

            },
            {
                data: 'address',
                name: 'address',

            },
            {
                data: 'city',
                name: 'city',

            },
            {
                data: 'post_code',
                name: 'post_code',

            },
            /*  {
                 data: 'subscription-Plan',
                 name: 'subscription-Plan',

             }, */
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        /* columnDefs: [{
            targets: [7],
            render: function(data, type, row) {
                return data > 0  ?  $(row).addClass( 'red' ) :  $(row).addClass( 'black' )
            }
        }] */


    });

});


$(document).on("click", "#data-show", function(event) {
    var dataid = $(this).data("id");
    console.log(dataid);
    jQuery.ajax({
        type: "get",
        url: "{{ url('ClientData')}}" + '/' + dataid,
        data: {
            id: dataid,
        },
        datatype: ("json"),
        success: function(data) {
            /*   console.log(data.client); */
            $("#CompanyName").val(data.client['company_name']);
            $("#full_name").val(data.client['company_name']);
            $("#email").val(data.client['email']);
            $("#phone").val(data.client['phone']);
            $("#city").val(data.client['city']);
            $("#post_code").val(data.client['post_code']);
            $("#instance_name").val(data.client['company_name']);
            $("#billing_startdate").val(data.client['billing_startdate']);
            $("#address").val(data.client['instance_name']);
            $(".activebtn").attr("data-id", data.client['id']);
    
        },
        error: function() {
            swal("Opps! Faild", "Form Submited Faild", "error");
        }
    });

});


$(document).on("click", "#inactive", function(event) {
    var dataid = $(this).data("id");
    var fleet_rate = $("#fleet_rate").val();
    var fleet_qty = $("#fleet_qty").val();
    var user_domain=$("#user_domain").val();
    if (fleet_rate = 0 && fleet_qty == 0) {
        swal("Opps! Faild", "Please Select Requirment Field", "error");

    } else {

        jQuery.ajax({
            type: "post",
            url: "{{ url('Clientactive')}}",
            data: {
                id: dataid,
                fleet_rate: fleet_rate,
                fleet_qty: fleet_qty,
                user_domain:user_domain
            },
            datatype: ("json"),
            success: function(data) {
                if (data.status == 200) {
                    swal("Ok! Client Activate Successfuly !", {
                        icon: "success",
                    });
                    34
                    $('.modal').modal('toggle');
                    $('#datatable').DataTable().ajax.reload()
                }
            },
            error: function(data) {
                console.log(data);
                swal("Opps! Faild", "Form Submited Faild", "error");
            }
        });

    }


});
</script>

<div class="modal fade bd-example-modal-xl" id="exampleModalToggle" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Client Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-md-12">
                        <label for="CompanyName" class="form-label">Company Name</label>
                        <input type="text" placeholder="Company Name here" class="form-control" id="CompanyName">

                    </div>
                    <div class="col-md-6">
                        <label for="FullName" class="form-label">Full Name</label>
                        <input type="text" id="full_name" placeholder="Full Name here" class="form-control">

                    </div>
                    <div class="col-md-6">
                        <label for="Email" class="form-label">Email</label>
                        <input type="text" placeholder="Email here" class="form-control" id="email">

                    </div>

                    <div class="col-md-6">
                        <label for="Phone" class="form-label">Phone</label>
                        <input type="text" placeholder="Phone Number here" class="form-control" id="phone">

                    </div>

                    <div class="col-md-6">
                        <label for="City">City</label>
                        <input type="text" placeholder="Type here" class="form-control" id="city">

                    </div>

                    <div class="col-md-6">
                        <label for="PostCode">Post Code</label>
                        <input type="text" placeholder="Post code Here" class="form-control" id="post_code">

                    </div>
                    <div class="col-md-6">
                        <label for="InstanceName" class="form-label">Instance Name</label>
                        <input type="text" placeholder="Type here" class="form-control" id="instance_name">

                    </div>

                    <div class="col-md-6">
                        <label for="BillingStartDate" class="form-label">*Billing Start Date</label>
                        <input type="text" class="date form-control" id="billing_startdate" />
                        <script type="text/javascript">
                        $(".date").datepicker({
                            format: "yyyy-mm-dd",
                            "setDate": new Date(),
                            "autoclose": true
                        });
                        </script>
                    </div>
                    <div class="col-md-12">
                        <label for="Address">Address</label>
                        <textarea class="form-control" placeholder="Address here" id="address"
                            style="height: 100px"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="Address">User Domain</label>
                        <input name="user_domain" id="user_domain" type="text" class="form-control" placeholder="User Domain">

                    </div>
                    <div class="col-md-6">
                        <label for="Address">Fleet Rate</label>
                        <input type="number" id="fleet_rate" name="fleet_rate" class="form-control" placeholder="Fleet Rate">

                    </div>
                    <div class="col-md-6">
                        <label for="Address">Fleet Qunatity</label>
                        <input type="number" id="fleet_qty" name="fleet_qty" class="form-control" placeholder="Fleet Quantity">
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn btn-outline-success btn-sm activebtn" data-id="" id="inactive">Active</button>
                <button class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection