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
                        Edit Membership Plan
                        <a href="{{route('admin.member-plan')}}"><button class="btn btn-info btn-sm float-end">View All</button></a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/update-memberplan/'.$membership->id)}}"" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ $membership->name }}"  placeholder="Name here" class="form-control" id="exampleInputName">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Amount</label>
                            <input type="text" name="amount" value="{{ $membership->amount }}"  placeholder="Amount here" class="form-control" id="exampleInputName">
                            @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>

@endsection