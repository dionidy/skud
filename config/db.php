<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'dsn' => 'pgsql:host=127.0.0.1;dbname=yii',
    'username' => 'postgres',
    'password' => '1',
    'charset' => 'utf8',
    'on afterOpen' => fn($event) => $event->sender->createCommand("set datestyle = 'German,DMY'")->execute(),

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
