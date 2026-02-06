@extends('layout.customer.CustomerLayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    Xin chào {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
