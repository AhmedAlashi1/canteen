<?php

namespace App\DataTables;

use App\Models\School;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class SchoolsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($school) {
                return view('components.datatable.actions', [
                    'id' => $school->id,
                    'routeEdit' => 'admin.schools.edit',
                    'routeDelete' => 'admin.schools.destroy',
                    'name' => App::getLocale() === 'ar' ? $school->name_ar : $school->name_en,
                ]);
            })
            ->addColumn('image', function ($school) {
                return view('components.datatable.image', ['photo' => $school->image]);
            })
            ->addColumn('created_at', function ($school) {
                return $school->created_at->format('Y-m-d H:i');
            })
            ->rawColumns(['action', 'image']);
    }

    public function query(School $model)
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
            Column::make('name_ar')->title(__('dataTable.name')),
            Column::make('email')->title(__('dataTable.email')),
            Column::make('phone1')->title(__('dataTable.phone')),
            Column::make('created_at')->title(__('dataTable.created_at')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'schools_' . date('YmdHis');
    }
}

