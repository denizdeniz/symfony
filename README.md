# Deniz Vatan Buyorük - PG Task

## Project Setup


```command
composer install
```

#### Setting up .evn

Change this line with your credentials:

``` DATABASE_URL=mysql://mysqluser:password@host:port/db_name ```


```command
php bin/console doctrine:database:create
```

```command
php bin/console doctrine:schema:update --force
```

```command
npm install
```

```command

bower install
```

```command

grunt
```

```command

php bin/console server:run
```

Logs are located at:

``` var/log/transaction.log ```
