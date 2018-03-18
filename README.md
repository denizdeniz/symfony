# Deniz Vatan Buyorük - PG Task

##Project Setup

## Setting up .evn

Change this line with your credentials:

``` DATABASE_URL=mysql://root:root@127.0.0.1:8889/pgtask ```


### Build Settings

```command
composer update
```

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

Logs:

``` hvar/log/transaction.log ```