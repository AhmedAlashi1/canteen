<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ProductsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($product) {
                return view('components.datatable.actions', [
                    'id' => $product->id,
                    'routeEdit' => 'admin.products.edit',
                    'routeDelete' => 'admin.products.destroy',
                    'name' => $product->name_ar,
                ]);
            });
//            ->editColumn('status', function ($product) {
//                return $product->status == 'active' ? __('general.active') : __('general.inactive');
//            });
    }

    public function query(Product $model)
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
            Column::make('name_ar')->title(__('dataTable.name')),
            Column::make('type')->title(__('dataTable.type')),
            Column::make('price')->title(__('dataTable.price')),
            Column::make('status')->title(__('dataTable.status')),
            Column::computed('action')
                ->title(__('dataTable.action'))
                ->exportable(false)
                ->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'products_' . date('YmdHis');
    }
}
