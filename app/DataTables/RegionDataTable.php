<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\Region;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class RegionDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($region) {
                return view('components.datatable.actions', [
                    'id' => $region->id,
                    'routeEdit' => 'admin.regions.edit',
                    'routeDelete' => 'admin.regions.destroy',
                    'name' => App::getLocale() === 'ar' ? $region->name_ar : $region->name_en,
                ]);
            })
            ->editColumn('status', function ($city) {
                return $city->status == '1' ? 'Active' : 'Inactive';
            })

            ->rawColumns(['action', 'image']);

    }

    public function query(Region $model ,Request $request)
    {
        $id = $request->route('id');
        $query = $id ? $model->newQuery()->where('city_id', $id) : $model->newQuery();
        return $query->latest();

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
            Column::make('status')->title(__('dataTable.status')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'regions_' . date('YmdHis');
    }
}

