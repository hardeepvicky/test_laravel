@extends('layouts.app')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">User Form</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

@if ($errors->any())
    <div class="alert alert-danger">        
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-5">
        <form action="{{ route($routePrefix . '.store') }}" method="POST">
            {!! csrf_field() !!}
            <div class="form-group mb-3">                
                <x-inputs.text-field name="name" label="Name" placeholder="Enter Name" />
            </div>
            <div class="mb-3">                
                <x-inputs.text-field type="email" name="email" label="Email" placeholder="Enter Email" />
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirm">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection