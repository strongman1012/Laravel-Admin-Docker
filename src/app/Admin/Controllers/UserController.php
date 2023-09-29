<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Carbon;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '作業者マスタ';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', 'ID');
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('password', __('Password'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'))->display(function($created_at){
            return (new Carbon($created_at))->format('Y-m-d H:i');
        });
        $grid->column('updated_at', __('Updated at'))->display(function($updated_at){
            return (new Carbon($updated_at))->format('Y-m-d H:i');
        });

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', 'ID')->sortable();
        $show->field('name', __('Name'))->sortable();
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'))->sortable();
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'))->as(function($created_at){
            return (new Carbon($created_at))->format('Y-m-d H:i');
        })->sortable();
        $show->field('updated_at', __('Updated at'))->as(function($updated_at){
            return (new Carbon($updated_at))->format('Y-m-d H:i');
        })->sortable();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}
