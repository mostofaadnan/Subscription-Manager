@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-8 mx-auto">

            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Edit Client info
                        <a href="{{route('admin.clinet-info')}}"><button class="btn btn-info btn-sm float-end">View
                                All</button></a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/update-clientinfo/'.$clientinfo->id)}}" method="POST" class="row">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="CompanyName" class="form-label">Company Name</label>
                            <input type="text" name="company_name" value="{{$clientinfo->company_name}}"
                                class="form-control" id="CompanyName">
                            @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="FullName" class="form-label">Full Name</label>
                            <input type="text" name="full_name" value="{{$clientinfo->full_name}}" class="form-control"
                                id="FullName">
                            @error('full_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="Email" class="form-label">Email</label>
                            <input type="text" name="email" value="{{$clientinfo->email}}" class="form-control"
                                id="Email">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="text" name="phone" value="{{$clientinfo->phone}}" class="form-control"
                                id="Phone">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-md-12">
                            <label for="Address">Address</label>
                            <textarea name="address" class="form-control" id="Address"
                                style="height: 50px">{{$clientinfo->address}}</textarea>
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="City">City</label>
                            <input type="text" name="city" value="{{$clientinfo->city}}" class="form-control" id="City">
                            @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="PostCode">Post Code</label>
                            <input type="text" name="post_code" value="{{$clientinfo->post_code}}" class="form-control"
                                id="PostCode">
                            @error('post_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="InstanceName" class="form-label">Instance Name</label>
                            <input type="text" name="instance_name" value="{{$clientinfo->instance_name}}"
                                class="form-control" id="InstanceName">
                            @error('instance_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="BillingStartDate" class="form-label">Billing Start Date</label>
                            <input type="text" value="{{$clientinfo->billing_startdate}}" class="form-control"
                                id="BillingStartDate" disabled style="background-color: #fff;">

                        </div>
                        <div class="col-md-6">
                            <label for="BillingStartDate" class="form-label">Last Payment Date</label>
                            <input type="text" value="{{$clientinfo->lastpasyment}}" class="form-control"
                                id="BillingStartDate" disabled style="background-color: #fff;">

                        </div>

                        <div class="col-md-6">
                            <label for="ClientStatus">Client Status</label>
                            <select name="client_status" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example">
                                <option>Select Option</option>
                                <option value="0" {{ $clientinfo->client_status==0 ? 'selected="selected"' : '' }}>
                                    In-Active</option>
                                <option value="1" {{ $clientinfo->client_status==1 ? 'selected="selected"' : '' }}>
                                    Active</option>
                            </select>
                            @error('client_status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="BillingStartDate" class="form-label">User Domain</label>
                            <input type="text" value="{{$clientinfo->user_domain}}" class="form-control" id="userDomain"
                                name="user_domain">
                        </div>
                        <div class="col-md-6">
                            <label for="Address">Fleet Rate</label>
                            <input type="number" name="fleet_rate" class="form-control" placeholder="Fleet Rate"
                                value="{{$clientinfo->fleet_rate}}">
                            @error('fleet_rate')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="Address">Fleet Qunatity</label>
                            <input type="number" name="fleet_qty" class="form-control" placeholder="Fleet Quantity"
                                value="{{$clientinfo->fleet_qty}}">
                            @error('fleet_qty')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-1">

        </div>
    </div>
</div>

@endsection