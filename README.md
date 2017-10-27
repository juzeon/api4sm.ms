# SM.MS图床API For PHP

使用示例：

```php
require_once('api4sm.ms.class.php');//引用本类库
$a=new Api4SmMs();
$r=$a->upload('/path/to/file/a.png');//调用upload方法，传入文件路径
var_dump($r);//输出结果array，详见：https://sm.ms/doc/

```