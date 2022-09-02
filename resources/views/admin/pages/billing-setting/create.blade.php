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
                        Add Billing Settings
                        <a href="{{route('admin.billing-status')}}"><button class="btn btn-info btn-sm float-end">View All</button></a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.save-bilingstatus')}}" method="POST">
                        @csrf
                       <div class="mb-3">
                       <select name="status" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <option selected>Select Option</option>
                            <option value="0">Unpaid</option>
                            <option value="1">Paid</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                       </div>
                        <div class="form-floating">
                            <textarea name="remark" class="form-control" placeholder="Your note here" id="floatingTextarea" style="height: 100px"></textarea>
                            <label for="floatingTextarea">Remark</label>
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