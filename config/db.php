<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=pgsql;dbname=yii2',
    'username' => 'yii2',
    'password' => 'dev',
    'charset' => 'utf8',

//     Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
