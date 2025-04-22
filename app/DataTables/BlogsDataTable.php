<?php

namespace App\DataTables;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($blog) {
                return view('components.datatable.actions', [
                    'id' => $blog->id,
                    'routeEdit' => 'blog.edit',
                    'routeDelete' => 'blog.destroy',
                    'name' => App::getLocale() === 'ar' ? $blog->title_ar : $blog->title_en // Dynamic language selection
                ]);
            })
            ->addColumn('image', function ($blog) {
                return view('components.datatable.image', ['photo' => $blog->image]);
            })
            ->addColumn('is_default', function ($blog) {
                return view('dashboard.blogs.default', [
                    'blog' => $blog,
                    'route' => 'update-blog-default'
                ]);
            })
            ->addColumn('created_at', function ($blog) {
                return $blog->created_at->format('Y-m-d H:i');
            })
            ->addColumn('type', function ($blog) {
                return App::getLocale() === 'ar' ? $blog->blog_type->name_ar : $blog->blog_type->name_en; // Dynamic language selection
            })
            ->rawColumns(['action'])
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('created_at', 'like', '%' . $keyword . '%');
                });
            })
            ->filterColumn('blog_type', function ($query, $keyword) {
                $query->whereHas('blog_type', function ($query) use ($keyword) {
                    $query->where(App::getLocale() === 'ar' ? 'name_ar' : 'name_en', 'like', '%' . $keyword . '%'); // Dynamic language selection
                });
            })
            ->orderColumn('created_at', function ($query, $order) {
                $query->orderBy('created_at', $order);
            })
            ->orderColumn('blog_type', function ($query, $order) {
                $column = App::getLocale() === 'ar' ? 'blog__types.name_ar' : 'blog__types.name_en'; // Dynamic language selection
                $query->orderByRaw("(SELECT $column FROM blog__types WHERE blog__types.id = blogs.blog_type_id) $order");
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Blog $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc' )
            ->selectStyleSingle()
            ->language([
                'search' => __('dataTable.Search'),
                'lengthMenu' => __('dataTable.Show').' _MENU_ '.__('dataTable.Entries'),
                'zeroRecords' => __('dataTable.No matching records found'),
                'info' => __('dataTable.Showing').' _START_ '.__('dataTable.to').' _END_ '.__('dataTable.of').' _TOTAL_ '.__('dataTable.entries'),
                'infoEmpty' => __('dataTable.No records available'),
                'infoFiltered' => __('dataTable.filtered from').' _MAX_ '.__('dataTable.total records'),
                'paginate' => [
                    'first' => __('dataTable.First'),
                    'last' => __('dataTable.Last'),
                    'next' => __('dataTable.Next'),
                    'previous' => __('dataTable.Previous'),
                ],
            ])
            ->lengthMenu([[5, 10, 25, 50, 100, 500], [5, 10, 25, 50, 100, 500]])// Customize the available options
            ->addTableClass('table rounded rounded-3 table-hover border');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title(__('dataTable.id'))
                ->addClass('text-center align-middle'),
            Column::make('image')
                ->title(__('dataTable.image'))
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center align-middle')
                ->orderable(false)
                ->searchable(false),
            Column::make('title_' . (App::getLocale() === 'ar' ? 'ar' : 'en'))
                ->title(__('dataTable.title'))
                ->addClass('text-center align-middle'),
            Column::make('is_default')
                ->title(__('dataTable.is_default'))
                ->addClass('text-center align-middle'),
            Column::make('by')
                ->title(__('dataTable.by'))
                ->addClass('text-center align-middle'),
            Column::make('type')
                ->title(__('dataTable.type'))
                ->addClass('text-center align-middle'),
            Column::make('date')
                ->title(__('dataTable.date'))
                ->addClass('text-center align-middle'),
            Column::make('created_at')
                ->title(__('dataTable.created_at'))
                ->addClass('text-center align-middle'),
            Column::computed('action')
                ->title(__('dataTable.action'))
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center align-middle')
                ->orderable(false)
                ->searchable(false),
        ];
    }



    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Blogs_' . date('YmdHis');
    }
}
