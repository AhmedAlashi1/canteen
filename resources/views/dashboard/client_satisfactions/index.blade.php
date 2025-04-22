
<x-datatable :dataTable="$dataTable" :title="__('general.Client Satisfactions') ">
    <x-slot:header>
        <a href="{{ route('client_satisfactions.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
