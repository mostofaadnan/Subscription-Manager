@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Inactive Client info

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
                                <th scope="col">Client Status</th>
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
                                <th scope="col">Client Status</th>
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

        dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        "ajax": {
            "url": "{{ route('admin.clinet-load-inactive') }}",
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
        url: "{{ url('Clientactive')}}" + '/' + dataid,
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