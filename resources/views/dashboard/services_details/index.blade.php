
<x-datatable :dataTable="$dataTable" :title="__('general.Services')">
    <x-slot:header>
        <a href="{{ route('ServiceDetails.create',$id) }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
