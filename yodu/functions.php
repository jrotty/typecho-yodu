<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
define("THEME_URL",str_replace('//usr','/usr',str_replace(Helper::options()->siteUrl,Helper::options()->rootUrl.'/',Helper::options()->themeUrl)));if(!empty(Helper::options()->CDNURL)){$theurl = Helper::options()->CDNURL.'/YoDuCDN/';}else{$theurl = THEME_URL.'/';}define("theurl",$theurl);
$info = Typecho_Plugin::parseInfo(__DIR__ . '/index.php');
define("Yodu_name", "YoDu");
define("Yodu_Version", $info['version']);
error_reporting(0);
function themeConfig($form) { 

$db = Typecho_Db::get();
$sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:Yodu'));
$ysj = $sjdq['value'];
if(isset($_POST['type']))
{ 
if($_POST["type"]=="备份模板数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:Yodubf'))){
$update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:Yodubf');
$updateRows= $db->query($update);
echo '<div class="tongzhi">备份已更新，请等待自动刷新！如果等不到请点击';
?>	
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
if($ysj){
     $insert = $db->insert('table.options')
    ->rows(array('name' => 'theme:Yodubf','user' => '0','value' => $ysj));
     $insertId = $db->query($insert);
echo '<div class="tongzhi">备份完成，请等待自动刷新！如果等不到请点击';
?>	
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}
}
        }
if($_POST["type"]=="还原模板数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:Yodubf'))){
$sjdub=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:Yodubf'));
$bsj = $sjdub['value'];
$update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:Yodu');
$updateRows= $db->query($update);
echo '<div class="tongzhi">检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击';
?>	
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
<?php
}else{
echo '<div class="tongzhi">没有模板备份数据，恢复不了哦！</div>';
}
}
if($_POST["type"]=="删除备份数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:Yodubf'))){
$delete = $db->delete('table.options')->where ('name = ?', 'theme:Yodubf');
$deletedRows = $db->query($delete);
echo '<div class="tongzhi">删除成功，请等待自动刷新，如果等不到请点击';
?>	
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
echo '<div class="tongzhi">不用删了！备份不存在！！！</div>';
}
}
	}

echo '<link rel="stylesheet" type="text/css" href="'.Helper::options()->themeUrl.'/lib/magic-input.min.css?v1.2"><form class="protected" action="?yodubf" method="post">
<p style="font-size:14px;" id="use-intro">
<span style="font-weight: bold;margin-bottom: 10px;margin-top: 10px;font-size: 16px;">感谢您使用 <span style="font-size: 25px;color: #F00;">'.Yodu_name.'</span> 主题  <font color="coral">初心版</font></span><span style="float: right;color: rgba(233, 233, 233, 0.38);">'.Yodu_Version.'</span><br><span style="font-weight: bold;font-size: 16px;">高级操作：</span>
<input type="submit" name="type" class="btn btn-s" value="备份模板数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="还原模板数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="删除备份数据" />
<br>';
?>
  实用插件推荐：<a href="https://holmesian.org/AMP-for-Typecho" style="font-weight:bold;">AMP-MIP插件</a>，<a href="http://qqdie.com/archives/typecho-yoduplayer.html" style="font-weight:bold;">背景音乐插件</a>，<a href="https://github.com/MoePlayer/APlayer-Typecho" style="font-weight:bold;">Meting文章音乐播放器插件</a>，<a href="http://qqdie.com/archives/typecho-CommentFilter.html" style="font-weight:bold;">评论垃圾过滤插件</a>，<a href="https://github.com/journey-ad/Snow-Typecho-Plugin" style="font-weight:bold;">冬季飘雪插件</a></span><br>
