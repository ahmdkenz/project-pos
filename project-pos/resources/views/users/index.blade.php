@extends('layouts.app')

@section('title','Manajemen User - SALES & SERVICE')
@section('header-title','Manajemen User')

@section('content')

    <div class="page-header">
        <form method="GET" action="{{ route('users.index') }}" style="flex: 1; max-width: 500px;">
            <div style="position: relative;">
                <i data-feather="search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #718096; width: 18px; height: 18px;"></i>
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari nama atau username..."
                    autocomplete="off"
                    style="width: 100%; padding: 0.75rem 1rem 0.75rem 3rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0.95rem; font-family: 'Poppins', sans-serif;"
                />
            </div>
        </form>
        <a href="{{ route('users.create') }}" class="cta-button">
            <i data-feather="plus"></i>
            Tambah User
        </a>
    </div>

    <div class="content-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                @php $isSelf = $user->is(auth()->user()); @endphp
                <tr>
                    <td>
                        <strong>{{ $user->name }}</strong>
                        @if($isSelf)<span class="pill" style="margin-left:0.4rem;">Anda</span>@endif
                    </td>
                    <td>{{ $user->username }}</td>
                    <td><span class="pill role">{{ ucfirst($user->getRoleNames()->first() ?? 'Tanpa role') }}</span></td>
                    <td><span class="pill {{ $user->is_active ? 'on' : 'off' }}">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                    <td class="action-buttons">
                        <a href="{{ route('users.edit', $user) }}" title="Edit"><i data-feather="edit-2"></i></a>
                        @unless($isSelf)
                        <form action="{{ route('users.toggle-active', $user) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} user ini?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}" style="background:none;border:none;padding:0;margin:0;vertical-align:middle;color:#718096;">
                                <i data-feather="{{ $user->is_active ? 'user-x' : 'user-check' }}"></i>
                            </button>
                        </form>
                        @endunless
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem; color: #718096;">
                        Tidak ada user yang ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if($users->hasPages())
        <div style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $users->links() }}
        </div>
        @endif
    </div>

@endsection

@push('styles')
    @include('partials.access-styles')
@endpush
