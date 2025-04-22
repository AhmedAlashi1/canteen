@if($type == 'status')
    <a onclick="st('{{ $work->id }}', '{{ route($route, ':id') }}', 'status')" data-status="{{ $work->status }}">
        <img
            src="{{ $work->status == 1 ? asset('dashboard/icon/tick.png') : asset('dashboard/icon/error.png') }}"
            id="icon-status-{{ $work->id }}"
            class="icon"
            style="width: 30px; height: 30px; cursor: pointer;"
        >
    </a>
@else
    <a onclick="st('{{ $work->id }}', '{{ route($route, ':id') }}', 'contact')" data-status="{{ $work->is_contact_us }}">
        <img
            src="{{ $work->is_contact_us == 1 ? asset('dashboard/icon/tick.png') : asset('dashboard/icon/error.png') }}"
            id="icon-contact-{{ $work->id }}"
            class="icon"
            style="width: 30px; height: 30px; cursor: pointer;"
        >
    </a>
@endif