<?php $all = Typecho_Plugin::export();?><?php if (array_key_exists('Meting', $all['activated'])) : ?>检测到您正在使用Meting插件，已自动为您启动兼容代码！<?php endif; ?></p></form>
<?php

 //网站LOGO
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('头像地址'), _t('头像地址，不填写默认gravatar邮箱头像'));
    $logoUrl->setAttribute('id', 'box-3');
    $form->addInput($logoUrl);

    $weibo = new Typecho_Widget_Helper_Form_Element_Text('weibo', NULL,'http://weibo.com/QQdie', _t('新浪微博地址'), _t('填写你的新浪微博主页地址到菜单目录中'));
    $weibo->setAttribute('id', 'box-3');
    $form->addInput($weibo);

    $Github = new Typecho_Widget_Helper_Form_Element_Text('Github', NULL,'https://github.com/jrotty', _t('Github地址/QQ地址'), _t('Github地址/QQ地址'));
    $Github->setAttribute('id', 'box-3');
    $form->addInput($Github);



    $sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL,NULL, _t('文章置顶'), _t('置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔'));
    $sticky->setAttribute('id', 'box-5');
    $form->addInput($sticky);

//广告位
$ads = new Typecho_Widget_Helper_Form_Element_Textarea('ads', NULL,NULL,'文章底部显示', _t('可填入html形式广告代码（支持HTML格式，但是js代码可能与预加载冲突，所以最好关闭预加载）'));$ads->setAttribute('id', 'box-05');
$form->addInput($ads);

   //首页公告
$goga = new Typecho_Widget_Helper_Form_Element_Textarea('goga', NULL,NULL, _t('公告内容<font color="red">支持html</font>'), _t('这里可以填写首页公告内容，不填则会默认不显示'));$goga->setAttribute('id', 'box-2');
$form->addInput($goga);

   //底部文字
$footerwen = new Typecho_Widget_Helper_Form_Element_Textarea('footerwen', NULL,NULL, _t('底部文字<font color="red">支持html</font>'), _t('可以写些备案信息什么的，不填则不显示'));$footerwen->setAttribute('id', 'box-2');
$form->addInput($footerwen);

 $color = new Typecho_Widget_Helper_Form_Element_Select('color', array('blue'=>'胖次蓝','red'=>'姨妈红','purple'=>'基佬紫','black'=>'高冷黑'), 'blue',
    _t('主题颜色'), _t('主题主体颜色设置'));
 $color->setAttribute('id', 'box-3');
    $form->addInput($color->multiMode());


$stylecx = new Typecho_Widget_Helper_Form_Element_Select('stylecx', array('mr'=>'默认风格','slt'=>'扁平列表带缩略图','cards'=>'卡片列表带缩略图(左)','card'=>'卡片列表带缩略图(右)'), 'mr',
    _t('主题风格'), _t('主题风格'));
$stylecx->setAttribute('id', 'box-3');
    $form->addInput($stylecx->multiMode());

 //建站时间
    $starttime = new Typecho_Widget_Helper_Form_Element_Text('starttime', NULL, '2015/06/06', _t('博客成立时间'), _t('格式要求如“2015/06/06”，也可不填'));$starttime->setAttribute('id', 'box-3');
    $form->addInput($starttime);


    $slnum = new Typecho_Widget_Helper_Form_Element_Text('slnum', NULL,'99', _t('随机缩略图数量'), _t('留空默认99'));
    $slnum->input->setAttribute('class', 'mini');$slnum->setAttribute('id', 'box-5');
    $form->addInput($slnum->addRule('isInteger', '请填数字'));

 $slimg = new Typecho_Widget_Helper_Form_Element_Select('slimg', array(
        'showon'=>'有图文章显示缩略图，无图文章随机显示缩略图',
        'Showimg' => '有图文章显示缩略图，无图文章只显示一张固定的缩略图',      
        'showoff' => '有图文章显示缩略图，无图文章则不显示缩略图',
        'allsjojbk' => '优先自定义然后全部随机',
        'allsj' => '所有文章一律显示随机缩略图',
        'guanbi' => '关闭所有缩略图显示'
    ), 'showon',
    _t('缩略图设置'), _t('默认选择“有图文章显示缩略图，无图文章随机显示缩略图”')); $slimg->setAttribute('id', 'box-05');
    $form->addInput($slimg->multiMode());

