@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">

            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="text-center">Customer Info List</h4>
                </div>
                <div class="card-body">
                @if (session('message'))
                    <h6 class="alert alert-success">{{ session('message') }}</h6>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" colspan="4">Id</th>
                                <th scope="col" colspan="4">Name</th>
                                <th scope="col" colspan="4">Email</th>
                                <th scope="col" colspan="4">Phone</th>
                                <th scope="col" colspan="4">Address</th>
                                <th scope="col" colspan="4">Plan</th>
                                <th scope="col" colspan="4">Subscription Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($clientData as $client)
                        <tr>
                        <td colspan="4">{{$client->id}}</td>
                        <td colspan="4">{{$client->name}}</td>
                        <td colspan="4">{{$client->email}}</td>
                        <td colspan="4">{{$client->phone}}</td>
                        <td colspan="4">{{$client->bill_address}}</td>
                        <td colspan="4">{{$client->subscription_plans->name}}</td>
                        <td colspan="4">
                            {{$client->subscription_plans->amount}}
                            <i class="fas fa-euro-sign"></i>
                        </td>
                        <td>
                        <a href="{{url('/admin/show-singlecustomerinfo/'.$client->id)}}">
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
        <div class="col-md-2">

        </div>
    </div>
</div>

@endsection