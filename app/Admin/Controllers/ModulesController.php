<?php

namespace App\Admin\Controllers;

use App\Models\Content\Articles;
use App\Models\Content\Modules;
use App\Services\ContentService;
use Carbon\Carbon;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ModulesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Content modules';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Modules());
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('ID'))->sortable();

        $grid->status()->display(function($status) {
            return ContentService::getStatuses()[$status];
        })->sortable();

        $grid->column('title', __('Title'));
        $grid->column('position', __('Position'));
        $grid->column('layout', __('Layout'));

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
            $filter->in('position')->multipleSelect(ContentService::getPositions());

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
        $show = new Show(Modules::findOrFail($id));

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
        $form = new Form(new Modules());

        $pages = ContentService::getPages();

        $form->column(2/3, function ($form) {

            // Add a form item to this column
            $form->hidden('id', __('ID'));
            $form->hidden('created_by', __('Created By'))->default(Auth::user()->id);
            $form->hidden('updated_by', __('Updated By'))->default(Auth::user()->id);

            $form->text('title', __('Title'));

            $form->ckeditor('content');
        });
        // The second column occupies 1/2 of the page width to the right
        $form->column(1/3, function ($form) use ($pages){
            $form->select("status")->options(ContentService::getStatuses());
            $form->image("img");

            $form->select("position")->options(ContentService::getPositions())->default("top");
            $form->select("layout")->options(ContentService::getModulesLayouts())->default("raw");
            $form->multipleSelect("pages")->options($pages)->default("*");

            $form->select("sm_col")->options(ContentService::getBootstrapGrid())->default(ContentService::DEFAULT_COLS);
            $form->select("md_col")->options(ContentService::getBootstrapGrid())->default(ContentService::DEFAULT_COLS);
            $form->select("xl_col")->options(ContentService::getBootstrapGrid())->default(ContentService::DEFAULT_COLS);
        });

        $form->tools(function (Form\Tools $tools) {
            // Disable `List` btn.
            $tools->disableList();
            // Disable `View` btn.
            $tools->disableView();
        });

        return $form;
    }
}
