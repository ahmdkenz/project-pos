@extends('layouts.app')

@section('title','Edit Role - SALES & SERVICE')
@section('header-title','Edit Role')

@section('content')

    <a href="{{ route('roles.index') }}" class="back-link">
        <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
        Kembali ke Manajemen Role
    </a>

    <div class="content-card">
        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            @include('roles._form', ['role' => $role])
        </form>
    </div>

@endsection
