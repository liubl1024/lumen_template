### Lumen 8 的模板

基于 lumen8 添加一些个人使用的模板,方便开发使用

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
