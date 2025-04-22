
<x-datatable :dataTable="$dataTable" :title="__('general.Services')">
    <x-slot:header>
        <a href="{{ route('services.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
