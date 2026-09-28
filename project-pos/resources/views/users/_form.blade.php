{{-- Form user bersama untuk create & edit. $user null saat create. --}}
@php $editing = (bool) $user; @endphp

<div class="form-grid">

    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" maxlength="255" required>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" maxlength="50" pattern="[A-Za-z0-9._\-]+" title="Huruf, angka, titik, garis bawah, atau strip (tanpa spasi)" autocapitalize="none" spellcheck="false" required>
    </div>

    <div class="form-group">
        <label for="password">Password @if($editing)<span class="muted">(kosongkan jika tidak diubah)</span>@endif</label>
        <input type="password" id="password" name="password" minlength="8" autocomplete="new-password" placeholder="Minimal 8 karakter" @required(!$editing)>
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select id="role" name="role" required>
            <option value="">-- Pilih role --</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" @selected(old('role', $user?->getRoleNames()->first()) === $role->name)>{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group full-width">
        {{-- Hidden 0 memastikan nilai tetap terkirim (dan old()) saat checkbox tidak dicentang --}}
        <input type="hidden" name="is_active" value="0">
        <label class="check-row">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active ?? true))>
            User aktif (bisa login)
        </label>
    </div>

</div>

<div class="form-footer">
    <a href="{{ route('users.index') }}" class="secondary-button" style="width:auto;">
        Batal
    </a>
    <button type="submit" class="cta-button">
        <i data-feather="save"></i>
        Simpan
    </button>
</div>

@push('styles')
    @include('partials.access-styles')
@endpush
