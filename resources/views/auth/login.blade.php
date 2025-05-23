@extends('adminlte::auth.login')

@section('css')

<style>
    .login-page{
        background-image: url('https://images.unsplash.com/photo-1497800839469-bdbe4fd9d391?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        background-size: cover;
        background-position: center;
    }

    .login-box{
        background: rgba(0, 0, 0, 0.5);
    }

    .login-box-body{
        border-radius: 10px;
    }

    .login-logo a{
        color: #fff;
    }
</style>

@endsection
