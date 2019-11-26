<?php

namespace Engine;

use Illuminate\Container\Container as Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

/**
 * Class DataBase.
 *
 * @package Engine
 */
class DataBase
{
    /**
     * @var Capsule
     */
    public $capsule;

    /**
     * DataBase constructor.
     */
    public function __construct()
    {
        $this->capsule = new Capsule;
        $app           = new Container();

        $this->capsule->addConnection(
            [
                'driver'    => getenv('DB_TYPE', 'mysqli'),
                'host'      => getenv('DB_HOST', '127.0.0.1'),
                'database'  => getenv('DB_NAME'),
                'username'  => getenv('DB_USER'),
                'password'  => getenv('DB_PASS'),
                'charset'   => getenv('DB_CHARSET', 'utf8'),
                'collation' => getenv('DB_COLLATION', 'utf8_unicode_ci'),
                'prefix'    => getenv('DB_PREFIX', ''),
            ]
        );

        // Set the event dispatcher used by Eloquent models... (optional)

        $this->capsule->setEventDispatcher(new Dispatcher($app));

        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();
    }

    public function __destruct()
    {
        $this->capsule->getDatabaseManager()->disconnect();
    }
}

