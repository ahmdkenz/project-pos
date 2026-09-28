@extends('layouts.app')

@section('title','Manajemen Role - SALES & SERVICE')
@section('header-title','Manajemen Role')

@section('content')

    <div class="page-header">
        <p class="muted">Role menentukan menu dan aksi apa saja yang boleh dipakai user. Role <strong>Admin</strong> selalu memiliki semua hak akses.</p>
        <a href="{{ route('roles.create') }}" class="cta-button">
            <i data-feather="plus"></i>
            Tambah Role
        </a>
    </div>

    <div class="content-card">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Nama Role</th>
                    <th>Jumlah User</th>
                    <th>Hak Akses</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                @php $locked = $role->name === \App\Support\Access::superAdminRole(); @endphp
                <tr>
                    <td>
                        <strong>{{ ucfirst($role->name) }}</strong>
                        @if($locked)<span class="pill locked" style="margin-left:0.4rem;">Terkunci</span>@endif
                    </td>
                    <td>{{ $role->users_count }} user</td>
                    <td>{{ $locked ? 'Semua' : $role->permissions_count . ' hak akses' }}</td>
                    <td class="action-buttons">
                        @unless($locked)
                        <a href="{{ route('roles.edit', $role) }}" title="Edit"><i data-feather="edit-2"></i></a>
                        @if($role->users_count === 0)
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" class="delete-form" data-item-name="role {{ $role->name }}" data-item-type="Role" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus" style="background:none;border:none;padding:0;margin:0;vertical-align:middle;color:inherit;">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
                        @endif
                        @else
                        <span class="muted">—</span>
                        @endunless
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('styles')
    @include('partials.access-styles')
@endpush
