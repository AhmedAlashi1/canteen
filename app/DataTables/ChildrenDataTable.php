<?php

namespace App\DataTables;

use App\Models\Child;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ChildrenDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($child) {
                return view('components.datatable.actions', [
                    'id' => $child->id,
                    'routeEdit' => 'admin.children.edit',
                    'routeDelete' => 'admin.children.destroy',
                    'name' => $child->name,
                ]);
            })
            ->addColumn('image', function ($child) {
                return view('components.datatable.image', ['photo' => $child->image]);
            })
            ->addColumn('status', function ($child) {
                return match ($child->status) {
                    'active' => __('dataTable.active'),
                    'pending_approval' => __('dataTable.pending'),
                    default => __('dataTable.inactive'),
                };
            })
            ->addColumn('created_at', function ($child) {
                return $child->created_at->format('Y-m-d H:i');
            })
            ->addColumn('user', function ($child) {
                return $child->user ? $child->user->name : '-';
            })
            ->addColumn('school', function ($child) {
                return $child->school ? $child->school->name_en : '-';
            })


            ->rawColumns(['action', 'image']);
    }

    public function query(Child $model)
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
            Column::make('image')->title(__('dataTable.image'))->orderable(false)->searchable(false),
            Column::make('name')->title(__('dataTable.name')),
            Column::make('user')->title(__('dataTable.father')),
            Column::make('school')->title(__('dataTable.school')),
            Column::make('level')->title(__('dataTable.level')),
            Column::make('student_number')->title(__('dataTable.student_number')),
            Column::make('status')->title(__('dataTable.status')),
            Column::make('created_at')->title(__('dataTable.created_at')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'children_' . date('YmdHis');
    }
}
