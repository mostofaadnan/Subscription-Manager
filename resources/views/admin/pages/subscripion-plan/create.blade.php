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
                        Add Subscription Plan
                        <a href="{{route('admin.subscrip-plan')}}"><button class="btn btn-info btn-sm float-end">View All</button></a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.save-subscrip')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="text" name="name" placeholder="Name here" class="form-control" id="exampleInputName">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Amount</label>
                            <input type="text" name="amount" placeholder="Type Amount Here" class="form-control" id="exampleInputName">
                            @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <textarea name="description" class="form-control" placeholder="Description here" id="floatingTextarea" style="height: 100px"></textarea>
                            <label for="floatingTextarea">Description</label>
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