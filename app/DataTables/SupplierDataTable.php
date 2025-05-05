<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\School;
use App\Models\Supplier;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class SupplierDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($supplier) {
                return view('components.datatable.actions', [
                    'id' => $supplier->id,
                    'routeEdit' => 'admin.suppliers.edit',
                    'routeDelete' => 'admin.suppliers.destroy',
                    'name' => $supplier->name,
                ]);
            })

            ->rawColumns(['action', 'image']);

    }

    public function query(Supplier $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->addTableClass('table table-hover');
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title(__('dataTable.id')),
            Column::make('name')->title(__('dataTable.name')),
            Column::make('phone')->title(__('dataTable.phone')),
            Column::make('email')->title(__('dataTable.email')),
            Column::make('company_name')->title(__('dataTable.company_name')),
            Column::make('whatsapp')->title(__('dataTable.whatsapp')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'suppliers_' . date('YmdHis');
    }
}

