<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/images/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/images/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/images/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/images/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/images/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/images/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('assets/images/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{asset('assets/images/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>S Manager</title>
        <!-- CSS only -->
        <!-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}"> -->
<link rel="stylesheet" href="{{asset('assets/css/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/autoFill.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/colReorder.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/keyTable.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/searchPanes.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/buttons.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/responsive.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/fixedHeader.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/fixedColumns.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/datatables/select.dataTables.min.css')}}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.min.css') }}"> -->

<link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
       <!--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
       <script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

       <!--   <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
<!-- <link href="{{asset('assets/css/fontawsom/css/font-awesome.min.css')}}" rel="stylesheet"> -->
<!-- JavaScript Bundle with Popper -->

    </head>
    <body class="sb-nav-fixed">
      <div class="container-fluid">
          <!-- <div class="row"> -->
          @include('admin.includes.header')
        <div id="layoutSidenav">
        @include('admin.includes.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>

                @include('admin.includes.footer')
            </div>
        </div>
          <!-- </div> -->
      </div>



        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{asset('assets/js/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/fixedHeader.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/dataTables.autoFill.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/dataTables.colReorder.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/dataTables.searchPanes.min.js')}}"></script>
  <!--   <script src="{{asset('assets/js/dataTables/responsive.bootstrap4.min.js')}}"></script> -->
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
   <!--  <script src="{{asset('assets/js/dataTables/fixedHeader.bootstrap4.min.js')}}"></script> -->
   <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/fixedHeader.bootstrap4.min.js"></script>
  <!-- <script src="{{asset('assets/js/dataTables/fixedColumns.min.js')}}"></script>-->
    <script src="{{asset('assets/js/datatables/sum/sum.js')}}"></script>
    <script src="{{asset('assets/js/datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/datatables/dataTables.select.min.js')}}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    </body>
</html>
