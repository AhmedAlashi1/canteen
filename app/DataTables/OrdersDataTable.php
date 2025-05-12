<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class OrdersDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($order) {
                return view('components.datatable.actions', [
                    'id' => $order->id,
//                    'routeEdit' => 'admin.orders.edit',
//                    'routeDelete' => 'admin.orders.destroy',
                    'name' => $order->id,
                ]);
            })
            ->addColumn('user', function ($order) {
                return $order->user ? $order->user->name : '-';
            })
            ->addColumn('child', function ($order) {
                return $order->child ? $order->child->name : '-';
            })
            ->addColumn('status', function ($order) {
                return __( 'dataTable.' . $order->status );
            })
            ->addColumn('payment_status', function ($order) {
                return __( 'dataTable.' . $order->payment_status );
            })
            ->addColumn('type', function ($order) {
                return __( 'dataTable.' . $order->type );
            })
            ->addColumn('created_at', function ($order) {
                return $order->created_at->format('Y-m-d H:i');
            });
    }

    public function query(Order $model)
    {
        return $model->newQuery()->with(['user', 'child']);
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
            Column::make('user')->title(__('dataTable.father')),
            Column::make('child')->title(__('dataTable.child')),
            Column::make('status')->title(__('dataTable.status')),
            Column::make('total')->title(__('dataTable.total')),
            Column::make('payment_status')->title(__('dataTable.payment_status')),
            Column::make('type')->title(__('dataTable.type')),
            Column::make('created_at')->title(__('dataTable.created_at')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'orders_' . date('YmdHis');
    }
}
