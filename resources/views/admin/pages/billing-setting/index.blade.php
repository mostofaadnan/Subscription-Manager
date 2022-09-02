@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">

            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Billing Setting
                        <a href="{{route('admin.add-bilingstatus')}}"><button class="btn btn-info btn-sm float-end">Add New</button></a>
                    </h4>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <h6 class="alert alert-success">{{ session('message') }}</h6>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" colspan="4">Id</th>
                                <th scope="col" colspan="4">Status</th>
                                <th scope="col" colspan="4">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($billing as $billtype)
                            <tr>
                                <td colspan="4">{{ $i++}}</td>
                               <td colspan="4">
                               @if($billtype->status == 1)
                                <b>Paid</b>
                                @else
                                <p>UnPaid</p>
                                @endif
                               </td>
                                <td>{{ $billtype->remark }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>

@endsection