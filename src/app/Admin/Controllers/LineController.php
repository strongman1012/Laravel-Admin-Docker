<?php

namespace App\Admin\Controllers;

use App\Models\Line;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Carbon;

class LineController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ラインマスタ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Line());

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', __('Name'))->sortable();
        $grid->column('memo', __('Memo'));
        $grid->column('deleted_at', __('Deleted at'))->sortable();
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
        $show = new Show(Line::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', __('Name'));
        $show->field('memo', __('Memo'));
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
        $form = new Form(new Line());

        $form->text('name', __('Name'));
        $form->textarea('memo', __('Memo'));

        return $form;
    }
}
