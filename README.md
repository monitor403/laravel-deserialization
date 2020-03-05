# laravel-deserialization
基于laravel框架的反序列化链，因为所有链都是基于二次开发的时候触发，所以本地测试需要一个**demo**

```PHP
<?php
// App\Http\Controllers\DemoController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
public function demo()
{
if(isset($_GET['c'])){
$code = $_GET['c'];
unserialize($code);
}
else{
highlight_file(__FILE__);
}
return "Welcome to laravel";
}
}
```

然后在`Routes\web.php`中添加一条路由

```php
Route::get("/","\App\Http\Controllers\DemoController@demo");
```


