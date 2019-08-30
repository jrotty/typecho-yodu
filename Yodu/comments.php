<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?><?php if ($this->is('attachment')) : ?>  <h4 class="comment-close">附件页面禁止评论</h4>
<?php else: ?>
<?php if ($this->options->pinglun == '1'||$this->options->pinglun == '4'): ?>
<?php
$GLOBALS['z']  = $this->options->CDNURL;
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';$idcard="<span class=\"idcard\">本文作者</span>";
        } else {
            $commentClass .= ' comment-by-user';$idcard="<span class=\"idcard\">其他编辑</span>";
        }
    }else{$idcard="";
}
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    if ($comments->url) {
        $author = '<a class="p-name" href="' . $comments->url . '" target="_blank" rel="external nofollow">' . $comments->author . '</a>';
    } else {
                $author = '<span class="p-name">' . $comments->author . '</span>';
    }
?>

<li data-no-instant id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>" class="comment-id">
        <?php
$url = Typecho_Widget::widget('Widget_Options')->gravatars;
$host = 'https://'.$url.'/';
            $rating = Helper::options()->commentsAvatarRating;
            $hash = md5(strtolower($comments->mail));
            $email = strtolower($comments->mail);
            $color = '#'.substr($hash,1,6);
           $sjtx = '';
$qq=str_replace('@qq.com','',$email);
if(strstr($email,"qq.com") && is_numeric($qq) && strlen($qq) < 11 && strlen($qq) > 4)
{


$avatar = '//q.qlogo.cn/g?b=qq&nk='.$qq.'&s=100';

 
}else{
 

 $avatar = $host . $hash . '?d='.$sjtx;
}

        ?>
   
        <div class="comment-main">
 <a href="<?php $comments->url(); ?>" target="_blank" rel="external nofollow">   
        <img class="avatar"
	 src="<?php echo $avatar ?>" alt="<?php echo $comments->author; ?>"/></a>
<div id="comment-m"><div class="comment-author">
<?php echo $author; ?><?php echo $idcard;?>
<div class="comment-meta">
  <time class="comment-time"><?php echo timesince($comments->created);?></time> <span class="comment-reply"><?php $comments->reply(); ?></span>
</div></div>


   <p>   <?php get_comment_at($comments->coid); ?>  <?php 
$cos = preg_replace('#</?[p|P][^>]*>#','',$comments->content);
$cos = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#',
        '<a$1 href="$2$3"$5 target="_blank" rel="nofollow">', $cos);
echo $cos;
 ?></p><div class="comment-arrow"></div>  </div>
          
        </div>
    </div>
 
    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
    
</li>
<?php } ?>

<div id="comments">
    <?php $this->comments()->to($comments); ?>



    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond"  data-no-instant>
        <div class="cancel-comment-reply"><span class="response"><?php _e('发表新评论'); ?></span>
 <?php if($this->user->hasLogin()): ?>
            <span><?php _e('已登入: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></span>
              <?php endif ; ?>


<span class="cancel-reply"><?php $comments->cancelReply(); ?></span></div>
<div class="visitor"> <?php if($this->user->hasLogin()): ?>
				<img src="<?php $url = Typecho_Widget::widget('Widget_Options')->gravatars;echo 'https://'.$url.'/'.md5(strtolower($this->author->mail)); ?>?s=100" class="avatar">	   <?php else: ?> <?php if($this->remember('author',true) != "" && $this->remember('mail',true) != "") : ?>
 <img src="<?php $url = Typecho_Widget::widget('Widget_Options')->gravatars; $rmail=$this->remember('mail',true); echo 'https://'.$url.'/'.md5($rmail); ?>?s=100" class="avatar">
<?php else: ?>
	   <img src="<?php echo theurl; ?>images/hj.png" class="avatar"><?php endif; ?>	<?php endif; ?>	
			</div>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if(!$this->user->hasLogin()): ?>
                <?php if($this->remember('author',true) != "" && $this->remember('mail',true) != "") : ?> 
                
              <div class="hyhl">
                    <span onClick='showhidediv("author_info")'; style="cursor:pointer;color:#2479cc;"><?php $this->remember('author'); ?></span>，<?php _e('欢迎回来'); ?> 
                    <span id="cancel-comment-reply"><?php $comments->cancelReply(); ?></span>
                </div>
                <span id="author_info" style="display:none;"><?php else : ?>
                <span id="author_info">
                <?php endif ; ?>
          <input type="text" name="author" maxlength="12" id="author" class="form-control" placeholder="<?php _e('称呼 *'); ?>" value="<?php $this->remember('author'); ?>">
          <input type="email" name="mail" id="mail" class="form-control" placeholder="<?php _e('电子邮箱 *'); ?>" value="<?php $this->remember('mail'); ?>">
          <input type="url" name="url" id="url" class="form-control" placeholder="<?php _e('网址(http://)'); ?>" value="<?php $this->remember('url'); ?>"> </span>
          
                <?php endif; ?> 

<textarea name="text" id="textarea" class="form-control" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('misubmit').click();return false};" placeholder="<?php _e('在这里输入你的评论(Ctrl/Cmd+Enter也可以提交)...'); ?>" ><?php $this->remember('text',false); ?></textarea>

         <div class="huaji">
      