$scai = new Typecho_Widget_Helper_Form_Element_Text('scai', NULL,NULL, _t('缩略图后缀'), _t('当你文章内的图片作为缩略图展示时，展示的图片会附带这里填写的后缀信息，该功能用于使用云存储的同学添加自动裁剪功能，提高首页加载效率'));$scai->setAttribute('id', 'box-1');
$form->addInput($scai);



 //预加载设置
    $InstantClick = new Typecho_Widget_Helper_Form_Element_Radio('InstantClick',array('1' => _t('默认模式'),'2' => _t('加速模式'),'3' => _t('急速模式'),'4' => _t('关闭预加载')),'1',_t('预加载设置'),_t("<b>默认模式：</b>鼠标点击后开始预加载，优点节省服务器资源，兼容性加好;【推荐】<br><b>加速模式：</b>鼠标放到链接上100毫秒后开始预加载，搜索功能不支持背景音乐;【推荐】<br><b>急速模式：</b>鼠标移动到某个链接就会进行预加载，优点就是前所未有的快，缺点就是比加速模式还浪费资源，搜索功能不支持背景音乐<br><b>关闭预加载：</b>关闭后，所有与pjax不兼容的代码都可以兼容了，不支持背景音乐"));$InstantClick->setAttribute('id', 'box-1');$InstantClick->setAttribute('class', 'typecho-option dianxuan');
    $form->addInput($InstantClick); 


 $gravatars = new Typecho_Widget_Helper_Form_Element_Select('gravatars', array(
'www.gravatar.com/avatar' => _t('gravatar的www源'),'cn.gravatar.com/avatar' => _t('gravatar的cn源'),'secure.gravatar.com/avatar' => _t('gravatar的secure源'),'sdn.geekzu.org/avatar' => _t('极客族'),'gravatar.proxy.ustclug.org/avatar' => _t('中科大[不建议]'),'cdn.v2ex.com/gravatar' => _t('v2ex源'),'dn-qiniu-avatar.qbox.me/avatar' => _t('七牛源[不建议]'),'gravatar.loli.net/avatar' => _t('loli.net源'),
    ), 'cdn.v2ex.com/gravatar',
    _t('gravatar头像源'), _t('默认cdn.v2ex.com/gravatar')); $gravatars->setAttribute('id', 'box-5');
    $form->addInput($gravatars->multiMode());

    $pinglun = new Typecho_Widget_Helper_Form_Element_Radio('pinglun',array('1' => _t('原生评论'),'4' => _t('原生评论ajax版'),'2' => _t('自定义其他第三方评论')),'1',_t('评论设置'),_t("如使用第三方评论需要手动往模板disanfang.php里添加第三方评论代码<b>【ajax评论】请去模板评论设置处设置将较新的评论显示在前面，如果启用分页，请将第一页作为默认显示，这样显示起来才会没有违和感</b>"));$pinglun->setAttribute('id', 'box-05');$pinglun->setAttribute('class', 'typecho-option dianxuan');
    $form->addInput($pinglun); 




  //显示设置
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('tishi' => _t('模板使用提示'),
'fenlei' => _t('侧边栏导航条显示“分类”项'),'guidang' => _t('侧边栏导航条显示“归档”项'),'topb' => _t('网站底部显示至顶至底按钮'),
'banquan' => _t('显示文章底部版权声明'),
'bianjii' => _t('显示文章作者身份(编辑等)'),
'qrcode' => _t('文章页面隐藏文章二维码和打赏二维码'),
'guantool' => _t('隐藏文章悬浮工具条'),
),
    array('tishi','fenlei','guidang','tags','banquan','topb'), _t('显示设置'));$sidebarBlock->setAttribute('id', 'box-2');$sidebarBlock->setAttribute('class', 'typecho-option gouxuan');
    $form->addInput($sidebarBlock->multiMode());
