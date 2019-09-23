<?php
class ffmpeg{
    public static $urlset='';
    public function __construct($url=NULL){
        self::$urlset = $url;
    }
    public function cliceAndGetImage(){
        $data=array();
        $url=self::$urlset;
        $dir=STOR_DIR.'/'.date('y').'/'.date('m').'/'.date('d').'/'.date('H_i_s');//视频存储路径
        mkdir($dir,0777,true);
        shell_exec('ffmpeg -i '.$url.' -c copy -strict -2 -bsf:v h264_mp4toannexb -f hls -hls_list_size 0 -hls_time 5 '.$dir.'/index.m3u8');
        shell_exec('ffmpeg -i '.$url.' -r 5 -q:v 2 -f image2 -vframes 10 '.$dir.'/image-%d.jpeg');
        $data['m3u8']=$dir.'/index.m3u8';
        $data['image_url']=$dir.'/images-1.jpeg';
        $data['mp4url']=$url;
        return $data;
    }
}
