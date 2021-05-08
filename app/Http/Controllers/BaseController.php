<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Web\Services\CartService;

class BaseController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(!empty($this->user)){
                View::share('user', $this->user );
            }
            return $next($request);
        });

    }
}
