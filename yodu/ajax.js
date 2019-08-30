function ajaxc() {

var
   txt_1  = '必须填写用户名',
   txt_2  = '必须填写电子邮箱地址',
   txt_3  = '邮箱地址不合法',
   txt_4  = '必须填写评论内容';
   $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
var
   comments_order = 'DESC',
   comment_list   = '.comment-list',
   comments       = '.comment-num',
   comment_reply  = '.comment-reply',
   comment_form   = '#comment-form',
   respond        = '#comments',
   textarea       = '#textarea',
   submit_btn     = '.submit',
   new_id = '', parent_id = '';


 click_bind();
    

    $(comment_form).submit(function() { // 提交


       /* 预检 */
        if ($(comment_form).find('#author')[0]) {

            if ($(comment_form).find('#author').val() == '') {
                notyf.alert(txt_1);
                return false;
            }

            if ($(comment_form).find('#mail').val() == '') {
                notyf.alert(txt_2);
                return false;
            }

            var filter = /^[^@\s<&>]+@([a-z0-9-]+\.)+[a-z]{2,5}$/i;
            if (!filter.test($(comment_form).find('#mail').val())) {
                notyf.alert(txt_3);
                return false;
            }
        }
        var textValue = $(comment_form).find(textarea).html().replace(/(^\s*)|(\s*$)/g, "");//检查空格信息
        var textValuex = $(comment_form).find(textarea).val().replace(/(^\s*)|(\s*$)/g, "");//检查空格信息


        if (textValue == null || textValue == "") {if(textValuex == null || textValuex == ""){
            notyf.alert(txt_4);
            return false;
        }}
        $(submit_btn).addClass("active");
$('#loadxiaoshi').fadeOut("fast");
$('#loading').fadeIn("fast");
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serializeArray(),async: false,
            error: function() {
                notyf.alert("提交失败，请重试！");
                return false;
            },
            success: function(data) { //成功取到数据
                //console.log(data);
                $(submit_btn).removeClass("active");
$('#loading').fadeOut('fast');$('#loadxiaoshi').fadeIn('fast');

                try {
                    if (!$(comment_list, data).length) {
                        notyf.alert("提交失败,评论过快或者内容被定义为垃圾(内容不含有中文就可能判断为垃圾)！也有可能是你的IP被博主屏蔽了");
                        return false;
                    } else {
                        new_id = $(comment_list, data).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function(a, b) {
                            return a - b
                        }).pop(); // TODO：找新 id，如果在第二页评论的话，找到的ID是有问题的！

                        if ($('.page-navigator .prev').length && parent_id == ""){
                            new_id = '';
var dd=$(".prev a").attr("href");//获取上页地址
$(".prev a").attr("href",""); //将地址清空
dd=dd.replace(/comment-page-(.*?)#comments/, "comment-page-1#comments");//将获取的地址页码改为1
$(".prev a").attr("href",dd); //将地址放回去
$('.prev a').get(0).click(); //点击这个超链接
                        }//判断当前评论列表是否在第一页,并且只会在母评论时候才会生效

            //console.log("new id " + new_id);
                        //插入评论内容到当前页面
                        if (parent_id) {
                            data = $('#li-comment-' + new_id, data).hide(); // 取新评论
                            if ($('#' + parent_id).find(".comment-children").length <= 0) {
                                $('#' + parent_id).append("<div class='comment-children'><ol class='comment-list'></ol></div>");
                            }
                            if (new_id)//new_id不为空的时候才会插入
                                $('#' + parent_id + " .comment-children .comment-list").prepend(data);
                            //console.log('该评论为子评论,parent_id:' + parent_id);
                            parent_id = '';
                            //console.log(data);
                        } else {
                            data = $('#li-comment-' + new_id, data).hide(); // 取新评论
                            //console.log('该评论为母评论');
                            if (!$(comment_list).length) //如果一条评论也没有的话
                                $(respond).append('<div class="info-com">仅有<span class="comment-num">0<\/span>条评论<\/div><ol class="comment-list"><\/ol>'); // 加 ol
                            $(comment_list).prepend(data);
                            //console.log('评论内容:');
                            //console.log(data);
                        }
                        $('#li-comment-' + new_id).fadeIn(); // 显示
                        var num;
                        $(comments).length ? (num = parseInt($(comments).text().match(/\d+/)), $(comments).html($(comments).html().replace(num, num + 1))) : 0;
                        //console.log($('#comments h4').length);
                        // 评论数加一
                        TypechoComment.cancelReply();
                        $(textarea).html('');$(textarea).val('');
                        $(comment_reply + ' a, #cancel-comment-reply-link').unbind('click');
                        click_bind(); // 新评论绑定
                        if (new_id){
                            $body.animate({scrollTop: $('#li-comment-' + new_id).offset().top - 50}, 500);
                        }else{
                            $body.animate({scrollTop: $('#comments').offset().top - 50}, 500);
                        }
                    }
                } catch(e) {
                    //alert('评论ajax错误!请截图并联系主题制作者！\n\n' + e);
                    window.location.reload();
                }
            } // end success()
        }); // end ajax()
        return false;
    }); // end $(comment_form).submit()
    function click_bind() { // 绑定
        $(comment_reply + ' a').click(function() { // 回复
            //$body.animate({scrollTop: $(respond).offset().top - 180}, 400);
            //console.log('xxxx'+$(this).parent().parent().parent().parent().parent().parent().attr("id"));
            parent_id = $(this).parent().parent().parent().parent().parent().parent().attr("id");
            //console.log("parent_id:" + parent_id);
            $(textarea).focus();
        });
        $('#cancel-comment-reply-link').click(function() { // 取消
            parent_id = '';
        });
    }

}
ajaxc();