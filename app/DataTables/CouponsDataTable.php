<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class CouponsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($coupon) {
                return view('components.datatable.actions', [
                    'id' => $coupon->id,
                    'routeEdit' => 'admin.coupons.edit',
                    'routeDelete' => 'admin.coupons.destroy',
                    'name' => $coupon->code,
                ]);
            })
            //end_at
            ->editColumn('end_at', function ($coupon) {
                return $coupon->end_at ? \Carbon\Carbon::parse($coupon->end_at)->format('Y-m-d'): '';
            })

//            ->editColumn('status', function ($coupon) {
//                return $coupon->status == '1' ? 'Active' : 'Inactive';
//            })
            ;
    }

    public function query(Coupon $model)
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
            Column::make('code')->title(__('dataTable.code')),
            Column::make('discount')->title(__('dataTable.discount')),
            Column::make('type')->title(__('dataTable.type')),
            Column::make('use_number')->title(__('dataTable.use_number')),
//            Column::make('code_limit')->title(__('dataTable.code_limit')),
            Column::make('end_at')->title(__('dataTable.end_at')),
            Column::make('status')->title(__('dataTable.status')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'coupons_' . date('YmdHis');
    }
}
