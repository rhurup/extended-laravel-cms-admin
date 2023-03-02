<?php

namespace App\Admin\Controllers;

use App\Admin\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(DashboardController::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    if(Auth::user()->allPermissions()){
                        $column->append(DashboardController::environment());
                    }
                });

                $row->column(4, function (Column $column) {
                    if(Auth::user()->allPermissions()) {
                        $column->append(DashboardController::extensions());
                    }
                });

                $row->column(4, function (Column $column) {
                    if(Auth::user()->allPermissions()) {
                        $column->append(DashboardController::dependencies());
                    }
                });
            });
    }
}
