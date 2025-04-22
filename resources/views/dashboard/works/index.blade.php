

<x-datatable :dataTable="$dataTable" :title="__('general.Works')">
    <x-slot:header>
        <a href="{{ route('work.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>

