
<x-datatable :dataTable="$dataTable" :title="__('general.Companies')">
    <x-slot:header>
        <a href="{{ route('company.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
