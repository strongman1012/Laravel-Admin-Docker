<?php

namespace App\Admin\Controllers;

use App\Models\Line;
use App\Models\LineProduct;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Carbon;

class LineProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ライン - 製品マスタ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LineProduct());

        $grid->column('id', 'ID')->sortable();
        $grid->column('line_id', 'ラインID')->sortable();
        $grid->column('line', 'ライン名')->display(function($line){
            return $line['name'];
        });
        $grid->column('product_id', '製品ID')->sortable();
        $grid->column('product', '製品名')->display(function($product){
            return "$product[name1]-$product[name2]";
        });
        $grid->column('created_at', __('Created at'))->display(function($created_at){
            return (new Carbon($created_at))->format('Y-m-d H:i');
        })->sortable();
        $grid->column('updated_at', __('Updated at'))->display(function($updated_at){
            return (new Carbon($updated_at))->format('Y-m-d H:i');
        })->sortable();

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
        $show = new Show(LineProduct::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('line_id', 'ラインID');
        $show->field('line', 'ライン名')->as(function($line){
            return $line->name;
        });
        $show->field('product_id', '製品ID');
        $show->field('product', '製品名')->as(function($product){
            return $product->name;
        });
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
        $form = new Form(new LineProduct());

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

        return $form;
    }
}
