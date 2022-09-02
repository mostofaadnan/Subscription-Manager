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
                        MemberShip info
                        <a href="{{route('admin.add-memberplan')}}"><button class="btn btn-info btn-sm float-end">Add New</button></a>
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
                                <th scope="col" colspan="4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($membership as $memberfee)
                            <tr>
                                <td colspan="4">{{ $i++}}</td>
                                <td colspan="4">{{ $memberfee->name }}</td>
                                <td colspan="4">
                                    {{ $memberfee->amount }} 
                                <i class="fas fa-euro-sign"></i>
                                </td>
                                <td>{{ $memberfee->description }}</td>
                                <td colspan="4">
                                    <a href="{{url('/admin/edit-memberplan/'.$memberfee->id)}}"><button class="btn btn-success btn-sm px-3">Edit</button></a>
                                    
                                    <form action="{{ url('/admin/delete-memberplan/'.$memberfee->id) }}" method="POST" style="margin-top:5px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                </td>
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