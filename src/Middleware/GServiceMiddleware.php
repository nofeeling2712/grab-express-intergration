<?php

namespace GExpress\GService\Middleware;

use App\Helper\ResponseHelper;
use Ixudra\Curl\CurlService as BaseCurlService;

class GServiceMiddleware
{
    /**
     * @var BaseCurlService
     */
    protected $curl;

    /**
     * @var array
     */
    protected $except = [
        '/api/gservice/accesstoken'
    ];

    /**
     * Create a new BaseMiddleware instance.
     *
     * BaseMiddleware constructor.
     * @param BaseCurlService $curl
     */
    public function __construct(BaseCurlService $curl)
    {
        $this->curl = $curl;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (in_array($request->getRequestUri(), $this->except)) {
            return $next($request);
        }
        if (!session('access_token') &&
            (!$request->header('Authorization') || explode(' ', $request->header('Authorization'))[0] != 'Bearer')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
