<?php

namespace Unity3_Vendor\App\Http\Middleware;

use Unity3_Vendor\Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;
class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = ['password', 'password_confirmation'];
}
