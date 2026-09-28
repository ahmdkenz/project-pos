{{-- Form role bersama untuk create & edit. $role null saat create; $groups dari config/access.php. --}}
@php $selected = old('permissions', $role ? $role->permissions->pluck('name')->all() : []); @endphp

<div class="form-grid">
    <div class="form-group full-width">
        <label for="name">Nama Role</label>
        <input type="text" id="name" name="name" value="{{ old('name', $role->name ?? '') }}" maxlength="50" placeholder="Contoh: supervisor" required>
    </div>
</div>

<h3 style="margin: 1.5rem 0 1rem;">Hak Akses</h3>

@foreach($groups as $key => $group)
<div class="perm-group">
    <div class="perm-group-header">
        <strong>{{ $group['label'] }}</strong>
        <label class="perm-item" style="padding:0;">
            <input type="checkbox" data-check-all="{{ $key }}">
            <span>Pilih semua</span>
        </label>
    </div>
    <div class="perm-list">
        @foreach($group['permissions'] as $name => $label)
        <label class="perm-item">
            <input type="checkbox" name="permissions[]" value="{{ $name }}" data-group="{{ $key }}" @checked(in_array($name, $selected))>
            <span>{{ $label }}</span>
            <code>{{ $name }}</code>
        </label>
        @endforeach
    </div>
</div>
@endforeach

<div class="form-footer">
    <a href="{{ route('roles.index') }}" class="secondary-button" style="width:auto;">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // "Pilih semua" per grup, ikut tercentang otomatis jika semua item grup sudah dipilih
    document.querySelectorAll('[data-check-all]').forEach(function (master) {
        const boxes = document.querySelectorAll('input[data-group="' + master.dataset.checkAll + '"]');
        const sync = function () { master.checked = Array.from(boxes).every(function (b) { return b.checked; }); };

        master.addEventListener('change', function () {
            boxes.forEach(function (b) { b.checked = master.checked; });
        });
        boxes.forEach(function (b) { b.addEventListener('change', sync); });
        sync();
    });
});
</script>
@endpush
