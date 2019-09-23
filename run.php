<?php
require_once ('/www/wwwroot/ffmpeg/Model/Db.php');
require_once ('/www/wwwroot/ffmpeg/Model/ffmpeg.php');
define('STOR_DIR','/www/wwwroot/ffmpeg');//视频存储文件夹
//$url=$argv['1'];//视频路径
$url='/www/wwwroot/ffmpeg/14.mp4';//视频路径
$ff=new ffmpeg($url);
$indexm3u8url=$ff->cliceAndGetImage();//切片并且获取图片
//数据库操作
$data['url']=$indexm3u8url['m3u8'];
$data['image']=$indexm3u8url['image_url'];
$data['path']=$indexm3u8url['mp4url'];
$data['create_time']=time();
$info=M('video')->add($data);

function M($table){
    $obj= new Model($table);
    return $obj;
}
