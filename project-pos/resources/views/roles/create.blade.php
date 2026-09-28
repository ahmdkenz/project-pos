@extends('layouts.app')

@section('title','Tambah Role - SALES & SERVICE')
@section('header-title','Tambah Role')

@section('content')

    <a href="{{ route('roles.index') }}" class="back-link">
        <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
        Kembali ke Manajemen Role
    </a>

    <div class="content-card">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            @include('roles._form', ['role' => null])
        </form>
    </div>

@endsection
