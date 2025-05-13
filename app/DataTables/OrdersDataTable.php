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
                    'routeShow' => 'admin.orders.show',
                    'routeDelete' => 'admin.orders.destroy',
                    'name' => $order->id,
                ]);
            })
            ->addColumn('user', function ($order) {
                return $order->user ? $order->user->name : '-';
            })
            ->addColumn('child', function ($order) {
                return $order->child ? $order->child->name : '-';
            })
            //school
            ->addColumn('school', function ($order) {
                return $order->child ? $order->child->school->name_en : '-';
            })
            ->addColumn('status', function ($order) {
                $status = __( 'dataTable.' . $order->status );
                $colors = [
                    'completed' => ['background' => 'green', 'text' => 'white'],
                    'pending' => ['background' => 'orange', 'text' => 'white'],
                ];
                $color = $colors[$order->status] ?? ['background' => 'red', 'text' => 'white'];
                // إنشاء الكود HTML باستخدام اللون المحدد
                return '<span style="background-color: ' . $color['background'] . '; color: ' . $color['text'] . '; padding: 2px 6px; border-radius: 4px;">' . $status . '</span>';

            })
            ->addColumn('payment_status', function ($order) {
                $status = __( 'dataTable.' . $order->payment_status );
                $colors = [
                    'Paid' => ['background' => 'green', 'text' => 'white'],
                    'pending' => ['background' => 'orange', 'text' => 'white'],
                ];
                $color = $colors[$order->payment_status] ?? ['background' => 'red', 'text' => 'white'];
                // إنشاء الكود HTML باستخدام اللون المحدد
                return '<span style="background-color: ' . $color['background'] . '; color: ' . $color['text'] . '; padding: 2px 6px; border-radius: 4px;">' . $status . '</span>';
            })
            ->addColumn('type', function ($order) {
                return __( 'dataTable.' . $order->type );
            })
            ->addColumn('created_at', function ($order) {
                return $order->created_at->format('Y-m-d H:i');
            })

            ->rawColumns(['action', 'image','payment_status', 'status'])

        ->filterColumn('user', function ($query, $keyword) {
        $query->whereHas('user', function ($q) use ($keyword) {
            $q->where('name', 'like', "%{$keyword}%");
        });
    })
        ->filterColumn('child', function ($query, $keyword) {
            $query->whereHas('child', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            });
        })
        ->filterColumn('school', function ($query, $keyword) {
            $query->whereHas('child.school', function ($q) use ($keyword) {
                $q->where('name_en', 'like', "%{$keyword}%");
            });
        })
        ->filterColumn('status', function ($query, $keyword) {
            $query->where('status', 'like', "%{$keyword}%");
        })
        //payment_status
        ->filterColumn('payment_status', function ($query, $keyword) {
            $query->where('payment_status', 'like', "%{$keyword}%");
        });
    }

    public function query(Order $model)
    {
        return $model->newQuery()->with(['user', 'child.school']);
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
            //school
            Column::make('school')->title(__('dataTable.school')),
            Column::make('total')->title(__('dataTable.total')),
            Column::make('type')->title(__('dataTable.type')),
            Column::make('status')->title(__('dataTable.status')),
            Column::make('payment_status')->title(__('dataTable.payment_status')),
            Column::make('created_at')->title(__('dataTable.created_at')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'orders_' . date('YmdHis');
    }
}
