@extends('layouts.app')

@section('title','Edit User - SALES & SERVICE')
@section('header-title','Edit User')

@section('content')

    <a href="{{ route('users.index') }}" class="back-link">
        <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
        Kembali ke Manajemen User
    </a>

    <div class="content-card">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            @include('users._form', ['user' => $user])
        </form>
    </div>

@endsection
