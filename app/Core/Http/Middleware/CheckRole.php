<?php

namespace BlogApi\Core\Http\Middleware;

use Closure;
use Exception;

class CheckRole
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     * @throws Exception
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() == null) {
            throw new Exception('Insufficient permisions', 401);
        }

        $actions = $request->route()->getAction();
        $roles   = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || !$roles){
            return $next($request);
        }

        return response('Insufficient permissions', 401);
    }
}