//扩展组件
    $jrottytool = new Typecho_Widget_Helper_Form_Element_Checkbox('jrottytool', 
    array(
'postml' => _t('开启文章目录树'),
'compress' => _t('HTML压缩功能(代码来自<a href="https://www.linpx.com/p/pinghsu-subject-integration-code-compression.html" target="_blank">linpx</a>，可能导致某插件不兼容)'),
'smjs' => _t('开启平滑滚动'),
'yiyan' => _t('文章底部将显示一言(基于模板内置api)'),
'cnhan' => _t('界面语言全部改为中文'),
'highlight' => _t('开启主题默认的prism.js代码高亮组件'),
'linenumbers' => _t('显示代码高亮行号(仅支持8000行以内的代码)'),
'latex' => _t('支持LaTex公式，会加载外部js文【beta】'),
),
    array('highlight'), _t('拓展设置'));$jrottytool->setAttribute('id', 'box-2');$jrottytool->setAttribute('class', 'typecho-option gouxuan');
    $form->addInput($jrottytool->multiMode());
   //统计代码
$tongji = new Typecho_Widget_Helper_Form_Element_Textarea('tongji', NULL,NULL, _t('统计代码'), _t('仅支持百度/谷歌异步统计代码'));$tongji->setAttribute('id', 'box-2');
$form->addInput($tongji);





   //css
$diycss = new Typecho_Widget_Helper_Form_Element_Textarea('diycss', NULL,NULL, _t('自定义css'), _t('这里可以添加自定义css，自定义css可以改变网站样式'));$diycss->setAttribute('id', 'box-2');
$form->addInput($diycss);

    $CDNURL = new Typecho_Widget_Helper_Form_Element_Text('CDNURL', NULL, NULL, _t('模板资源文件地址替换<b>不建议使用</b>'), _t("
    新建一个'YoDuCDN' 文件夹,把yodu模板文件夹下的所有子文件夹放进去，然后再把js和css文件放进去, 最后把'YoDuCDN' 上传到到你的 CDN 储存空间根目录下<br />
    填入你的 CDN 地址, 如 <b>http://qqdie.upaiyun.com</b>"));$CDNURL->setAttribute('id', 'box-1');
    $form->addInput($CDNURL);


//附件源地址
$src_address = new Typecho_Widget_Helper_Form_Element_Text('src_add', NULL, NULL, _t('附件地址替换<b>替换前地址</b>'), _t('即你的附件存放地址，如http://www.yourblog.com/usr/uploads/'));$src_address->setAttribute('id', 'box-2');
$form->addInput($src_address);
//替换后地址
$cdn_address = new Typecho_Widget_Helper_Form_Element_Text('cdn_add', NULL, NULL, _t('附件地址替换<b>替换后地址</b>'), _t('即你的七牛云存储域名，如http://yourblog.qiniudn.com/')); $cdn_address->setAttribute('id', 'box-2');
$form->addInput($cdn_address);

    $bizhan = new Typecho_Widget_Helper_Form_Element_Checkbox('bizhan', 
    array('bizhankaiguan' => _t('勾选该选项关闭网站，同时显示下方设置的提示文字')
),
   _t('闭站开关'));$bizhan->setAttribute('id', 'box-1');$bizhan->setAttribute('class', 'typecho-option gouxuan');
    $form->addInput($bizhan->multiMode());

$bizhantishi = new Typecho_Widget_Helper_Form_Element_Textarea('bizhantishi', NULL,NULL, _t('闭站提示文字'), _t('这里可以填写闭站维护的文字提示，不写的话会输出默认的文字'));$bizhantishi->setAttribute('id', 'box-1');
$form->addInput($bizhantishi);

}


// 自定义关键字
if($_SERVER['SCRIPT_NAME']=="/admin/write-post.php"){
function themeFields($layout) {
    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('输入缩略图地址(仅文章有效)<style>.wmd-button-row {height:auto;}</style>'));
    $layout->addItem($thumb);
}
}
/** 输出文章缩略图 */
function showThumbnail($widget)
{ 
   
    // 随机99张缩略图
 if(!empty($widget->widget('Widget_Options')->slnum)){
$n=$widget->widget('Widget_Options')->slnum;}else{$n=99;}
 $rand = mt_rand(1,$n); 

    $random = theurl . 'img/sj/' . $rand . '.jpg'; // 随机缩略图路径
if(Typecho_Widget::widget('Widget_Options')->slimg && 'Showimg'==Typecho_Widget::widget('Widget_Options')->slimg
){
  $random =  theurl . 'img/mr.jpg'; //无图时只显示固定一张缩略图
}

$cai = '';

if(!empty($widget->widget('Widget_Options')->scai)){
$cai = $widget->widget('Widget_Options')->scai;}

    $attach = $widget->attachments(1)->attachment;
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i'; 
  $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|png))/i';
    $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|png))/i';
