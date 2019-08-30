!function(){function n(n,t){for(property in t)t.hasOwnProperty(property)&&(n[property]=t[property]);return n}function t(n,t){var i=document.createElement("div");i.className="notyf";var e=document.createElement("div");e.className="notyf-wrapper";var o=document.createElement("div");o.className="notyf-icon";var a=document.createElement("i");a.className=t;var r=document.createElement("div");r.className="notyf-message",r.innerHTML=n,o.appendChild(a),e.appendChild(o),e.appendChild(r),i.appendChild(e);var c=this;return setTimeout(function(){i.className+=" disappear",i.addEventListener(c.animationEnd,function(n){n.target==i&&c.container.removeChild(i)});var n=c.notifications.indexOf(i);c.notifications.splice(n,1)},c.options.delay),i}function i(){var n,t=document.createElement("fake"),i={transition:"animationend",OTransition:"oAnimationEnd",MozTransition:"animationend",WebkitTransition:"webkitAnimationEnd"};for(n in i)if(void 0!==t.style[n])return i[n]}this.Notyf=function(){this.notifications=[];var t={delay:2e3,alertIcon:"notyf-alert-icon",confirmIcon:"notyf-confirm-icon"};arguments[0]&&"object"==typeof arguments[0]?this.options=n(t,arguments[0]):this.options=t;var e=document.createDocumentFragment(),o=document.createElement("div");o.className="notyf-container",e.appendChild(o),document.body.appendChild(e),this.container=o,this.animationEnd=i()},this.Notyf.prototype.alert=function(n){var i=t.call(this,n,this.options.alertIcon);i.className+=" alert",this.container.appendChild(i),this.notifications.push(i)},this.Notyf.prototype.confirm=function(n){var i=t.call(this,n,this.options.confirmIcon);i.className+=" confirm",this.container.appendChild(i),this.notifications.push(i)}}();var notyf = new Notyf();
/*!
  hey, [be]Lazy.js - v1.6.2 - 2016.05.09
  A fast, small and dependency free lazy load script (https://github.com/dinbror/blazy)
  (c) Bjoern Klinggaard - @bklinggaard - http://dinbror.dk/blazy
*/
  (function(p,m){"function"===typeof define&&define.amd?define(m):"object"===typeof exports?module.exports=m():p.Blazy=m()})(this,function(){function p(b){var c=b._util;c.elements=B(b.options.selector);c.count=c.elements.length;c.destroyed&&(c.destroyed=!1,b.options.container&&k(b.options.container,function(a){n(a,"scroll",c.validateT)}),n(window,"resize",c.save_viewportOffsetT),n(window,"resize",c.validateT),n(window,"scroll",c.validateT));m(b)}function m(b){for(var c=b._util,a=0;a<c.count;a++){var d=c.elements[a],f=d.getBoundingClientRect();if(f.right>=e.left&&f.bottom>=e.top&&f.left<=e.right&&f.top<=e.bottom||q(d,b.options.successClass))b.load(d),c.elements.splice(a,1),c.count--,a--}0===c.count&&b.destroy()}function x(b,c,a){if(!q(b,a.successClass)&&(c||a.loadInvisible||0<b.offsetWidth&&0<b.offsetHeight))if(c=b.getAttribute(r)||b.getAttribute(a.src)){c=c.split(a.separator);var d=c[y&&1<c.length?1:0],f="img"===b.nodeName.toLowerCase();if(f||void 0===b.src){var l=new Image,u=function(){a.error&&a.error(b,"invalid");t(b,a.errorClass);g(l,"error",u);g(l,"load",h)},h=function(){if(f){b.src=d;v(b,"srcset",a.srcset);var c=b.parentNode;c&&"picture"===c.nodeName.toLowerCase()&&k(c.getElementsByTagName("source"),function(b){v(b,"srcset",a.srcset)})}else b.style.backgroundImage='url("'+d+'")';w(b,a);g(l,"load",h);g(l,"error",u)};n(l,"error",u);n(l,"load",h);l.src=d}else b.src=d,w(b,a)}else"video"===b.nodeName.toLowerCase()?(k(b.getElementsByTagName("source"),function(b){v(b,"src",a.src)}),b.load(),w(b,a)):(a.error&&a.error(b,"missing"),t(b,a.errorClass))}function w(b,c){t(b,c.successClass);c.success&&c.success(b);b.removeAttribute(c.src);k(c.breakpoints,function(a){b.removeAttribute(a.src)})}function v(b,c,a){var d=b.getAttribute(a);d&&(b[c]=d,b.removeAttribute(a))}function q(b,c){return-1!==(" "+b.className+" ").indexOf(" "+c+" ")}function t(b,c){q(b,c)||(b.className+=" "+c)}function B(b){var c=[];b=document.querySelectorAll(b);for(var a=b.length;a--;c.unshift(b[a]));return c}function z(b){e.bottom=(window.innerHeight||document.documentElement.clientHeight)+b;e.right=(window.innerWidth||document.documentElement.clientWidth)+b}function n(b,c,a){b.attachEvent?b.attachEvent&&b.attachEvent("on"+c,a):b.addEventListener(c,a,!1)}function g(b,c,a){b.detachEvent?b.detachEvent&&b.detachEvent("on"+c,a):b.removeEventListener(c,a,!1)}function k(b,c){if(b&&c)for(var a=b.length,d=0;d<a&&!1!==c(b[d],d);d++);}function A(b,c,a){var d=0;return function(){var f=+new Date;f-d<c||(d=f,b.apply(a,arguments))}}var r,e,y;return function(b){if(!document.querySelectorAll){var c=document.createStyleSheet();document.querySelectorAll=function(a,b,d,h,e){e=document.all;b=[];a=a.replace(/\[for\b/gi,"[htmlFor").split(",");for(d=a.length;d--;){c.addRule(a[d],"k:v");for(h=e.length;h--;)e[h].currentStyle.k&&b.push(e[h]);c.removeRule(0)}return b}}var a=this,d=a._util={};d.elements=[];d.destroyed=!0;a.options=b||{};a.options.error=a.options.error||!1;a.options.offset=a.options.offset||100;a.options.success=a.options.success||!1;a.options.selector=a.options.selector||".b-lazy";a.options.separator=a.options.separator||"|";a.options.container=a.options.container?document.querySelectorAll(a.options.container):!1;a.options.errorClass=a.options.errorClass||"b-error";a.options.breakpoints=a.options.breakpoints||!1;a.options.loadInvisible=a.options.loadInvisible||!1;a.options.successClass=a.options.successClass||"b-loaded";a.options.validateDelay=a.options.validateDelay||25;a.options.save_viewportOffsetDelay=a.options.save_viewportOffsetDelay||50;a.options.srcset=a.options.srcset||"data-srcset";a.options.src=r=a.options.src||"data-src";y=1<window.devicePixelRatio;e={};e.top=0-a.options.offset;e.left=0-a.options.offset;a.revalidate=function(){p(this)};a.load=function(a,b){var c=this.options;void 0===a.length?x(a,b,c):k(a,function(a){x(a,b,c)})};a.destroy=function(){var a=this._util;this.options.container&&k(this.options.container,function(b){g(b,"scroll",a.validateT)});g(window,"scroll",a.validateT);g(window,"resize",a.validateT);g(window,"resize",a.save_viewportOffsetT);a.count=0;a.elements.length=0;a.destroyed=!0};d.validateT=A(function(){m(a)},a.options.validateDelay,a);d.save_viewportOffsetT=A(function(){z(a.options.offset)},a.options.save_viewportOffsetDelay,a);z(a.options.offset);k(a.options.breakpoints,function(a){if(a.width>=window.screen.width)return r=a.src,!1});setTimeout(function(){p(a)})}});
/*!
 * headroom.js v0.9.4 - Give your page some headroom. Hide your header until you need it
 * Copyright (c) 2017 Nick Williams - http://wicky.nillia.ms/headroom.js
 * License: MIT
 */

!function(a,b){"use strict";"function"==typeof define&&define.amd?define([],b):"object"==typeof exports?module.exports=b():a.Headroom=b()}(this,function(){"use strict";function a(a){this.callback=a,this.ticking=!1}function b(a){return a&&"undefined"!=typeof window&&(a===window||a.nodeType)}function c(a){if(arguments.length<=0)throw new Error("Missing arguments in extend function");var d,e,f=a||{};for(e=1;e<arguments.length;e++){var g=arguments[e]||{};for(d in g)"object"!=typeof f[d]||b(f[d])?f[d]=f[d]||g[d]:f[d]=c(f[d],g[d])}return f}function d(a){return a===Object(a)?a:{down:a,up:a}}function e(a,b){b=c(b,e.options),this.lastKnownScrollY=0,this.elem=a,this.tolerance=d(b.tolerance),this.classes=b.classes,this.offset=b.offset,this.scroller=b.scroller,this.initialised=!1,this.onPin=b.onPin,this.onUnpin=b.onUnpin,this.onTop=b.onTop,this.onNotTop=b.onNotTop,this.onBottom=b.onBottom,this.onNotBottom=b.onNotBottom}var f={bind:!!function(){}.bind,classList:"classList"in document.documentElement,rAF:!!(window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame)};return window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame,a.prototype={constructor:a,update:function(){this.callback&&this.callback(),this.ticking=!1},requestTick:function(){this.ticking||(requestAnimationFrame(this.rafCallback||(this.rafCallback=this.update.bind(this))),this.ticking=!0)},handleEvent:function(){this.requestTick()}},e.prototype={constructor:e,init:function(){if(e.cutsTheMustard)return this.debouncer=new a(this.update.bind(this)),this.elem.classList.add(this.classes.initial),setTimeout(this.attachEvent.bind(this),100),this},destroy:function(){var a=this.classes;this.initialised=!1;for(var b in a)a.hasOwnProperty(b)&&this.elem.classList.remove(a[b]);this.scroller.removeEventListener("scroll",this.debouncer,!1)},attachEvent:function(){this.initialised||(this.lastKnownScrollY=this.getScrollY(),this.initialised=!0,this.scroller.addEventListener("scroll",this.debouncer,!1),this.debouncer.handleEvent())},unpin:function(){var a=this.elem.classList,b=this.classes;!a.contains(b.pinned)&&a.contains(b.unpinned)||(a.add(b.unpinned),a.remove(b.pinned),this.onUnpin&&this.onUnpin.call(this))},pin:function(){var a=this.elem.classList,b=this.classes;a.contains(b.unpinned)&&(a.remove(b.unpinned),a.add(b.pinned),this.onPin&&this.onPin.call(this))},top:function(){var a=this.elem.classList,b=this.classes;a.contains(b.top)||(a.add(b.top),a.remove(b.notTop),this.onTop&&this.onTop.call(this))},notTop:function(){var a=this.elem.classList,b=this.classes;a.contains(b.notTop)||(a.add(b.notTop),a.remove(b.top),this.onNotTop&&this.onNotTop.call(this))},bottom:function(){var a=this.elem.classList,b=this.classes;a.contains(b.bottom)||(a.add(b.bottom),a.remove(b.notBottom),this.onBottom&&this.onBottom.call(this))},notBottom:function(){var a=this.elem.classList,b=this.classes;a.contains(b.notBottom)||(a.add(b.notBottom),a.remove(b.bottom),this.onNotBottom&&this.onNotBottom.call(this))},getScrollY:function(){return void 0!==this.scroller.pageYOffset?this.scroller.pageYOffset:void 0!==this.scroller.scrollTop?this.scroller.scrollTop:(document.documentElement||document.body.parentNode||document.body).scrollTop},getViewportHeight:function(){return window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight},getElementPhysicalHeight:function(a){return Math.max(a.offsetHeight,a.clientHeight)},getScrollerPhysicalHeight:function(){return this.scroller===window||this.scroller===document.body?this.getViewportHeight():this.getElementPhysicalHeight(this.scroller)},getDocumentHeight:function(){var a=document.body,b=document.documentElement;return Math.max(a.scrollHeight,b.scrollHeight,a.offsetHeight,b.offsetHeight,a.clientHeight,b.clientHeight)},getElementHeight:function(a){return Math.max(a.scrollHeight,a.offsetHeight,a.clientHeight)},getScrollerHeight:function(){return this.scroller===window||this.scroller===document.body?this.getDocumentHeight():this.getElementHeight(this.scroller)},isOutOfBounds:function(a){var b=a<0,c=a+this.getScrollerPhysicalHeight()>this.getScrollerHeight();return b||c},toleranceExceeded:function(a,b){return Math.abs(a-this.lastKnownScrollY)>=this.tolerance[b]},shouldUnpin:function(a,b){var c=a>this.lastKnownScrollY,d=a>=this.offset;return c&&d&&b},shouldPin:function(a,b){var c=a<this.lastKnownScrollY,d=a<=this.offset;return c&&b||d},update:function(){var a=this.getScrollY(),b=a>this.lastKnownScrollY?"down":"up",c=this.toleranceExceeded(a,b);this.isOutOfBounds(a)||(a<=this.offset?this.top():this.notTop(),a+this.getViewportHeight()>=this.getScrollerHeight()?this.bottom():this.notBottom(),this.shouldUnpin(a,c)?this.unpin():this.shouldPin(a,c)&&this.pin(),this.lastKnownScrollY=a)}},e.options={tolerance:{up:0,down:0},offset:0,scroller:window,classes:{pinned:"headroom--pinned",unpinned:"headroom--unpinned",top:"headroom--top",notTop:"headroom--not-top",bottom:"headroom--bottom",notBottom:"headroom--not-bottom",initial:"headroom"}},e.cutsTheMustard="undefined"!=typeof f&&f.rAF&&f.bind&&f.classList,e});
/*!
文章目录树
*/
function GenerateContentList(){var mainContent=$("#mulu");var h1_list=$(".content h1");var h2_list=$(".content h2");if(mainContent.length<1){return}if(h1_list.length>0){var content='';content+='<div class="mulu">';content+='<span id="table-of-contents">文章目录</span><span class="post-menutree-title-handle">[<a href="#" onclick="javascript:return openPostMenutree(this);" title="隐藏">隐藏</a>]</span>';content+='<ol class="toc">';for(var i=0;i<h1_list.length;i++){var go_to_top='<a name="_label'+i+'"></a>';$(h1_list[i]).before(go_to_top);var h2_list=$(h1_list[i]).nextAll("h2");var li2_content="";for(var j=0;j<h2_list.length;j++){var tmp=$(h2_list[j]).prevAll("h1").first();if(!tmp.is(h1_list[i])){break}var li2_anchor='<a name="_label'+i+"_"+j+'"></a>';$(h2_list[j]).before(li2_anchor);li2_content+='<li class="toc-item toc-level-'+i+"_"+j+'"><a class="toc-link" href="#_label'+i+"_"+j+'"><span class="toc-text">'+$(h2_list[j]).text()+"</span></a></li>"}var li1_content="";if(li2_content.length>0){li1_content='<li class="toc-item toc-level-'+i+'"><a class="toc-link" href="#_label'+i+'"><span class="toc-text">'+$(h1_list[i]).text()+'</span></a></li><ol class="toc-child">'+li2_content+"</ol>"}else{li1_content='<li class="toc-item toc-level-'+i+'"><a class="toc-link" href="#_label'+i+'"><span class="toc-text">'+$(h1_list[i]).text()+"</span></a></li>"}content+=li1_content}if($("#mulu").length!=0){$($("#mulu")[0]).prepend(content)}}else{if(h1_list.length==0&&h2_list.length>0){var content="";content+='<div class="mulu">';content+='<span id="table-of-contents">文章目录</span><span class="post-menutree-title-handle">[<a href="#" onclick="javascript:return openPostMenutree(this);" title="隐藏">隐藏</a>]</span>';content+='<ol class="toc">';for(var i=0;i<h2_list.length;i++){var go_to_top='<a name="_label'+i+'"></a>';$(h2_list[i]).before(go_to_top);var h3_list=$(h2_list[i]).nextAll("h3");var li3_content="";for(var j=0;j<h3_list.length;j++){var tmp=$(h3_list[j]).prevAll("h2").first();if(!tmp.is(h2_list[i])){break}var li3_anchor='<a name="_label'+i+"_"+j+'"></a>';$(h3_list[j]).before(li3_anchor);li3_content+='<li class="toc-item toc-level-'+i+"_"+j+'"><a class="toc-link" href="#_label'+i+"_"+j+'"><span class="toc-text">'+$(h3_list[j]).text()+"</span></a></li>"}var li2_content="";if(li3_content.length>0){li2_content='<li class="toc-item toc-level-'+i+'"><a class="toc-link" href="#_label'+i+'"><span class="toc-text">'+$(h2_list[i]).text()+'</span></a></li><ol class="toc-child">'+li3_content+"</ol>"}else{li2_content='<li class="toc-item toc-level-'+i+'"><a class="toc-link" href="#_label'+i+'"><span class="toc-text">'+$(h2_list[i]).text()+"</span></a></li>"}content+=li2_content}if($("#mulu").length!=0){$($("#mulu")[0]).prepend(content)}}}}

function openPostMenutree(e) {
    if (e.innerHTML == "隐藏") {
        jQuery(e).attr("title", "隐藏").html("显示");   jQuery(".toc").slideUp('fast');
    } else {
        jQuery(e).attr("title", "显示").html("隐藏");   jQuery(".toc").slideDown('fast');
    }
    e.blur();
    return false;
}

/*搜索监控*/
var bb=$("#soux").attr("href");
$("#soux").attr("href",""); 
$('#keyword').bind('input propertychange', function () {
  var aa=$("input[name=s]").val();
$("#soux").attr("href",bb+aa); 
});






if(!$('#header').hasClass('menu')){
var header = new Headroom(document.getElementById("header"), {
    tolerance: 0,
    offset: 0,
    classes: {
        initial: "header",
        pinned: "dn",
        unpinned: "up"
    }
});
header.init();

if($('#bottom-bar').hasClass('bottom-post-bar')){
var bottomx = new Headroom(document.getElementById("bottom-bar"), {
    tolerance: 0,
    offset: 0,
    classes: {
        initial: "bottom-post-bar",
        pinned: "ok",
        unpinned: "ko"
    }
});
bottomx.init();
}
}

window.onresize = function(){
 $('#sidebar').removeClass('menus');
 $('#header').removeClass('menu'); $('#bug').removeClass('bugright');
 $('#bottom-bar').removeClass('bugright');
 $('#zhezhao').removeClass('zhezhao');
}

 ;(function() {
            // Initialize 
            var bLazy = new Blazy();
        })(); 


if(!document.getElementById("table-of-contents")){
GenerateContentList();}
window.main = {};
main.jiaohu = {};

main.jiaohu.menu = function(){
$('#sidebar').toggleClass('menus');
 $('#header').toggleClass('menu');
 $('#bug').toggleClass('bugright');
 $('#bottom-bar').toggleClass('bugright');
 $('#zhezhao').toggleClass('zhezhao');
}
main.jiaohu.sousuo = function(){
$('.js-toggle-search').toggleClass('is-active');
$('.js-search').toggleClass('is-visible');
}

main.jiaohu.close = function(){
 if($('.js-search').hasClass('is-visible')){
$('.js-toggle-search').toggleClass('is-active');
$('.js-search').toggleClass('is-visible');}
}

function getkey()
{
  var theEvent = window.event || arguments.callee.caller.arguments[0];
        var code = theEvent.keyCode;
        if(code == 13){    
$('#soux').get(0).click();
        }
}

main.load = function(){

$("input#mail").bind('input propertychange', function () {
  var _email = $(this).val();
  if (_email != '') {
  var ajaxurl = yoduml;
      ajaxurl = ajaxurl.replace('/usr/themes/Yodu','');
    $.ajax({
      type: 'GET',
      data: {
        action: 'ajax_avatar_get',  
        form: ajaxurl, // 修改为你的Ajax路径
        email: _email
      },
      success: function(data) {
        $('.visitor .avatar').attr('src', data); // 修改为你自己的头像标签
      }
    }); // end ajax
  }
  return false;
});
$("#lamu img").eq(0).click(function(){
$("html,body").animate({scrollTop :0}, 800);return false;
});
$("#leimu img").eq(0).click(function(){ 
$("html,body").animate({scrollTop : $(document).height()}, 800);return false;
});
$('.sjcd').click(main.jiaohu.menu);
$('#zhezhao').click(main.jiaohu.menu);
$('#sousuo').click(main.jiaohu.sousuo);
$('.search_close').click(main.jiaohu.close);


}
$(function(){main.load();});
addEventListener('popstate',function(){main.load();});