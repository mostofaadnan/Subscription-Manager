@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Client info
                        <a href="{{route('admin.add-clientinfo')}}"><button class="btn btn-info btn-sm float-end">Add
                                New</button></a>
                    </h4>
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
                                <th scope="col">Id</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">Post Code</th>
                                <th scope="col">Billing Start Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">Post Code</th>
                                <th scope="col">Billing Start Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'btn btn-info',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
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
                                    2
                                ].text == '') {
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                },
                footer: false,
            },


        ],

        "ajax": {
            "url": "{{ route('admin.clinet-load') }}",
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
            {
                data: 'billing_startdate',
                name: 'billing_startdate',

            },
            {
                data: 'status',
                name: 'status',

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

$(document).on("click", "#inactive", function(event) {
    var dataid = $(this).data("id");
    console.log(dataid);
    jQuery.ajax({
        type: "post",
        url: "{{ url('Clientdeactive')}}" + '/' + dataid,
        data: {
            id: dataid,
        },
        datatype: ("json"),
        success: function(data) {
            if (data.status == 200) {
                swal("Ok! Admin Activate Successfuly !", {
                    icon: "success",
                });
                $('#datatable').DataTable().ajax.reload()
            }
        },
        error: function() {
            swal("Opps! Faild", "Form Submited Faild", "error");

        }

    });
});
</script>

@endsection