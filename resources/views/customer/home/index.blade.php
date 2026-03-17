@extends('layout.customer.CustomerLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (Auth::user()?->role == 'admin')
                            <p>Chào sếp: {{ Auth::user()->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
