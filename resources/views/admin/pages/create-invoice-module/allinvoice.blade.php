@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-12">

            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="text-center">Invoice Info List</h4>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="btn-close btn-sm float-end" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                        <p>{{ session('message') }}</p>

                    </div>
                    @endif

                    <table class="table table-striped" id="datatable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#Sl</th>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Membership Amount</th>
                                <th scope="col">Plan</th>
                                <th scope="col">Subscription Amount</th>
                                <th scope="col">Month</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Last Payment Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">#Sl</th>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Membership Amount</th>
                                <th scope="col">Plan</th>
                                <th scope="col">Subscription Amount</th>
                                <th scope="col">Month</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Last Payment Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-2">

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

        dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{

                text: 'Refresh',
                action: function() {
                    table.ajax.reload();
                },
                className: 'btn btn-info',
            },

            {
                extend: 'copy',

                className: 'btn btn-secondary',
                text: 'Export',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'btn btn-info',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                },
                footer: false,
            },
            {
                text: 'PDF',
                extend: 'pdf',
                className: 'btn btn-light',
                orientation: 'landscape', //portrait',
                pageSize: 'A4',
                title: 'Client List',
                filename: 'clientlist',
                className: 'btn btn-danger',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                },
                footer: false,
                customize: function(doc) {

                    var tblBody = doc.content[1].table.body;
                    doc.content[1].layout = {
                        hLineWidth: function(i, node) {
                            return (i === 0 || i === node.table.body.length) ? 2 : 1;
                        },
                        vLineWidth: function(i, node) {
                            return (i === 0 || i === node.table.widths.length) ? 2 : 1;
                        },
                        hLineColor: function(i, node) {
                            return (i === 0 || i === node.table.body.length) ? 'black' :
                                'gray';
                        },
                        vLineColor: function(i, node) {
                            return (i === 0 || i === node.table.widths.length) ?
                                'black' : 'gray';
                        }
                    };
                    $('#gridID').find('tr').each(function(ix, row) {
                        var index = ix;
                        var rowElt = row;
                        $(row).find('td').each(function(ind, elt) {
                            tblBody[index][ind].border
                            if (tblBody[index][1].text == '' && tblBody[index][
                                    2].text == '') {
                                delete tblBody[index][ind].style;
                                tblBody[index][ind].fillColor = '#FFF9C4';
                            } else {
                                if (tblBody[index][2].text == '') {
                                    delete tblBody[index][ind].style;
                                    tblBody[index][ind].fillColor = '#FFFDE7';
                                }
                            }
                        });
                    });
                }

            },
            {
                extend: 'print',
                text: 'Print',
                className: 'btn btn-dark',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                },
                footer: false,
            },


        ],

        "ajax": {
            "url": "{{ route('admin.loadInvoice') }}",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },
            {
                data: 'invoice_number',
                name: 'invoice_number',

            },
            {
                data: 'invoice_date',
                name: 'invoice_date',

            },

            {
                data: 'clientInfo-name',
                name: 'clientInfo-name'
            },
            {
                data: 'clientInfo-email',
                name: 'clientInfo-email',

            },
            {
                data: 'membership_amount',
                name: 'membership_amount',
                className: "text-right"
            },
            {
                data: 'subscription-Plan',
                name: 'subscription-Plan',
                className: "text-right"
            },
            {
                data: 'monthly_subs_billamount',
                name: 'monthly_subs_billamount',
                className: "text-right"
            },
            {
                data: 'total_unpaid_month',
                name: 'total_unpaid_month',

            },
            {
                data: 'total_billing_amount',
                name: 'total_billing_amount',

            },
            {
                data: 'payment-status',
                name: 'payment-status',

            },
            {
                data: 'last_date_of_payment',
                name: 'last_date_of_payment',

            },

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
/* function DataTables() {
    table = $('#datatable').DataTable({
        });
    $('.dataTables_length').addClass('bs-select');
    table.buttons().container()
        .appendTo('#example_wrapper .col-md-6:eq(0)');
} */
$(document).on('click', '#paymentInvoice', function() {
    swal({
            title: "Are you sure?",
            text: "Do you want to Make Payment!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var id = $(this).data("id");
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/Invoice-Payment')}}" + '/' + id,
                    success: function(data) {
                        if (data.status == 200) {
                            $('#datatable').DataTable().ajax.reload()
                        }
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                        swal("Opps! Faild", "Data Fail to Cancel", "error");
                    }
                });
                swal("Ok! Invoice Payment Successfuly !", {
                    icon: "success",
                });
            } else {
                swal("Not Payment!");
            }
        });
});

$(document).on('click', '#invoicePdf', function() {
    var id = $(this).data("id");
    url = "{{ url('admin/InvoicePdfLoad')}}" + '/' + id,
        window.open(url, '_blank');
});
</script>
@endsection