
<x-datatable :dataTable="$dataTable" :title="__('general.Blogs')">
    <x-slot:header>
        <a href="{{ route('blog.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
