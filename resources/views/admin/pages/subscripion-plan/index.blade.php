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
                        Subscription Plan info
                        <a href="{{route('admin.add-subscrip')}}"><button class="btn btn-info btn-sm float-end">Add New</button></a>
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
                                <th scope="col" colspan="4">Name</th>
                                <th scope="col" colspan="4">Amount</th>
                                <th scope="col" colspan="4">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($subscriptPlan as $subsPlan)
                            <tr>
                                <td colspan="4">{{ $i++}}</td>
                                <td colspan="4">{{ $subsPlan->name }}</td>
                                <td colspan="4">
                                    {{ $subsPlan->amount }}
                                <i class="fas fa-euro-sign"></i>
                                </td>
                                <td>{{ $subsPlan->description }}</td>
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