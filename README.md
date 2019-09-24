# ffmpeg

#### 介绍
主要是为了视频切片并且在切片过程中截图

#### 软件架构
|-Model
   |-DB.php      DB类
   |-ffmpeg.php  FFMPEG类
|-newffmpeg.sh   在aria2视频上传之后会调用此shell
|-run.php        shell 会通过命令来调用 run.php


#### 安装教程
1. 安装 aria2  
 A.ubuntu  https://blog.csdn.net/qq_29117915/article/details/81986509  
 B.centos  https://blog.csdn.net/lichenzero/article/details/80141390
2. 安装 FFmpeg
 https://www.linuxidc.com/Linux/2019-03/157443.htm 
3.AriaNg 视频下载web 页面 
 A.通过域名解析的web页面
    1.ariang__web.zip 
    2.下载地址  http://php.wyscdz.com/2019/09/24/ariang-web%e6%a1%8c%e9%9d%a2%e4%b8%8b%e8%bd%bd%e5%8c%85/
 B.直接通过谷歌浏览器 安装 http://php.wyscdz.com/2019/08/02/%e9%85%8d%e7%bd%ae-aria2-%e6%9d%a5%e4%b8%8b%e8%bd%bd-%e8%a7%86%e9%a2%91/



#### 使用说明注意事项
1.首先php 需要开启 shell_exec函数
2.aria2 配置项 http://php.wyscdz.com/2019/08/02/aria2-conf-%e7%9a%84%e9%85%8d%e7%bd%ae-%e4%bb%a5%e5%8f%8a%e8%af%b4%e6%98%8e/ 




