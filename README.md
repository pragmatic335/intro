Клонируем репозиторий

Подкладываем свой конфиг для соединения с базой (PSQL)   
~~~
config/db.php  

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=*;port=5432;dbname=*',
    'username' => 'postgres',
    'password' => '',
    'charset' => 'utf8',
];
~~~

Устанавливаем зависимости

~~~
composer update
~~~

Создаем таблицы, связи и тд.
~~~
yii migrate
~~~
