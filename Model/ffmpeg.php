<?php
class ffmpeg{
    public static $urlset='';
    public function __construct($url=NULL){
        self::$urlset = $url;
    }
    //切片并且截图
    public function cliceAndGetImage(){
        $data=array();
        $url=self::$urlset;
        $dir=STOR_DIR.'/'.date('y').'/'.date('m').'/'.date('d').'/'.date('H_i_s');//视频存储路径
        mkdir($dir,0777,true);
        //去除文件名的空格
        $newurl=preg_replace('# #','',$url);
        rename($url,$newurl);
        $url=$newurl;
        //echo 'ffmpeg -i '.$url.' -c copy -strict -2 -bsf:v h264_mp4toannexb -f hls -hls_list_size 0 -hls_time 5 '.$dir.'/index.m3u8'; exit();
        //shell_exec('ffmpeg -i '.$url.' -c copy -strict -2 -bsf:v h264_mp4toannexb -f hls -hls_list_size 0 -hls_time 5 '.$dir.'/index.m3u8');
        //shell_exec('ffmpeg -i '.$url.' -r 5 -q:v 2 -f image2 -vframes 10 '.$dir.'/image-%d.jpeg');
        $url_name =substr($url,0, strrpos($url,'.'));//文件地址和明文件的名字链接
        $last_name=substr($url,strrpos($url,'.')+1);//后缀名字
      
              
        //如果不是mp4格式
        if($last_name!='mp4'){
            shell_exec('ffmpeg -i '.$url.' -y -c:v libx264 -strict -2 '.$url_name.'.mp4');//如果视频不为mp4格式，需先将视频转码为mp4，可使用如下命令进行转换111
            //shell_exec('ffmpeg -y -i '.$url_name.'.mp4 -vcodec copy -acodec copy -vbsf h264_mp4toannexb '.$dir.'/index.ts');//将mp4格式转换为ts格式
            //shell_exec('ffmpeg -i '.$dir.'/index.ts -c copy -map 0 -f segment -segment_list '.$dir.'/index.m3u8 -segment_time 20 '.$dir.'/tslist-%03d.ts');//将ts文件进行切片
            //shell_exec('ffmpeg -i '.$url_name.'.mp4 -r 5 -q:v 2 -f image2 -vframes 10 '.$dir.'/image-%d.jpeg');
            $url=$url_name.'.mp4';
        }
      
            shell_exec('ffmpeg -i '.$url.' -c copy -strict -2 -bsf:v h264_mp4toannexb -f hls -hls_list_size 0 -hls_time 5 '.$dir.'/index.m3u8');
            shell_exec('ffmpeg -i '.$url.' -r 5 -q:v 2 -f image2 -vframes 10 '.$dir.'/image-%d.jpeg'); 
   
        $data['m3u8']=$dir.'/index.m3u8';
        $data['image_url']=$dir.'/image-2.jpeg';
        $data['mp4url']=$url;
        return $data;
    }
}
