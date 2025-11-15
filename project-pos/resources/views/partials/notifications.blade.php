{{-- Toast Notifications - Modern & Interactive --}}
@if(session('status') || session('success') || session('error') || session('info') || session('warning'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(session('status') || session('success'))
        showToast('success', @json(session('status') ?? session('success')));
    @endif
    
    @if(session('error'))
        showToast('error', @json(session('error')));
    @endif
    
    @if(session('info'))
        showToast('info', @json(session('info')));
    @endif
    
    @if(session('warning'))
        showToast('warning', @json(session('warning')));
    @endif
});
</script>
@endif
