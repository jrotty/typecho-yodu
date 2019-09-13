<?php 
/**
 * links
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
	$this->need('header.php');
 ?>



<?php $this->need('sidebar.php'); ?>



        <div class="col-sm-9 blog-main mts">
 <h4 class="class="blog-post-title""><?php $this->title(); ?></h4>

<div class="blog-post content">


  <?php

$str = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#',
        '<a$1 href="$2$3"$5 target="_blank">', $this->content);



$str = preg_replace('#<li><img src="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)><a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>(.*?)</a></li>#','<a href="$6$7" target="_blank" >
        <div class="jrotty-links">
            <img class="b-lazy"
src="$1$2"$4>
            <p>$10</p>
        </div>
    </a>',$str);
$str = preg_replace('#<li>([1-9][0-9]{4,})<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>(.*?)</a></li>#','<a href="$3$4" target="_blank">
        <div class="jrotty-links"><img class="b-lazy"
src="//q.qlogo.cn/g?b=qq&nk=$1&s=100">
            <p>$7</p>
        </div>
    </a>',$str);

$str = preg_replace_callback('#<li>((.*?)@(.*?)\.(.*?))<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>(.*?)</a></li>#',forReplace,$str);

function forReplace($m){
$url = Typecho_Widget::widget('Widget_Options')->gravatars;
$host = 'https://'.$url.'/';
return '<a href="'.$m[6].$m[7].'" target="_blank">
        <div class="jrotty-links"><img class="b-lazy"
src="'.$host.md5($m[1]).'?d=">
            <p>'.$m[10].'</p>
        </div>
    </a>';
}

$str = preg_replace('#<li><a href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>(.*?)</a></li>#','<a href="$1$2" target="_blank">
        <div class="jrotty-links">  
            <p>$5</p>
        </div>
    </a>',$str);
 echo $str;
?>


<?php $this->need('comments.php'); ?>
    </div>








        </div><!-- /.blog-main -->






<?php $this->need('footer.php'); ?>
