<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'siek',
        'password'    => '',
        'dbname'      => 'Siek',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'vendorDir'      => __DIR__ . '/../../app/vendor/',
        'pluginsDir'     => __DIR__ . '/../../app/plugins/',
        'libraryDir'     => __DIR__ . '/../../app/library/',
        'cacheDir'       => __DIR__ . '/../../app/cache/',
        'baseUri'        => '/',
    ),
    'email' => array(
        'noreplyAddress' => 'noreply@siek.nl',
        'replyAddress' => 'noreply@siek.nl',
        'adminEmail' => ''
    ),
    'debug' => false
));
