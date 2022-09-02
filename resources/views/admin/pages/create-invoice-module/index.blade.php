@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
       
        <div class="col-md-12">

            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="text-center">
                        Create Invoice Module
                        <a href="{{route('admin.all-invoice')}}"><button class="btn btn-info btn-sm float-end">All Invoice List</button></a>
                    </h4>
                </div>
                <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="btn-close btn-sm float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    <p>{{ session('message') }}</p>
 
</div>
@endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" colspan="4">Id</th>
                                <th scope="col" colspan="4">Name</th>
                                <th scope="col" colspan="4">Email</th>
                                <th scope="col" colspan="4">Phone</th>
                                <th scope="col" colspan="4">Billing Address</th>
                                <th scope="col" colspan="4">Subscription Plan</th>
                                <th scope="col" colspan="4">Subscription Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($clientData as $client)
                        <tr>
                        <td colspan="4">{{$client->id}}</td>
                        <td colspan="4">{{$client->company_name}}</td>
                        <td colspan="4">{{$client->email}}</td>
                        <td colspan="4">{{$client->phone}}</td>
                        <td colspan="4">{{$client->address}}</td>
                        <td colspan="4">
                            {{$client->subscription_plans->name}}
                        </td>
                        <td colspan="4">
                            {{$client->subscription_plans->amount}}
                            <i class="fas fa-euro-sign"></i>
                        </td>
                        <td>
                        <a href="{{url('/admin/GetSingleClientData/'.$client->id)}}">
                            <button class="btn btn-success btn-sm px-3">View Invoice</button>
                        </a>
                        </td>
                        </tr>
                        @endforeach
                            
                        </tbody>
                    </table>
                </div>

        </div>
       
    </div>
</div>

@endsection