@extends('layouts.app')

@section('title','Akses Ditolak - SALES & SERVICE')
@section('header-title','Akses Ditolak')

@section('content')

    <div class="content-card" style="text-align: center; padding: 3rem 2rem;">
        <div style="font-size: 4rem; font-weight: 700; color: #EF4444; line-height: 1;">403</div>
        <h3 style="margin: 1rem 0 0.5rem;">Anda tidak punya akses ke halaman ini</h3>
        <p style="color: #718096; margin-bottom: 1.5rem;">
            Hak akses akun Anda tidak mencakup halaman tersebut. Hubungi admin jika Anda merasa ini keliru.
        </p>
        <a href="javascript:history.back()" class="secondary-button" style="width:auto; display:inline-flex;">
            <i data-feather="arrow-left" style="width:16px; height:16px;"></i>
            Kembali
        </a>
    </div>

@endsection