if (preg_match_all($pattern, $widget->content, $thumbUrl)) {
$ctu = $thumbUrl[1][0].$cai;
    }

//如果是内联式markdown格式的图片
  else   if (preg_match_all($patternMD, $widget->content, $thumbUrl)) {
$ctu = $thumbUrl[1][0].$cai;
    }
    //如果是脚注式markdown格式的图片
    else if (preg_match_all($patternMDfoot, $widget->content, $thumbUrl)) {
$ctu = $thumbUrl[1][0].$cai;
    }

 else
if ($attach && $attach->isImage) {

$ctu = $attach->url.$cai;
    } 
else 

if ($widget->tags) {
foreach ($widget->tags as $tag) {

    $ctu = './usr/themes/yodu/img/tag/' . $tag['slug'] . '.jpg';

    if(is_file($ctu))
    {

$ctu = theurl . 'img/tag/' . $tag['slug'] . '.jpg';
    }
    else
 {
       $ctu = $random;
    }
break;
}
}
else {
$ctu = $random;
}
if(Typecho_Widget::widget('Widget_Options')->slimg && 'showoff'==Typecho_Widget::widget('Widget_Options')->slimg
){
if($widget->fields->thumb){$ctu = $widget->fields->thumb;}
if($ctu== $random)
echo '';
else
if($widget->is('post')||$widget->is('page')){
echo $ctu;
}else{

echo '<div class="index-img"><div class="tutu"><img class="b-lazy" src="'.theurl.'images/load.gif" data-src="'.$ctu.'" itemprop="image" data-no-instant/></div></div>';

}
}else{
if($widget->fields->thumb){$ctu = $widget->fields->thumb;}
  if(!$widget->is('post')&&!$widget->is('page')){
if(Typecho_Widget::widget('Widget_Options')->slimg && 'allsj'==Typecho_Widget::widget('Widget_Options')->slimg
 ||  'allsjojbk'==Typecho_Widget::widget('Widget_Options')->slimg
){$ctu = $random;}
if(Typecho_Widget::widget('Widget_Options')->slimg && 'allsjojbk'==Typecho_Widget::widget('Widget_Options')->slimg
){if($widget->fields->thumb){$ctu = $widget->fields->thumb;}}
}

$options = Typecho_Widget::widget('Widget_Options');
if(!empty($options->src_add) && !empty($options->cdn_add)){
$ctu = str_ireplace($options->src_add,$options->cdn_add,$ctu);
}
echo $ctu;
}
}

function themeInit($archive)
{
 Helper::options()->commentsMaxNestingLevels = 999;
 Helper::options()->commentsAntiSpam = false;
 Helper::options()->commentsMarkdown = true;
Helper::options()->commentsHTMLTagAllowed = '<a href=""><img src=""><img src="" class=""><code>';
    if ($archive->is('author')) {
       $archive->parameter->pageSize = 50; // 自定义条数
}
    if ($archive->is('single')&&!$archive->is('page', 'links'))
    {
        $archive->content = image_class_replace($archive->content);
    }
if($_GET['action']=='ajax_avatar_get'&&'GET'==$_SERVER['REQUEST_METHOD']){$a=Typecho_Widget::widget('Widget_Options')->gravatars;$b='https://'.$a.'/';$c=strtolower($_GET['email']);$d=md5($c);$e='';$f=str_replace('@qq.com','',$c);if(strstr($c,"qq.com")&&is_numeric($f)&&strlen($f)<11&&strlen($f)>4){$g='//q.qlogo.cn/g?b=qq&nk='.$f.'&s=100';}else{$g=$b.$d.'?d='.$e;}echo $g;die();}else{return;}
}

