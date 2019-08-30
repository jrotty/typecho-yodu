<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer id="footer" class="footer">
 <?php if ($this->options->starttime){ ?><span>博客已运行</span><span id=span_dt_dt></span><?php };?>
<br>© <?php echo date('Y'); ?>&nbsp;由&nbsp;<a target="_blank" href="http://typecho.org" rel="external nofollow">Typecho</a> 强力驱动.Theme by <a target="_blank" id="cpy" href="http://qqdie.com/archives/yodu.html" rel="external nofollow">YoDu</a> <?php if ($this->options->footerwen): ?><?php $this->options->footerwen(); ?><?php endif; ?>
</footer>
</div>
<?php if (!empty($this->options->sidebarBlock) && !in_array('guantool', $this->options->sidebarBlock)): ?><?php if($this->is('post')||$this->is('page')&&!$this->is('page', 'archives')&&!$this->is('page', 'categories')&&!$this->is('page', 'tags')): ?>
<div id="bottom-bar" class="bottom-post-bar" >
<?php thePrev($this); ?>   <?php theNext($this); ?>
<div class="page-right fenxiang bar-two" id="fenxiang">
<a id="google" class="btn--one two" href="#comments" data-no-instant><i class="iconfont icon-comment"></i></a>
<a id="qqkj" class="btn--one two" target="_blank" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php $this->permalink() ?>&title=<?php $this->title() ?>&site=<?php $this->options->title(); ?>/&pics=<?php showThumbnail($this); ?>" data-tooltip="分享至QQ空间"><i class="iconfont icon-qqkj"></i></a>
<a id="sina" class="btn--one two" target="_blank" href="http://service.weibo.com/share/share.php?url=<?php $this->permalink() ?>/&appkey=<?php $this->options->title(); ?>/&title=<?php $this->title() ?>&pic=<?php showThumbnail($this); ?>" data-tooltip="分享至新浪微博"><i class="iconfont icon-weibo"></i></a>
<a id="qq" class="btn--one two" target="_blank" href="https://plus.google.com/share?url=<?php $this->permalink() ?>" data-tooltip="分享至谷歌"><i class="iconfont icon-guge"></i></a>
</div>
 </div> 
<?php endif; ?><?php endif; ?> 
</div></div>

  <?php 
if (!empty($this->options->sidebarBlock) && in_array('topb', $this->options->sidebarBlock)){echo ' <div id="leimu"><img src="'.theurl.'images/a.png" alt="雷姆" onmouseover="this.src=\''.theurl.'images/b.png\'" onmouseout="this.src=\''.theurl.'images/a.png\'" id="audioBtn">
</div><div id="lamu"><img src="'.theurl.'images/c.png" alt="拉姆" onmouseover="this.src=\''.theurl.'images/d.png\'" onmouseout="this.src=\''.theurl.'images/c.png\'" id="audioBtn">
</div>';
}

echo '<script src="'.theurl.'js/jquery-3.2.1.min.js" data-instant-track></script>
<script src="'.theurl.'js/jquery.fancybox.min.js?ver=3.2.5" data-instant-track></script><script>var yoduml="'.THEME_URL.'";</script><script src="'.theurl.'load.js?v='.Yodu_Version.'"></script>';

if (!empty($this->options->jrottytool) && in_array('highlight', $this->options->jrottytool)){echo '<script src="'.theurl.'js/prism.js?v='.Yodu_Version.'"></script>';}

if (!empty($this->options->jrottytool) && in_array('yiyan', $this->options->jrottytool)){echo '<script src="'.theurl.'js/yiyan.js?v='.Yodu_Version.'"></script>';}

$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(!strpos($agent, 'iphone') && !strpos($agent, 'ipad') && !strpos($agent, 'mac') && !empty($this->options->jrottytool) && in_array('smjs', $this->options->jrottytool)){echo '<script src="'.theurl.'js/sm.js?v='.Yodu_Version.'"  data-instant-track></script>';}

if (!empty($this->options->jrottytool) && in_array('latex', $this->options->jrottytool)){
?><script type="text/x-mathjax-config">
MathJax.Hub.Config({
    showProcessingMessages: false,
    messageStyle: "none",
    extensions: ["tex2jax.js"],
    jax: ["input/TeX", "output/HTML-CSS"],
    tex2jax: {
        inlineMath:  [ ["$", "$"] ],
        displayMath: [ ["$$","$$"] ],
        skipTags: ['script', 'noscript', 'style', 'textarea', 'pre','code','a'],
        ignoreClass:"comment-content"
    },
    "HTML-CSS": {
        availableFonts: ["STIX","TeX"],
        showMathMenu: false
    }
});
</script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script><?php
}

if ($this->options->pinglun == '4'){
echo '<script src="'.theurl.'ajax.js?v='.Yodu_Version.'"></script>';}

if ($this->options->InstantClick != '4'){
echo '<script src="'.theurl.'js/instantclick.min.js?v=3.1.0" data-instant-track></script>';
}
 ?>

<script data-no-instant>
 <?php if ($this->options->starttime){ ?>
function show_date_time(){window.setTimeout("show_date_time()",1e3);var BirthDay=new Date("<?php $this->options->starttime();?>"),today=new Date,timeold=today.getTime()-BirthDay.getTime(),msPerDay=864e5,e_daysold=timeold/msPerDay,daysold=Math.floor(e_daysold),e_hrsold=24*(e_daysold-daysold),hrsold=Math.floor(e_hrsold),e_minsold=60*(e_hrsold-hrsold),minsold=Math.floor(60*(e_hrsold-hrsold)),seconds=Math.floor(60*(e_minsold-minsold));span_dt_dt.innerHTML=daysold+"天"+hrsold+"小时"+minsold+"分"+seconds+"秒";}
show_date_time();<?php };?>
</script><?php if ($this->options->InstantClick == '4'): ?><?php else: ?>
<script data-no-instant>
InstantClick.on('change', function(isInitialLoad) {
 if (isInitialLoad === false) {
<?php $all = Typecho_Plugin::export();?><?php if (array_key_exists('Meting', $all['activated'])) : ?>loadMeting();<?php endif; ?>
    if (typeof MathJax !== 'undefined'){ MathJax.Hub.Queue(["Typeset",MathJax.Hub]);}
    if (typeof prettyPrint !== 'undefined'){prettyPrint();}
    if (typeof _hmt !== 'undefined'){_hmt.push(['_trackPageview', location.pathname + location.search]);}  
    if (typeof ga !== 'undefined'){ga('send', 'pageview', location.pathname + location.search);}  
  }
});
<?php if ($this->options->InstantClick == '2'): ?>InstantClick.init(100);<?php else: ?>
<?php if ($this->options->InstantClick == '3'): ?>InstantClick.init();<?php else: ?>
InstantClick.init('mousedown');<?php endif; ?><?php endif; ?>
</script><?php endif; ?>
<div id="cover"></div>
<?php $this->footer(); ?>
</body>
</html>
<?php if (!empty($this->options->jrottytool) && in_array('compress', $this->options->jrottytool)): ?><?php $html_source = ob_get_contents(); ob_clean(); print compress_html($html_source); ob_end_flush(); ?><?php endif;?>