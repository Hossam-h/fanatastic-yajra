<?php
namespace App\DataTables;
 
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
 
class UserDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return datatables()
        ->eloquent($query)
        ->addColumn('actions',function($row){
            return view('users.action', ['row' => $row]);
        }); // Add action buttons if needed
    }
 
    public function query(User $model): QueryBuilder
    {
        return $model->select('id','name','email')->newQuery();
    }
 
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
                    ]);
    }
 
    public function getColumns(): array
    {
        return [
            ['data'=>'id', 'name'=> 'id', 'orderable'=> true, 'searchable'=> true],
            ['data'=> 'name', 'name'=> 'name', 'orderable'=> true, 'searchable'=> true],
            ['data'=> 'email', 'name'=> 'email', 'orderable'=> true, 'searchable'=> true],
            ['data'=> 'actions', 'name'=> 'actions', 'orderable'=> false, 'searchable'=> false],
        ];
    }
 
    protected function filename(): string
    {
        return 'Users_'.date('YmdHis');
    }
}