
<x-datatable :dataTable="$dataTable" :title="__('general.categories')">
    <x-slot:header>
        <a href="{{ route('admin.categories.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
