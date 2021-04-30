### Lumen 8 的模板

基于 lumen8 添加一些个人使用的模板,方便开发使用

主要包括: 
- laravel-ide-helper
- sql query 监听
- 日志毫秒记录
- api 统一响应
- 结合 Swoole  


### laravel-ide-helper

```bash
composer require barryvdh/laravel-ide-helper
```
###### 修改 bootstrap/app.php
```php
if(env('APP_ENV')=='local'){
    $app->register(Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
}
```
```bash
composer require --dev league/flysystem ^1.0

php artisan ide-helper:generate - 为 Facades 生成注释
php artisan ide-helper:models - 为数据模型生成注释
php artisan ide-helper:meta - 生成 PhpStorm Meta file

```

### SQL Query Listenr 监听 SQL 便于开发

配置 logging.channels.sql 
sql 直接输出到 对应配置文件 如下
```
[2021-04-30 07:14:21] local.DEBUG: select count(*) as aggregate from `user`; RunTime: 6.53 ms
```