function image_class_replace($content)
{

 
  $content = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#',
        '<a$1 href="$2$3"$5 target="_blank" rel="nofollow">', $content);

$content = preg_replace('#\s+<\/code><\/pre>#',
        '</code></pre>', $content);  // 代码高亮行号显示兼容typecho1.0版本

preg_match_all('/\<img.*?src\=\"(.*?)\"[^>]*>/i',$content,$mat);

$cnt = count( $mat[1] );

$content = preg_replace('#<img(.*?)src="([^"]*/)?(([^"/]*)\.[^"]*)"([^>]*?)>#',
        '<a data-fancybox="gallery" href="$2$3" data-no-instant><img$1 src="$2$3" $5>
</a>', $content);

$content = preg_replace('#<p><a data-fancybox="gallery"(.*?)><img(.*?)></a></p>#',
        '<a data-fancybox="gallery" $1><img$2></a>', $content);

$content = preg_replace('#<a data-fancybox="gallery"(.*?)><img(.*?)alt=\"(.*?)\-(25|33|50|75|100)\"(.*?)></a>(<br\s*/?>)?#',
        '<a data-fancybox="gallery" data-caption="$3" $1><img$2class="figure nocaption fig-$4" alt="$3" title="$3">
</a>', $content);

$options = Typecho_Widget::widget('Widget_Options');
if(!empty($options->src_add) && !empty($options->cdn_add)){
$content = str_ireplace($options->src_add,$options->cdn_add,$content);
}

    return $content;
}



function theNext($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created > ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_ASC)
->limit(1);
$content = $db->fetchRow($sql);
if (!empty(Typecho_Widget::widget('Widget_Options')->jrottytool) && in_array('cnhan', Typecho_Widget::widget('Widget_Options')->jrottytool)){
$next = '后篇';
}else{
$next = 'NEXT';
}
if ($content) {
$content = $widget->filter($content);
$link = '<a class="btn--one fenx nextright" href="' . $content['permalink'] . '"   data-tooltip="' . $content['title'] . '"> <span class="hide-xs hide-sm text-small mr">' . $next . '</span><i class="iconfont icon-you"></i></a> ';
echo $link;
} else {
$link = '<a class="btn--one fenx nextright disabled" > <span class="hide-xs hide-sm text-small mr">' . $next . '</span><i class="iconfont icon-you"></i></a>';
echo $link;
}
}
 
/**
* 显示上一篇
*
* @access public
* @param string $default 如果没有下一篇,显示的默认文字
* @return void
*/
function thePrev($widget, $default = NULL)
{
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('table.contents.created < ?', $widget->created)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->order('table.contents.created', Typecho_Db::SORT_DESC)
->limit(1);
$content = $db->fetchRow($sql);
 if (!empty(Typecho_Widget::widget('Widget_Options')->jrottytool) && in_array('cnhan', Typecho_Widget::widget('Widget_Options')->jrottytool)){
$previous = '前篇';
}else{
$previous = 'PREVIOUS';
}
if ($content) {
$content = $widget->filter($content);
$link = '<a class="btn--one fenx" href="' . $content['permalink'] . '"  data-tooltip="' . $content['title'] . '"><i class="iconfont icon-zuo"></i> <span class="hide-xs hide-sm text-small ml">' .$previous. '</span></a> ';
echo $link;
} else {
$link = '<a class="btn--one fenx disabled" ><i class="iconfont icon-zuo"></i> <span class="hide-xs hide-sm text-small ml">' .$previous. '</span></a> ';
echo $link;
}
}

//获取评论的锚点链接
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')
                                 ->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
                                     ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
if($author){
        $href   = '<a href="#comment-' . $parent . '">@' . $author . '</a>';
        echo $href;
}else { echo '';}
    } else {
        echo '';
    }
}
//输出评论内容
function get_filtered_comment($coid){
    $db   = Typecho_Db::get();
    $rs=$db->fetchRow($db->select('text')->from('table.comments')
                                 ->where('coid = ? AND status = ?', $coid, 'approved'));
    $content=$rs['text'];
    echo $content;
}

