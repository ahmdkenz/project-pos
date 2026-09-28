{{-- Style bersama halaman Manajemen User & Role (badge + matriks permission) --}}
<style>
    .pill { display:inline-block; padding:0.25rem 0.7rem; border-radius:99px; font-size:0.8rem; font-weight:600; background-color:#e2e8f0; color:#4a5568; }
    .pill.on { background-color:#DEF7EC; color:#0E9F6E; }
    .pill.off { background-color:#FEE2E2; color:#DC2626; }
    .pill.role { background-color:#eef2ff; color:#4F46E5; }
    .pill.locked { background-color:#FEF3C7; color:#D97706; }

    .action-buttons button { cursor:pointer; }
    .action-buttons button:hover { color:#4F46E5; }
    .muted { color:#718096; font-size:0.875rem; }

    .check-row { display:flex !important; align-items:center; gap:0.6rem; cursor:pointer; font-weight:500 !important; }
    .check-row input[type="checkbox"] { width:auto !important; margin:0; }

    .perm-group { border:1px solid #eef2f7; border-radius:12px; margin-bottom:1rem; overflow:hidden; }
    .perm-group-header { display:flex; justify-content:space-between; align-items:center; padding:0.85rem 1.25rem; background-color:#f8f9fa; border-bottom:1px solid #eef2f7; }
    .perm-group-header strong { font-size:0.95rem; color:#1a202c; }
    .perm-list { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:0.25rem 1.5rem; padding:0.75rem 1.25rem; }
    .perm-item { display:flex; align-items:center; gap:0.6rem; padding:0.4rem 0; font-size:0.9rem; color:#2d3748; cursor:pointer; }
    .perm-item input { width:auto; margin:0; }
    .perm-item code { margin-left:auto; font-size:0.75rem; color:#718096; background-color:#f4f7fa; padding:0.1rem 0.4rem; border-radius:4px; }
</style>
