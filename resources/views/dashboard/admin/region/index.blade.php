
<x-datatable :dataTable="$dataTable" :title="__('regions')">
    <x-slot:header>
        <a href="{{ route('admin.regions.create',$id) }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