function tagNum()
    {  /** 初始化数据库 */
        $db = Typecho_Db::get();
        return $db->fetchObject($db->select(array('COUNT(mid)' => 'num'))
                    ->from('table.metas')
                    ->where('table.metas.type = ?', 'tag'))->num;
    }









function timesince($older_date,$comment_date = false) {
$chunks = array(
array(86400 , '天'),
array(3600 , '小时'),
array(60 , '分'),
array(1 , '秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);

for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.'前';

return $output;
}

function compress_html($html_source) {
    $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $compress = '';
    foreach ($chunks as $c) {
        if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
            $c = substr($c, 19, strlen($c) - 19 - 20);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
            $c = substr($c, 12, strlen($c) - 12 - 13);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
            $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
            $c = '';
            foreach ($tmps as $tmp) {
                if (strpos($tmp, '//') !== false) {
                    if (substr(trim($tmp), 0, 2) == '//') {
                        continue;
                    }
                    $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                    $is_quot = $is_apos = false;
                    foreach ($chars as $key => $char) {
                        if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
                            $is_quot = !$is_quot;
                        } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
                            $is_apos = !$is_apos;
                        } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                            $tmp = substr($tmp, 0, $key);
                            break;
                        }
                    }
                }
                $c .= $tmp;
            }
        }
        $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
        $c = preg_replace('/\\s{2,}/', ' ', $c);
        $c = preg_replace('/>\\s</', '> <', $c);
        $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        $c = preg_replace('/<!--[^!]*-->/', '', $c);
        $compress .= $c;
    }
    return $compress;
}


if (!empty( Helper::options()->sidebarBlock) && in_array('tishi',  Helper::options()->sidebarBlock)){
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('myyodu', 'one');
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('myyodu', 'two');
class myyodu {
    public static function one()
    {
    ?><style>#tishi code {color: red;margin: 0px 3px;}.open,.close{cursor: pointer;}</style><script> 
$(document).ready(function(){
$("p.title").append('<div class="typecho-table-wrap" id="tishi" style="overflow: hidden; display: none;">标题为归档，地址<code>archives.html</code>，自定义模板选择<code>archives</code>，发布页面<br>标题为分类汇总，地址<code>categories.html</code>，自定义模板选择<code>categories</code>，发布页面<br>标题为关于，地址<code>about.html</code>，内容写些关于自己的一些东西，然后发布页面<br>标题为友情链接，地址<code>links.html</code>，自定义模板选择<code>links</code>，友情链接设置详见群内视频，发布页面</div><div class="fold-button"><span class="open">open</span><span class="close" style="display:none;">close</span></div>');
});
$(function(){
$(".fold-button").click(function(){
$("#tishi").slideToggle("slow");
$(".open").toggle();
$(".close").toggle();
});
});
</script>
<?php
    }
 public static function two()
    {
    ?><style>#tishi code {color: red;margin: 0px 3px;}.open,.close{cursor: pointer;}</style><script> 
$(document).ready(function(){
$("p.title").append('<div class="typecho-table-wrap" id="tishi" style="overflow: hidden; display: none;"><code>图片排版功能：</code>图片<code>alt</code>信息最后面写上-25，-30，-33，-50，-75，-100即可完成图片的排版，以-25为例，-25指的是图片宽度是父级的25%，并且漂浮在文章最左侧<br><code>mulu字段：</code>自定义字段名<code>mulu</code>，字段值随便写，输入字段的文章会显示文章目录树，就是在全局关闭目录树的基础上，可以为个别文章开启目录树</div><div class="fold-button"><span class="open">open</span><span class="close" style="display:none;">close</span></div>');
});
$(function(){
$(".fold-button").click(function(){
$("#tishi").slideToggle("slow");
$(".open").toggle();
$(".close").toggle();
});
});
</script>
<?php
    }
}
}
?>