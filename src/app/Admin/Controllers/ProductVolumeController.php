<?php

namespace App\Admin\Controllers;

use App\Models\Line;
use App\Models\Product;
use App\Models\ProductVolume;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductVolumeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '生産結果';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductVolume());

        $grid->filter(function($filter) {
            $filter->equal('line_id', 'ライン')->select(Line::list());
            $filter->equal('product_id', '製品')->select(Product::list());
            $filter->between('work_start_at', '開始時間')->datetime();
            $filter->between('work_end_at', '終了時間')->datetime();
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('line_id', 'ラインID')->sortable();
        $grid->column('line', 'ライン名')->display(function($line){
            return $line['name'];
        });
        $grid->column('product_id', '製品ID')->sortable();
        $grid->column('product', '製品名')->display(function($product){
            return "$product[name1]-$product[name2]";
        });
        $grid->column('count_worker', '作業者数')->sortable();
        $grid->column('count_volume', '生産数')->sortable();
        $grid->column('work_start_at', '開始時間')->display(function($work_start_at){
            return (new Carbon($work_start_at))->format('Y-m-d H:i');
        })->sortable();
        $grid->column('work_end_at', '終了時間')->display(function($work_end_at){
            return (new Carbon($work_end_at))->format('Y-m-d H:i');
        })->sortable();
        $grid->column('created_at', __('Created at'))->display(function($created_at){
            return (new Carbon($created_at))->format('Y-m-d H:i');
        })->sortable();
        $grid->column('updated_at', __('Updated at'))->display(function($updated_at){
            return (new Carbon($updated_at))->format('Y-m-d H:i');
        })->sortable();
        
        // $content = new Content();
        // $content->header('てすとページ')
        //     ->description('ほげほげ')
        //     ->row('<table border=1><tr><td>ほげほげ</td></tr></table>')

        //     ->body('てすとメッセージ');

        // return view('laravel-admin/product_volume/index',['admin::content' => $content]);
        
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ProductVolume::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('line_id', 'ラインID');
        $show->field('line', 'ライン名')->as(function($line){
            return $line->name;
        });
        $show->field('product_id', '製品ID');
        $show->field('product', '製品名')->as(function($product){
            return $product->name;
        });
        $show->field('count_volume', '生産数');
        $show->field('count_worker', '作業者数');
        $show->field('work_start_at', '開始時間');
        $show->field('work_end_at', '終了時間');
        $show->field('created_at', __('Created at'))->as(function($created_at){
            return (new Carbon($created_at))->format('Y-m-d H:i');
        });
        $show->field('updated_at', __('Updated at'))->as(function($updated_at){
            return (new Carbon($updated_at))->format('Y-m-d H:i');
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductVolume());

        $lines = [];
        foreach ( Line::all() as $line) {
            $lines += [
                $line->id => $line->name,
            ];
        }
        $products = [];
        foreach ( Product::all() as $product) {
            $products += [
                $product->id => "{$product->name1}-{$product->name2}",
            ];
        }

        $form->select('line_id', 'ライン名')->options($lines);
        $form->select('product_id', '製品名')->options($products);
        $form->number('count_volume', '生産数');
        $form->number('count_worker', '作業者数');
        $form->datetime('work_start_at', '開始時間')->default(date('Y-m-d H:i:s'));
        $form->datetime('work_end_at', '終了時間')->default(date('Y-m-d H:i:s'));

        return $form;
    }
    /* 
       chart data
    */
    public function chart(Content $content)
    {
        // product_volume get group by 'product_id' and 'month_day': values of Y axis
        $product_volumes = DB::table('product_volumes')
        ->leftJoin('products', 'product_volumes.product_id', '=', 'products.id')
        ->select('product_id', DB::raw("DATE_FORMAT(work_end_at, '%M-%d') as month_day"), DB::raw('SUM(count_volume) as count_volume'), DB::raw('SUM(count_worker) as count_worker'))
        ->groupBy('product_id', 'month_day')
        ->orderBy('product_id')
        ->get();

        // Array of ending_date: X axis
        $month_days = DB::table('product_volumes')->distinct()->orderBy('month_day')->pluck(DB::raw("DATE_FORMAT(work_end_at, '%M-%d') as month_day"));

        // Array of products
        $product_values = DB::table('products')->distinct()->get();
        $types = ['bar', 'line']; // chart types
        $datasets = []; // correspondenting with datasets of chart.blade.php
        $backgroundColors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 205, 86, 0.5)']; // backgroundColor array
        $borderColors = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 205, 86, 1)']; // borderColor array

        foreach($types as $type){
            $i = 0;
            foreach($product_values as $key => $val)
            {
                $data = [];
                foreach($product_volumes as $product => $value)
                {
                    if($val->id == $value->product_id && $type == 'bar')
                        $data[]=[$value->count_volume];
                    else if($val->id == $value->product_id && $type == 'line')
                        $data[]=[$value->count_volume/$value->count_worker];
                }
                if($type == 'bar')
                    $datasets[]=[
                        'label' => $val->name1."-".$val->name2."(".$type.")",
                        'type' => $type,
                        'backgroundColor' => $backgroundColors[$i],
                        'borderColor' => $borderColors[$i],
                        'borderWidth' => 1,
                        'data' => $data,
                    ];
                else
                    $datasets[]=[
                        'label' => $val->name1."-".$val->name2."(".$type.")",
                        'type' => $type,
                        'borderColor' => $borderColors[$i],
                        'borderWidth' => 2,
                        'data' => $data,
                    ];                    
                $i++;
            }
        }
        $labels = $month_days; // correspondenting with labels of chart.blade.php
        $yAxes = [
            [
                "ticks" => [
                    "beginAtZero" => true,
                ],
            ],
        ]; // y axes start from zero.
        return $content
        ->header('Chart')
        ->body(new Box('Combo Bar Line', view('laravel-admin.chart', compact('labels', 'datasets', 'yAxes'))));
    }
}
