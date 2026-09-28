@extends('layouts.app')

@section('title','Tambah User - SALES & SERVICE')
@section('header-title','Tambah User')

@section('content')

    <a href="{{ route('users.index') }}" class="back-link">
        <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
        Kembali ke Manajemen User
    </a>

    <div class="content-card">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('users._form', ['user' => null])
        </form>
    </div>

@endsection
