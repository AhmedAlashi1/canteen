<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ProductsDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($product) {
                $auth = auth('admin')->check() ? 'admin' : 'school';
                $viewData = [
                    'id' => $product->id,
                    'name' => $product->name,
                ];
                if ($auth === 'admin') {
                    $viewData['routeEdit'] = 'admin.products.edit';
                    $viewData['routeDelete'] = 'admin.products.destroy';
                }else {
                    $viewData['routeEdit'] = 'school.products.edit';
//                    $viewData['routeDelete'] = 'school.products.destroy';
                }

                return view('components.datatable.actions', $viewData);

            })
            //school
            ->editColumn('school', function ($product) {
                return $product->school ? $product->school->name_en : 'all';
            })
            ->editColumn('image', function ($ads) {
                return $ads->image ? '<img src="'.asset($ads->image).'" width="50" height="50">' : '';
            })
            //status
            ->editColumn('status', function ($product) {
                $statusText = match ($product->status) {
                    'active' => __('dataTable.active'),
                    'pending' => __('dataTable.pending'),
                    default => __('dataTable.inactive'),
                };

                $badgeClass = match ($product->status) {
                    'active' => 'badge bg-success',
                    'pending' => 'badge bg-warning text-dark',
                    default => 'badge bg-danger',
                };

                return '<span class="' . $badgeClass . '">' . $statusText . '</span>';
            })
            //created_at
            ->editColumn('created_at', function ($product) {
                return $product->created_at->format('Y-m-d H:i');
            })
            ->rawColumns(['action', 'image','status']);

    }

    public function query(Product $model)
    {
        $auth = auth('admin')->check() ? 'admin' : 'school';
        if ($auth == 'admin') {
            return $model->newQuery()->with(['category', 'school']);
        } else {
            return $model->newQuery()->with(['category'])
                ->where('type','school')
                ->where(function ($query) {
                    $query->whereNull('school_id')
                        ->orWhere('school_id', auth('school')->user()->id);
                });
        }
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
        $columns[] = Column::make('id')->title(__('dataTable.id'));
        $columns[] = Column::make('image')->title(__('dataTable.image'))->orderable(false)->searchable(false);
        $columns[] = Column::make('name_ar')->title(__('dataTable.name'));
        $columns[] = Column::make('type')->title(__('dataTable.type'));

        if (auth('admin')->check()) {
            $columns[] = Column::make('price')->title(__('dataTable.price'));

        }else{
            $columns[] = Column::make('school')->title(__('dataTable.school'));
              $columns[] = Column::make('category.name_ar')->title(__('dataTable.category'));

        }
        $columns[] = Column::make('status')->title(__('dataTable.status'));
        $columns[] = Column::make('created_at')->title(__('dataTable.created_at'));
        $columns[] =     Column::computed('action')
            ->title(__('dataTable.action'))
            ->exportable(false)
            ->printable(false);
        return $columns;

    }

    protected function filename(): string
    {
        return 'products_' . date('YmdHis');
    }
}
