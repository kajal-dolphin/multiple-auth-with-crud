@extends('admin.layout.app')

@include('admin.layout.header')
@section('content')
    <div class="container pt-5">
        <div class="row pt-3">
            <form  action="{{ route('user.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="texy" class="form-control" id="exampleInputPassword1" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                    <a type="buttton" class="btn btn-secondary" href="{{ route('admin.dashboard') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection