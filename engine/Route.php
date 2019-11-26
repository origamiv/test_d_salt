<?php

namespace Engine;

/**
 * Class Route.
 *
 * @package Engine
 */
class Route
{
    /**
     * @param $path
     * @param $route
     * @return mixed
     */
    public function get($path, $route)
    {
        return $this->_check($path, $route);
    }

    /**
     * Reconciliation path route and path uri.
     *
     * @param $path
     * @param $route
     * @return mixed
     */
    private function _check($path, $route)
    {
        try {
            if($path === $this->uri('path') || $path . '/' === $this->uri('path')) {
                $route      = explode('@', $route);
                $controller = "App\\Controllers\\{$route[0]}";
                $classNew   = new $controller();
                $route      = $route[1];

                return $classNew->$route();
            }
        } catch(\Exception $e) {
            echo $e->getMessage();

            return false;
        }

        return false;
    }

    public function uri($param = null)
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $link = "https";
        else
            $link = "http";

        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        $link .= $_SERVER['REQUEST_URI'];
        $url  = parse_url($link);

        return $param && isset($url[$param]) ? $url[$param] : $url;
    }

    /**
     * @param $path
     * @param $route
     * @return mixed
     */
    public function post($path, $route)
    {
        return $this->_check($path, $route);
    }
}