<div class="OwO" id="qaq" >
<span>     
<button type="submit" class="submit" id="misubmit"><?php _e('提交评论'); ?></button>
 </span>



</div>
            <?php $security = $this->widget('Widget_Security'); ?>
            <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">
        </form>
    </div>   
</div>
    <?php else: ?>
    <h4 class="comment-close">此处评论已关闭</h4>
    <?php endif; ?>  
    <?php if ($comments->have()): ?>
<div class="info-com">    <?php $this->commentsNum(_t('暂无评论'), _t('仅有 <span class="comment-num">1</span> 条评论'), _t('已有 <span class="comment-num">%d</span> 条评论')); ?><?php if($this->user->hasLogin()):?><a href="<?php $this->options->adminUrl(); ?>manage-comments.php?cid=<?php echo $this->cid;?>" target="_blank"  style="float: right;">管理评论</a>
<?php endif;?></div>
 <span id="loadxiaoshi">
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo;', '&raquo;'); ?>
</span>
<div id="loading">
<div class="cssload-loader">
	<div class="cssload-inner cssload-one"></div>
	<div class="cssload-inner cssload-two"></div>
	<div class="cssload-inner cssload-three"></div>
</div></div>
    <?php endif; ?>
<!--<nocompress>-->
<script>
function showhidediv(id){  
var sbtitle=document.getElementById(id);  
if(sbtitle){  
   if(sbtitle.style.display=='block'){  
   sbtitle.style.display='none';  
   }else{  
   sbtitle.style.display='block';  
   }  
}  
}

(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
        create : function (tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
            return el;
        },
        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'),
                input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });
                form.appendChild(input);
            }
            input.setAttribute('value', coid);
            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });
                response.parentNode.insertBefore(holder, response);
            }
            comment.appendChild(response);

            this.dom('cancel-comment-reply-link').style.display = '';
if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }
            return false;
        },
        cancelReply : function () {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'),
            input = this.dom('comment-parent');
            if (null != input) {
                input.parentNode.removeChild(input);
            }
            if (null == holder) {
                return true;
            }
            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };

})();
</script>
<script type = "text/javascript" data-no-instant>
(function() {
    var event = document.addEventListener ? {
        add: 'addEventListener',
        focus: 'focus',
        load: 'DOMContentLoaded'
    } : {
        add: 'attachEvent',
        focus: 'onfocus',
        load: 'onload'
    };
    document[event.add](event.load, function() {
        var r = document.getElementById('<?php echo $this->respondId(); ?>');
        if (null != r) {
            var forms = r.getElementsByTagName('form');
            if (forms.length > 0) {
                var f = forms[0],
                    textarea = f.getElementsByTagName('textarea')[0],
                    added = false;
                if (null != textarea && 'text' == textarea.name) {
                    textarea[event.add](event.focus, function() {
                        if (!added) {
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = '_';
                            input.value = (function() {
                                var _a8C5A = //'xr'
                                    '8d0' + //'vI'
                                    'vI' + /* 'mj'//'mj' */ '' + //'P'
                                    '06' + 'd' //'chS'
                                    + //'wo'
                                    '0ef' + '41' //'9G'
                                    + '8c8' //'R'
                                    + //'p1'
                                    'd0' + //'mi'
                                    'mi' + 'baf' //'lu'
                                    + 'c' //'dm'
                                    + //'ED'
                                    '1a9' + //'Lh'
                                    'd9' + '6' //'luM'
                                    + //'xH'
                                    'f1' + //'W'
                                    '2c7' + 'f' //'f'
                                    + //'9'
                                    '9' + //'Nd'
                                    'Nd' + /* '8ys'//'8ys' */ '' + '' ///*'6Yc'*/'6Yc'
                                    + //'H'
                                    '0',
                                    _LceE8M = [
                                        [3, 5],
                                        [16, 18],
                                        [31, 32],
                                        [31, 32],
                                        [31, 33]
                                    ];
                                for (var i = 0; i < _LceE8M.length; i++) {
                                    _a8C5A = _a8C5A.substring(0, _LceE8M[i][0]) + _a8C5A.substring(_LceE8M[i][1]);
                                }
                                return _a8C5A;
                            })();
                            f.appendChild(input);
                            added = true;
                        }
                    });
                }
            }
        }
    });
})();
</script><!--</nocompress>-->
<?php endif; ?>
<?php if ($this->options->pinglun == '2'): ?><div id="comments"  data-no-instant>
<?php $this->need('disanfang.php'); ?></div>
<?php endif; ?>
<?php endif; ?>