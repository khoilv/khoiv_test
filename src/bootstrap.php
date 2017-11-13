<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'coccoc',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

// Using The Schema Builder to create "count_hits" table
if (!Capsule::schema()->hasTable('hits_count')) {
    Capsule::schema()->create('hits_count', function ($table) {
        $table->increments('id');
        $table->string('ip', 45);
        $table->string('domain', 255);
        $table->integer('count');
        $table->timestamps();

        // create a composite index
        $table->index(['domain', 'ip']);
    });
}