<?php

namespace App\Http\Controllers\Profile;

use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * Handle a profile index request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {

        return view("profile.index");
    }
}
