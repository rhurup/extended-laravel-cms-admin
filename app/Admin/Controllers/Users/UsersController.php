<?php

namespace App\Admin\Controllers\Users;

use App\Models\Content\Articles;
use App\Models\Users\Users;
use App\Services\ContentService;
use Carbon\Carbon;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class UsersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Users';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Users());

        $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('ID'))->sortable();

        $grid->column('email', __('Email'));

        $grid->updated_at()->display(function($datetime) {
            return Carbon::parse($datetime)->format("d-m-Y");
        });
        $grid->created_at()->display(function($datetime) {
            return Carbon::parse($datetime)->format("d-m-Y");
        });

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('email', 'Email');

        });
        $grid->actions(function ($actions) {
            $actions->disableView();
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Users::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Users());

        // Add a form item to this column
        $form->hidden('id', __('ID'));
        $form->hidden('created_by', __('Created By'))->default(Auth::user()->id);
        $form->hidden('updated_by', __('Updated By'))->default(Auth::user()->id);
        $form->text('email', __('Email'));
        $form->password('password', __('Password'));

        $form->tools(function (Form\Tools $tools) {
            // Disable `List` btn.
            $tools->disableList();

            // Disable `Delete` btn.
            $tools->disableDelete();
            // Disable `View` btn.
            $tools->disableView();
        });


        return $form;
    }
}
