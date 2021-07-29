<?php

namespace Unity3_Vendor\App\Http\Controllers;

use Unity3_Vendor\Illuminate\Foundation\Bus\DispatchesJobs;
use Unity3_Vendor\Illuminate\Routing\Controller as BaseController;
use Unity3_Vendor\Illuminate\Foundation\Validation\ValidatesRequests;
use Unity3_Vendor\Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
