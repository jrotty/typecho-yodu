<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?><?php $this->need('header.php'); ?> <?php $this->need('sidebar.php');?>

<article><div id="post" class="post" itemscope itemtype="http://schema.org/BlogPosting">
<h1 class="title" itemprop="name headline"><?php $this->title() ?></h1>

<div class="meta">
 <time itemprop="datePublished" content="<?php $this->date('Y-m-j  H:i'); ?>"><?php $this->date(); ?>
    </time><?php if($this->is('post')): ?><span>in </span> <?php $this->category(',', true, 'none'); ?><?php endif;?>
<span class="xuyin"><?php if (!empty($this->options->sidebarBlock) && in_array('bianjii', $this->options->sidebarBlock) && $this->is('post')): ?><span style="margin-left: 6px;font-size: 12px;color: #fff;background: pink;border-radius: 2px;padding: 0 3px;box-shadow: 0 0 8px pink;opacity: .8;display: inline-block;margin: 0 5px;" itemprop="author" itemscope itemtype="http://schema.org/Person"><?php switch ($this->author->group) {case 'administrator':_e('站长');break;case 'editor': _e('特约编辑');break; default: break;} ?><?php $this->author(); ?></span><?php endif;?>
  <?php if($this->user->hasLogin()):?><code class="notebook">
  <a href="<?php $this->options->adminUrl(); ?><?php if ($this->is('attachment')) : ?>media<?php else: ?>write-<?php if($this->is('post')): ?>post<?php else: ?>page<?php endif;?><?php endif;?>.php?cid=<?php echo $this->cid;?>" class="category-link"  target="_blank">编辑</a></code><?php else: ?><font color="red">文章转载请注明来源！</font>
<?php endif;?></span>
</div>

<div class="content" itemprop="articleBody">

<?php if (!empty($this->options->jrottytool) && in_array('postml', $this->options->jrottytool) || $this->fields->mulu): ?>
<div id="mulu"></div><?php endif;?>


<?php $this->content(); ?><span style="width: 100%;display:table;"></span>
<?php if($this->is('post')): ?><?php $this->options->ads(); ?><?php endif; ?>




<?php if (!empty($this->options->sidebarBlock) && in_array('qrcode', $this->options->sidebarBlock)): ?><?php else: ?>
<?php if($this->is('post')): ?>
<div style="text-align: center;margin-top: 10px;">  

    <div id="QR">  
        <div id="wechat" style="display: inline-block;    padding-right: 7px;">

 <?php 
echo '<img id="wechat_qr" src="'.theurl.'images/wx.png" alt="jrotty WeChat Pay" ><p>微信打赏</p></div><div id="alipay" style="display: inline-block;    padding-left: 7px;"><img id="alipay_qr" src="'.theurl.'images/tb.png" alt="jrotty Alipay">';

 ?>

        <p>支付宝打赏</p>
        </div>
    </div>


  <div id="ew">      
    <div id="erweima" style="display: inline-block">
<img id="erwei_qr" src="https://api.imjad.cn/qrcode?text=<?php $this->permalink() ?>&logo=https://api.imjad.cn/qrcode/logo.png&size=200&level=M&bgcolor=%23ffffff&fgcolor=%23000000" alt="文章二维码"/>
 <p>扫描二维码，在手机上阅读！</p>
 </div>
    </div>



  <a id="rewardButton" disable="enable" onclick="var qr = document.getElementById('QR'); var ds = document.getElementById('ew');if (qr.style.display === 'block'){qr.style.display='none';ds.style.display='block'}else{ds.style.display='none';qr.style.display='block'}" class="shangbutton" target="_blank">
   赏
    </a>

  </div>


<?php endif; ?>
<?php endif; ?>
</div>
 
<?php if($this->is('post')): ?><?php if (!empty($this->options->sidebarBlock) && in_array('banquan', $this->options->sidebarBlock)): ?>
<blockquote class="cc"><p>本文基于《<a target="_blank" rel="external nofollow" href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh">署名-非商业性使用-相同方式共享 4.0 国际 (CC BY-NC-SA 4.0)</a>》许可协议授权
<br>
文章链接：<?php $this->permalink() ?> (转载时请注明本文出处及文章链接)</p></blockquote><?php endif; ?>
<div class="post-left tagses" style="float: none;">
<?php if(  count($this->tags) == 0 ): ?>
<?php $this->category('', true, 'none'); ?>
<?php else: ?>
<?php $this->tags('', true, ' none'); ?><?php endif; ?> </div>

<?php endif;?>
<?php if (!empty($this->options->jrottytool) && in_array('yiyan', $this->options->jrottytool)): ?><div class="ad" id="hitokoto"></div><?php endif;?>
</div>
<nav class="page">
  <?php thePrev($this); ?>   <?php theNext($this); ?>

<div class="page-right fenxiang" id="fenxiang">
<a id="qq" class="btn--one two" target="_blank" href="http://connect.qq.com/widget/shareqq/index.html?url=<?php $this->permalink() ?>&title=<?php $this->title() ?>&pics=<?php showThumbnail($this); ?>" data-tooltip="分享至QQ好友"><i class="iconfont icon-qq"></i></a>
<a id="qqkj" class="btn--one two" target="_blank" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php $this->permalink() ?>&title=<?php $this->title() ?>&site=<?php $this->options->title(); ?>/&pics=<?php showThumbnail($this); ?>" data-tooltip="分享至QQ空间"><i class="iconfont icon-qqkj"></i></a>
<a id="sina" class="btn--one two" target="_blank" href="http://service.weibo.com/share/share.php?url=<?php $this->permalink() ?>/&appkey=<?php $this->options->title(); ?>/&title=<?php $this->title() ?>&pic=<?php showThumbnail($this); ?>" data-tooltip="分享至新浪微博"><i class="iconfont icon-weibo"></i></a>
<a id="google" class="btn--one two" target="_blank" href="https://plus.google.com/share?url=<?php $this->permalink() ?>" data-tooltip="分享至谷歌"><i class="iconfont icon-guge"></i></a>
</div>
 </nav>
<?php $this->need('comments.php');?>

</article>

<?php $this->need('footer.php');?>