<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\ContactUs;
use App\Models\School;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ContactUsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($contactUs) {
                return view('components.datatable.actions', [
                    'id' => $contactUs->id,
                    'routeDelete' => 'admin.contact-us.destroy',
                    'name' =>  $contactUs->name,
                ]);
            })

            ->rawColumns(['action']);

    }

    public function query(ContactUs $model)
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
            Column::make('email')->title(__('dataTable.email')),
            Column::make('message')->title(__('dataTable.message')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'cities_' . date('YmdHis');
    }
}

