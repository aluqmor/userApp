@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Hola {{ Auth::check() ? Auth::user()->name : 'invitado' }}
                </div>
                <div class="card-body">
                    <a href="{{ url('home') }}">Login</a>
                    <br>
                    <a href="{{ route('verificado') }}">Verification</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection