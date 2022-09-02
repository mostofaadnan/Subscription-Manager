@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">

            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Invoice for :
                      <b>{{$clientinfo->company_name}}</b>
                        <a href="{{ route('admin.client-data') }}"><button class="btn btn-info btn-sm float-end">View All</button></a>
                        @if (session('message'))
                    <h6 class="alert alert-success">{{ session('message') }}</h6>
                    @endif
                    </h4>
                </div>
                <div class="card-body">
             <form action="{{url('/admin/CreateInvoice/'.$clientinfo->id)}}" method="POST">
                 @csrf
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

                        <tr>
                        <td colspan="4">{{$clientinfo->id}}</td>
                        <td colspan="4">{{$clientinfo->company_name}}</td>
                        <td colspan="4">{{$clientinfo->email}}</td>
                        <td colspan="4">{{$clientinfo->phone}}</td>
                        <td colspan="4">{{$clientinfo->address}}</td>
                        <td colspan="4">{{$clientinfo->subscription_plans->name}}</td>
                        <td colspan="4">
                        {{$clientinfo->subscription_plans->amount}}
                            <i class="fas fa-euro-sign"></i>
                        </td>
                        <td>
                        </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-danger btn-sm float-end">Create invoice</button>
             </form>
                </div>
            </div>

        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>

@endsection