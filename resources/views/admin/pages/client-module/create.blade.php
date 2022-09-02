@extends('admin.layouts.app')

@section('content')

<div class="contianer">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">

            <div class="card mt-3">
                <div class="card-header">
                    <h4>
                        Add New Client
                        <a href="{{ route('admin.clinet-info') }}"><button class="btn btn-info btn-sm float-end">View
                                All</button></a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.save-clientinfo') }}" method="POST" class="row">
                        @csrf
                        <div class="col-md-6">
                            <label for="CompanyName" class="form-label">Company Name</label>
                            <input type="text" name="company_name" placeholder="Company Name here" class="form-control"
                                id="CompanyName">
                            @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="FullName" class="form-label">Full Name</label>
                            <input type="text" name="full_name" placeholder="Full Name here" class="form-control"
                                id="FullName">
                            @error('full_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="Email" class="form-label">Email</label>
                            <input type="text" name="email" placeholder="Email here" class="form-control" id="Email">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="text" name="phone" placeholder="Phone Number here" class="form-control"
                                id="Phone">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="col-md-6">
                            <label for="City">City</label>
                            <input type="text" name="city" placeholder="Type here" class="form-control" id="City">
                            @error('city')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="PostCode">Post Code</label>
                            <input type="text" name="post_code" placeholder="Post code Here" class="form-control"
                                id="PostCode">
                            @error('post_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="InstanceName" class="form-label">Instance Name</label>
                            <input type="text" name="instance_name" placeholder="Type here" class="form-control"
                                id="InstanceName">
                            @error('instance_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="BillingStartDate" class="form-label">Billing Start Date</label>
                            <input type="text" class="date form-control" name="billing_startdate" />

                            <script type="text/javascript">
                            $(".date").datepicker({
                                format: "yyyy-mm-dd",
                            });
                            </script>
                            @error('billing_startdate')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="Address">Address</label>
                            <textarea name="address" class="form-control" placeholder="Address here" id="Address"
                                style="height: 100px"></textarea>
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="Address">User Domain</label>
                            <input name="user_domain" type="text" class="form-control" placeholder="User Domain">
                            @error('user_domain')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="Address">Fleet Rate</label>
                            <input type="number" name="fleet_rate" class="form-control" placeholder="Fleet Rate">
                            @error('fleet_rate')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="Address">Fleet Qunatity</label>
                            <input type="number" name="fleet_qty" class="form-control" placeholder="Fleet Quantity">
                            @error('fleet_qty')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-1">

        </div>
    </div>
</div>



@endsection
