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
        scrollY: 500,
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
            "url": "{{ route('invoice.clientinfo.loadall') }}",
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
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
    });

});

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