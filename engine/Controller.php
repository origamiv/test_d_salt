<?php

namespace Engine;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class Controller
 * @package Engine
 */
class Controller extends DataBase
{
    /**
     * Request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->request = Request::createFromGlobals();
    }

    /**
     * Function views.
     *
     * @param null  $view
     * @param array $data
     */
    public function render($view = null, $data = [])
    {
        $view_path = APP_PATH . '/Http/Views/' . $view . '.php';

        if(file_exists($view_path)) {
            extract($data);

            require_once $view_path;
        } else {
            echo 'Not found' . $view;
        }
    }

    public function redirect($url = '/')
    {
        header("Location: {$url}");
    }

    public function json($body = '')
    {
        header('Content-Type: application/json');
        echo json_encode($body);
        exit;
    }
}
