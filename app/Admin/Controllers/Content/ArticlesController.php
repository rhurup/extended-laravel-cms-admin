<?php

namespace App\Admin\Controllers\Content;

use App\Models\Content\ContentArticles;
use App\Services\ContentService;
use Carbon\Carbon;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Content';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ContentArticles());

        $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('ID'))->sortable();

        $states = [
            'on' => ['value' => 1, 'text' => 'Active', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'Inactive', 'color' => 'default'],
        ];
        $grid->column('status', __('Status'))->switch($states);

        $grid->column('title', __('Title'))->editable();

        $grid->updated_by()->display(function($userId) {
            return Administrator::find($userId)->name;
        });
        $grid->updated_at()->display(function($datetime) {
            return Carbon::parse($datetime)->format("d-m-Y");
        });
        $grid->created_by()->display(function($userId) {
            return Administrator::find($userId)->name;
        });
        $grid->created_at()->display(function($datetime) {
            return Carbon::parse($datetime)->format("d-m-Y");
        });

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('title', 'title');
            $filter->in('status')->multipleSelect(ContentService::getStatuses());

        });
        $grid->actions(function ($actions) {

            $actions->disableView();
            // append an action.
            $actions->append('<a href=""><i class="fa fa-eye"></i>ssss</a>');

            // prepend an action.
            $actions->prepend('<a href=""><i class="fa fa-paper-plane"></i>ssss</a>');
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
        $show = new Show(ContentArticles::findOrFail($id));

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
    protected function form($id = 0)
    {
        $status = ContentArticles::find($id)->status ?? 0;

        $form = new Form(new ContentArticles());

        $form->column(2/3, function ($form) use ($status) {

            // Add a form item to this column
            $form->hidden('id', __('ID'));
            $form->hidden('created_by', __('Created By'))->default(Auth::user()->id);
            $form->hidden('updated_by', __('Updated By'))->default(Auth::user()->id);
            $form->text('title', __('Title'));

            if ($status == ContentService::getLockedStatus()) {
                $form->text('slug', __('Url'))->disable();
            }else{
                $form->text('slug', __('Url'));
            }

            $form->ckeditor('content');
        });
        // The second column occupies 1/2 of the page width to the right
        $form->column(1/3, function ($form) use ($status){
            if ($status == ContentService::getLockedStatus()) {
                $form->select("status")->options(ContentService::getStatuses())->disable();
            }else{
                $form->select("status")->options(ContentService::getStatuses());
            }

            $form->image('image');

            $form->datetimeRange('created_at', 'updated_at');
        });

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
