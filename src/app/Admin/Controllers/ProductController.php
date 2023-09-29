<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Carbon;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '製品マスタ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', 'ID')->sortable();
        $grid->column('name1', __('Name1'))->sortable();
        $grid->column('name2', __('Name2'))->sortable();
        $grid->column('memo', __('Memo'));
        $grid->column('goal', __('goal'))->sortable();
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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name1', __('Name1'));
        $show->field('name2', __('Name2'));
        $show->field('memo', __('Memo'));
        $show->field('goal', __('goal'));
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
        $form = new Form(new Product());

        $form->text('name1', __('Name1'));
        $form->text('name2', __('Name2'));
        $form->textarea('memo', __('Memo'));
        $form->number('goal', __('goal'));

        return $form;
    }
}
