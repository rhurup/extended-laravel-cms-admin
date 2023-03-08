<?php

namespace App\Admin\Controllers;

use App\Models\Content\Articles;
use App\Models\Countries\Countries;
use App\Models\Users\Users;
use App\Services\ContentService;
use Carbon\Carbon;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class CountriesController extends AdminController
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
        $grid = new Grid(new Countries());

        $grid->quickSearch('country');

        $grid->column('id', __('ID'))->sortable();

        $grid->column('country', __('extended.country'))->sortable();
        $grid->column('code', __('extended.country_code'));
        $grid->column('active', __('extended.active'))->sortable();
        $grid->column('phone_code', __('extended.phone_code'));
        $grid->column('currency_code', __('extended.currency_code'));
        $grid->column('currency_name', __('extended.currency_name'));
        $grid->column('currency_symbol', __('extended.currency_symbol'));
        $grid->column('currency_align', __('extended.currency_align'));

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('country', 'country');

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
        $show = new Show(Countries::findOrFail($id));

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
        $form = new Form(new Countries());

        $form->column(2/3, function ($form) {

            // Add a form item to this column
            $form->hidden('id', __('ID'));
            $form->hidden('created_by', __('Created By'))->default(Auth::user()->id);
            $form->hidden('updated_by', __('Updated By'))->default(Auth::user()->id);
            $form->text('country', __('extended.country'));
            $form->switch('active', __('extended.active'));
            $form->text('code', __('extended.country_code'));
            $form->text('phone_code', __('extended.phone_code'));
            $form->text('currency_name', __('extended.currency_name'));
            $form->text('currency_code', __('extended.currency_code'));
            $form->text('currency_symbol', __('extended.currency_symbol'));

            $states = [
                'on' => ['value' => 'LEFT', 'text' => 'LEFT', 'color' => 'primary'],
                'off' => ['value' => 'RIGHT', 'text' => 'RIGHT', 'color' => 'default'],
            ];
            $form->switch('currency_align', __('extended.currency_align'))->states($states);

        });
        // The second column occupies 1/2 of the page width to the right
        $form->column(1/3, function ($form){
            $form->text('dec_point', __('extended.dec_point'));
            $form->text('thousands_sep', __('extended.thousands_sep'));
            $form->text('iso_code', __('extended.iso_code'));
            $form->text('iso_639_1', __('extended.iso_639_1'));
            $form->text('iso_639_2t', __('extended.iso_639_2t'));
            $form->text('iso_639_2b', __('extended.iso_639_2b'));
            $form->text('iso_639_3', __('extended.iso_639_3'));
            $form->text('iso_639_6', __('extended.iso_639_6'));
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
