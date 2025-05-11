
<x-datatable :dataTable="$dataTable" :title="__('general.products')">
    <x-slot:header>
        <a href="{{ route('admin.products.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
