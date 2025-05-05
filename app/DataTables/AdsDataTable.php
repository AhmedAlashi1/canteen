<?php

namespace App\DataTables;

use App\Models\Ad;
use App\Models\City;
use App\Models\School;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class AdsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($ads) {
                return view('components.datatable.actions', [
                    'id' => $ads->id,
                    'routeEdit' => 'admin.ads.edit',
                    'routeDelete' => 'admin.ads.destroy',
                    'name' => $ads->name,
                ]);
            })

            ->editColumn('image', function ($ads) {
                return $ads->image ? '<img src="'.asset($ads->image).'" width="50" height="50">' : '';
            })

            ->rawColumns(['action', 'image']);

    }

    public function query(Ad $model)
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
            Column::make('link')->title(__('dataTable.link')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'cities_' . date('YmdHis');
    }
}

