<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class CategoryDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($category) {
                return view('components.datatable.actions', [
                    'id' => $category->id,
                    'routeEdit' => 'admin.categories.edit',
                    'routeDelete' => 'admin.categories.destroy',
                    'name' => $category->name_ar,
                ]);
            })
//            ->editColumn('status', function ($category) {
//                return $category->status == '1' ? 'مفعل' : 'غير مفعل';
//            })
            ;
    }

    public function query(Category $model)
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
            Column::make('status')->title(__('dataTable.status')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'categories_' . date('YmdHis');
    }
}
