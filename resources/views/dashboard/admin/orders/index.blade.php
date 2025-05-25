<x-datatable :dataTable="$dataTable" :title="__('general.Schools')">
    <x-slot name="content">
        {{-- محتوى المودال --}}
        <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="changeStatusForm" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('general.update status') }}</h5>
                        </div>
                        <div class="modal-body">
                            <select name="status" id="statusSelect" class="form-control">
                                <option value="preparing">{{ __('general.preparing') }}</option>
                                <option value="delivering">{{ __('general.delivering') }}</option>
                                <option value="completed">{{ __('general.completed') }}</option>
                                <option value="cancelled">{{ __('general.cancelled') }}</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('general.close') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <x-slot name="script">
        <script>
            $(document).on('click', '.change-status-btn', function (e) {
                e.preventDefault();
                let url = $(this).data('url');
                $('#changeStatusForm').attr('action', url);
                $('#changeStatusModal').modal('show');
            });

            $('#changeStatusForm').submit(function (e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let formData = form.serialize();

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#changeStatusModal').modal('hide');

                        // ⚠️ Blade سيعالج هذا الجزء لأننا داخل Blade وليس في ملف JS خارجي
                        window.LaravelDataTables["{{ $dataTable->getTableAttribute('id') }}"].ajax.reload(null, false);

                        toastr.success("تم تغيير الحالة بنجاح");
                    },
                    error: function (xhr) {
                        toastr.error("حدث خطأ أثناء تغيير الحالة");
                    }
                });
            });
        </script>
    </x-slot>
</x-datatable>
