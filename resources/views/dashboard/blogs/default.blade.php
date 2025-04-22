
<a onclick="st('{{ $blog->id }}', '{{ route($route, ':id') , 'status' }}')" data-status="{{ $blog->is_default }}">
        <img
            src="{{ $blog->is_default == 1 ? asset('dashboard/icon/tick.png') : asset('dashboard/icon/error.png') }}"
            id="icon-status-{{ $blog->id }}"
            class="icon"
            style="width: 30px; height: 30px; cursor: pointer;"
        >
    </a>

