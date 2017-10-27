<?php
/*
 * SM.MS图床API For PHP
 * 作者：居正（ https://github.com/juzeon ）
 * 
 * 例子：
require_once('api4sm.ms.class.php');//引用本类库
$a=new Api4SmMs();
$r=$a->upload('/path/to/file/a.png');//调用upload方法，传入文件路径
var_dump($r);//输出结果array，详见：https://sm.ms/doc/
 * 
 */
class Api4SmMs {
	public function upload($filepath) {
		$name = basename($filepath);
		$type = mime_content_type($filepath);
		$bits = file_get_contents($filepath);
		$target_url = "https://sm.ms/api/upload";

		$data = array();
		$mimeBoundary = uniqid();
		array_push($data, "--" . $mimeBoundary);
		$mimeType = empty($type) ? 'application/octet-stream' : $type;
		array_push($data, "Content-Disposition: form-data; name=\"smfile\"; filename=\"$name\"");
		array_push($data, "Content-Type: $mimeType");
		array_push($data, '');
		array_push($data, $bits);
		array_push($data, '');
		array_push($data, "--" . $mimeBoundary . "--");

		$post_data = implode("\r\n", $data);
		$length = strlen($post_data);
		$headers = array();
		array_push($headers, "Content-Type: multipart/form-data; boundary=$mimeBoundary");
		array_push($headers, "Content-Length: {$length}");
		array_push($headers, "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0");

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $target_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$result = curl_exec($ch);
		return json_decode($result);
	}

}
