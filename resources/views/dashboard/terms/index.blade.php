
<x-datatable :dataTable="$dataTable" :title="__('general.Terms & Conditions')">
    <x-slot:header>
        <a href="{{ route('term.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
