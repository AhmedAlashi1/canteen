<?php

namespace App\DataTables;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class AddressDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user', function ($address) {
                return $address->user ? $address->user->name : '-';
            })
            ->addColumn('city', function ($address) {
                return $address->city ? $address->city->name_en : '-';
            })
            ->addColumn('region', function ($address) {
                return $address->region ? $address->region->name_en : '-';
            })
            ->editColumn('is_default', function ($address) {
                return $address->is_default ? __('Yes') : __('No');
            })
            ->addColumn('action', function ($address) {
                return view('components.datatable.actions', [
                    'id' => $address->id,
//                    'routeEdit' => 'admin.address.edit',
                    'routeDelete' => 'admin.address.destroy',
                    'name' => $address->user ? $address->user->name : '',
                ]);
            })
            ->rawColumns(['action']);
    }

    public function query(Address $model, Request $request)
    {
        $id = $request->route('id');
        $query = $id ? $model->newQuery()->where('user_id', $id) : $model->newQuery();

        return $query->with(['user', 'city', 'region'])->latest();
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
            Column::make('user')->title(__('dataTable.user')),
            Column::make('city')->title(__('dataTable.city')),
            Column::make('region')->title(__('dataTable.region')),
            Column::make('block')->title(__('dataTable.block')),
            Column::make('street_name')->title(__('dataTable.street_name')),
            Column::make('building_no')->title(__('dataTable.building_no')),
            Column::make('is_default')->title(__('dataTable.is_default')),
            Column::computed('action')
                ->title(__('dataTable.action'))
                ->exportable(false)
                ->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'addresses_' . date('YmdHis');
    }
}
