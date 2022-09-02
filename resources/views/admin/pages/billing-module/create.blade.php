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
                        Add Billing info
                        <a href="{{route('admin.billing-info')}}"><button class="btn btn-info btn-sm float-end">View All</button></a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.save-billinginfo')}}" method="POST">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail" class="form-label">Subsceibe Client</label>
                            <select name="client_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option>Select Client</option>
                                @foreach($client_info as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                      
                       <div class="col-md-6">
                            <label for="exampleInputEmail" class="form-label">Subscription Amount</label>
                            <select name="subcriptplan_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option>Select Amount</option>
                                @foreach($mshipfee as $mfee)
                                <option value="{{ $mfee->amount }}">{{ $mfee->amount }}</option>
                                @endforeach
                            </select>
                            @error('subcriptplan_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>

@endsection