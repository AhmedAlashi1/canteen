<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\School;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class CitiesDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($city) {
                return view('components.datatable.actions', [
                    'id' => $city->id,
                    'routeEdit' => 'admin.cities.edit',
                    'routeDelete' => 'admin.cities.destroy',
                    'routeRegion' => 'admin.regions.index',
                    'name' => App::getLocale() === 'ar' ? $city->name_ar : $city->name_en,
                ]);
            })
            ->editColumn('status', function ($city) {
                return $city->status == '1' ? 'Active' : 'Inactive';
            })
            ->editColumn('image', function ($city) {
                return $city->image ? '<img src="'.asset($city->image).'" width="50" height="50">' : '';
            })
            ->rawColumns(['action', 'image']);

    }

    public function query(City $model)
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
            Column::make('code')->title(__('dataTable.code')),
            Column::make('country_code')->title(__('dataTable.country_code')),
            Column::make('status')->title(__('dataTable.status')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'cities_' . date('YmdHis');
    }
}

