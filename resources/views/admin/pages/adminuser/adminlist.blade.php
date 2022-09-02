@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">

<div class="col-md-10 mx-auto mt-3">

<div class="mr-2">
<div class="card">
<div class="card-header">
<h4>
                        Admin User Information
                        <a href="{{route('auth.register')}}"><button class="btn btn-info btn-sm float-end">Add New</button></a>
                    </h4>
</div>
<div class="card-body">
<table class="table table-striped" id="datatable" width="100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Create Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <tr>
            <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Create Date</th>
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
        autoWidth:true,
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
            "url": "{{ route('admin.adminlist') }}",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: "text-center"
            },
            {
                data: 'name',
                name: 'name',

            },

            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'status',
                name: 'status',

            },
            {
                data: 'created_at',
                name: 'created_at',

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

} );

$(document).on("click", "#inactive", function(event) {
    var dataid = $(this).data("id");
    console.log(dataid);
    jQuery.ajax({
              type: "post",
              url: "{{ url('Adminactive')}}" + '/' + dataid,
              success: function(data) {
                  console.log(data);
                  if(data.status==200){
                    swal("Ok! Admin Activate Successfuly !", {
              icon: "success",
            });
                    $('#datatable').DataTable().ajax.reload()
                  }
            console.log(data);
              },
              error: function(data) {
                console.log(data);
                swal("Opps! Faild", "Data Fail to Cancel", "error");
              }
            });




  });
  $(document).on("click", "#active", function(event) {
    var dataid = $(this).data("id");
    console.log(dataid);
    jQuery.ajax({
      type: "post",
      url: "{{ url('Admindeactive')}}" + '/' + dataid,
      data: {
        id: dataid,
      },
      datatype: ("json"),
      success: function(data)
      {
        if(data.status==200){
            swal("Ok! Admin De-activate Successfuly !", {
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
