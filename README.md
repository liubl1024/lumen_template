### Lumen 8 的模板

基于 lumen8 添加一些个人使用的模板,方便开发使用

主要包括: 
- laravel-ide-helper
- sql query 监听
- 日志毫秒记录
- api 统一响应
- 结合 Swoole 包 加速 Lumen


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

### 打印毫秒时间
项目较大情况下 默认日志打印的时间粒度不够，为了更精细追踪日志，查看使用情况，可使用毫秒时间戳
使用方法 引入 UDDateFormatter.php 文件后 在 logging.php 中添加对应 `formatter` `formatter_with` 即可
```
'formatter'=> \App\Support\UDDateFormatter::class,
'date_formatter' => 'Y-m-d H:i:s.u', // 自定义配置 格式化 毫秒级时间戳
```
日志时间格式会直接带毫秒
```bash
[2021-05-01 01:24:01.203839] local.DEBUG: record
```

结合 Swoole 包 加速 Lumen
```bash
composer require  swooletw/laravel-swoole

cp ../vendor/swooletw/laravel-swoole/config/swoole_*  config/
```

`SWOOLE_HTTP_WORKER_NUM` 根据系统内存设置 一般 一个 worker 需要 30M 左右内存
