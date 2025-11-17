{{-- Centralized notifications partial: collect session flashes, dedupe, and show via showToast() --}}
@php
    // Common session keys used across the app
    $keys = ['status','success','error','info','warning','message'];
    $messages = [];

    foreach ($keys as $k) {
        if (session()->has($k)) {
            $val = session()->pull($k);
            if (is_array($val)) {
                foreach ($val as $v) {
                    $messages[] = ['type' => $k === 'status' ? 'success' : $k, 'text' => (string) $v];
                }
            } else {
                $messages[] = ['type' => $k === 'status' ? 'success' : $k, 'text' => (string) $val];
            }
        }
    }

    // Support flash_notifications (packages/style)
    if (session()->has('flash_notifications')) {
        $flashes = session()->pull('flash_notifications');
        if (is_array($flashes)) {
            foreach ($flashes as $f) {
                if (is_array($f) && isset($f['level'], $f['message'])) {
                    $messages[] = ['type' => $f['level'], 'text' => (string) $f['message']];
                } elseif (is_string($f)) {
                    $messages[] = ['type' => 'info', 'text' => $f];
                }
            }
        }
    }

    // Validation errors aggregated
    if (isset($errors) && $errors->any()) {
        foreach ($errors->all() as $err) {
            $messages[] = ['type' => 'error', 'text' => (string) $err];
        }
    }

    // Remove duplicates (same type + text)
    $seen = [];
    $unique = [];
    foreach ($messages as $m) {
        $key = md5($m['type'] . '|' . $m['text']);
        if (!isset($seen[$key])) {
            $seen[$key] = true;
            $unique[] = $m;
        }
    }
@endphp

@if(count($unique))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($unique as $m)
            showToast(@json($m['type']), @json($m['text']));
        @endforeach
    });
    </script>
@endif
