<?php

namespace Engine;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Models\Orders;
use Models\OrdersProduct;
use Models\Products;
use Models\Users;

/**
 * Class Route.
 *
 * @package Engine
 */
class Runner extends Controller
{
    /**
     * Function Migrate.
     */
    public function migrate()
    {
        $tables = [
            new Products(),
            new Users(),
            new Orders(),
            new OrdersProduct(),
        ];

        foreach($tables as $table) {
            $this->_createColumn($table->getTable(), $table->getFields());
        }

        echo "\e[0;31;42mDB Schemes updated! \033[0m\n";
    }

    private function _createColumn($table, $fields)
    {
        if(!Capsule::schema()->hasTable($table)) {
            Capsule::schema()->create(
                $table,
                function(Blueprint $table) {
                    $table->bigIncrements('id');
                }
            );
        }

        foreach($fields as $nameColumn => $field) {
            if(!Capsule::schema()->hasColumn($table, $nameColumn)) {
                Capsule::schema()->table(
                    $table,
                    function(Blueprint $table) use ($field, $nameColumn) {
                    if($field['type'] == 'int') {
                        $table->integer($nameColumn);
                    }

                    if($field['type'] == 'varchar') {
                        $table->string($nameColumn, $field['length']);
                    }

                    if($field['type'] == 'float') {
                        $table->float($nameColumn, $field['length'], 2);
                    }

                    if($field['type'] == 'text') {
                        $table->text($nameColumn)->default(Capsule::connection()->raw('CURRENT_TIMESTAMP'));
                    }

                    if($field['type'] == 'datetime') {
                        $table->timestamp($nameColumn)->default(Capsule::connection()->raw('CURRENT_TIMESTAMP'));
                    }
                }
                );
            }
        }
    }
}