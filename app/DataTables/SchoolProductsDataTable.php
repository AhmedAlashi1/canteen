<?php

namespace App\DataTables;

use App\Models\SchoolProduct;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class SchoolProductsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($schoolProduct) {
                $auth = auth('admin')->check() ? 'admin' : 'school';
                $viewData = [
                    'id' => $schoolProduct->id,
                    'name' => $schoolProduct->product->name_ar ?? '',
                ];
                    $viewData['routeEdit'] = 'school.school-products.edit';
                    $viewData['routeDelete'] = 'school.school-products.destroy';

                return view('components.datatable.actions', $viewData);
            })
            ->addColumn('product_name', fn($row) => $row->product->name_en ?? '-')
//            ->addColumn('supplier_name', fn($row) => $row->supplier->name ?? '-')
            ->editColumn('price', fn($row) => number_format($row->price, 2))
            ->editColumn('created_at', fn($row) => $row->created_at?->format('Y-m-d H:i'))
            //image
            ->editColumn('image', function ($row) {
                return $row->product->image ? '<img src="' . asset($row->product->image) . '" alt="Product Image" width="50" height="50">' : '-';
            })
            ->rawColumns(['action','image']);
    }

    public function query(SchoolProduct $model)
    {
        $query = $model->newQuery()->with(['product', 'supplier', 'school']);

        if (!auth('admin')->check()) {
            $query->where('school_id', auth('school')->id());
        }

        return $query;
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
        $columns = [
            Column::make('id')->title(__('dataTable.id')),
            Column::make('image')->title(__('dataTable.image')),
            Column::make('product_name')->title(__('dataTable.product')),
            Column::make('price')->title(__('dataTable.price')),
            Column::make('quantity')->title(__('dataTable.quantity')),
//            Column::make('supplier_name')->title(__('dataTable.supplier')),
            Column::make('created_at')->title(__('dataTable.created_at')),
            Column::computed('action')
                ->title(__('dataTable.action'))
                ->exportable(false)
                ->printable(false),
        ];



        return $columns;
    }

    protected function filename(): string
    {
        return 'school_products_' . date('YmdHis');
    }
}
