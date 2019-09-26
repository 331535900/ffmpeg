<?php
require_once ('/www/wwwroot/node_project/Model/Db.php');
require_once ('/www/wwwroot/node_project/Model/ffmpeg.php');
define('STOR_DIR','/www/wwwroot/node_project');//视频存储文件夹
//$url=$argv['1'];//视频路径
$url='/usr/local/caddy/www/aria2/Download/919加勒比 辦公室淫亂群交盛宴極品OL女神波多野結衣.mp4';//视频路径
//$url='/www/wwwroot/node_project/avi.avi';//视频路径
//file_put_contents('/www/wwwroot/node_project/666.txt',$url);
$ff=new ffmpeg($url);
$indexm3u8url=$ff->cliceAndGetImage();//切片并且获取图片
//数据库操作
$data['url']=$indexm3u8url['m3u8'];
$data['image']=$indexm3u8url['image_url'];
$data['path']=$indexm3u8url['mp4url'];
$data['create_time']=time();

$array=explode('/', $indexm3u8url['mp4url']);
$arrayname=explode('.',array_pop($array));
$name=$arrayname['0'];

$data['name']=$name;
$data['status']=1;
$info=M('video_ffmpeg')->add($data);
function M($table){
    $obj= new Model($table);
    return $obj;
}
