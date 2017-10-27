# SM.MS图床API For PHP

安装方法：

```bash
git clone https://github.com/juzeon/api4sm.ms.git
```

使用示例：

```php
require_once('api4sm.ms.class.php');//引用本类库
$a=new Api4SmMs();
$r=$a->upload('/path/to/file/a.png');//调用upload方法，传入文件路径
$r=$a->upload('https://ss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/img/logo/bd_logo1_31bdc765.png');//也可以是网络地址
var_dump($r);//输出结果array，详见：https://sm.ms/doc/

```