<?php

namespace Ntq\Adapter\Controller;

use Illuminate\Routing\Controller;

/**
 * Controller Adapter.
 *
 * @package Ntq\Adapter\Controller
 */
class AbstractController extends Controller
{
    /**
     * Response the View to framework.
     *
     * @param string $view The view name
     * @param array  $data
     * @return \Illuminate\View\View
     */
    public function responseView($view, array $data = [])
    {
        return view($view, $data);
    }

    /**
     * Redirect the request.
     *
     * @param string $routeName
     * @param array $parameters
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($routeName, $parameters = [])
    {
        return redirect()->route($routeName, $parameters);
    }
}