<?php

namespace Unity3_Vendor\App\Http\Middleware;

use Unity3_Vendor\Illuminate\Http\Request;
use Unity3_Vendor\Fideloper\Proxy\TrustProxies as Middleware;
class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies;
    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
