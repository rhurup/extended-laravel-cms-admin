<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
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

        return view("members.subscription");
    }
}
