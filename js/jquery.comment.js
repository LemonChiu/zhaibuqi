/**
* jquery.comment.js
**/
$(function(){
    'use strict';
    var $arrowBox = $('<div></div>').addClass('arrow-box').append($('<div></div>').addClass('arrow')),
        $replyBtn = $('<span></span>').addClass('reply-btn').text('回复'),
        $postBox = $('#post-box'),
        $commentContent = $('.comment-content'),
        $commentForm = $('#comment-form'),
        $unfold = $('.unfold'),
        $tips = $('.tips');
    /*显示回复按钮*/
    $postBox.on('mouseenter','.user-post',function(){
        $(this).find('.reply-btn').fadeIn(200);
    });
    $postBox.on('mouseleave','.user-post',function(){
        $(this).find('.reply-btn').fadeOut(200);
    });
    /*按下回复按钮*/
    $postBox.on('click','.reply-btn',function(){
        var $userPost = $(this).parent(),
            replyeeName = '回复' + $userPost.find('.user-name').text() + ':',
            curPos = replyeeName.length;
        $commentContent.val(replyeeName);
        setSelectionRange($commentContent.get(0),curPos,curPos);
        //选择文字范围
        function setSelectionRange(input, selectionStart, selectionEnd){
            if(input.setSelectionRange){
                input.focus();
                input.setSelectionRange(selectionStart,selectionEnd);
            } else if(input.createTextRange){
                var range = input.createTextRange();
                range.collapse(true);
                range.moveEnd('character',selectionEnd);
                range.moveStart('character',selectionStart);
                range.select();
            }
        }
    });
    $commentContent.focus(function(){
        $tips.hide();
    });
    /*提交评论内容*/
    $commentForm.submit(function(event){
        var action = $commentForm.attr('action'),
            data = {},
            content = $commentContent.val().replace(/^\s*/,'');
        $tips.hide();
        if(content.match(/[^\s]/)){
            var reg = /^回复[^\s]+:/,
                replyee = content.match(reg),
                comment = content.replace(reg,'');
            if(replyee){
                data.replyee = replyee[0].substr(2,replyee[0].length-3);
                if(comment.match(/[^\s]/)){
                    data.comment = comment.replace(/^\s*/,'');
                }
            } else{
                data.comment = content;
            }
        }

        if(data.comment){
            $.ajax( {
                    url:action,
                    type:'POST',
                    data:data,
                    success:function(data){
                        $commentContent.val('');
                        addOneComment(data.comment[0]).appendTo($postBox);
                    },
                    error: function(){
                        $tips.text('评论失败，请重新提交').css('color','red').fadeIn().fadeOut().fadeIn();
                    }
                }
            );
        } else{
            $tips.text('评论内容不能为空').css('color','red').fadeIn().fadeOut().fadeIn();
        }
        event.preventDefault();
        event.stopPropagation();
    });

    /*展开评论*/
    $unfold.on('click',function(){
        var timer = setInterval(function(){
            var unfoldText = $unfold.text();
            switch (unfoldText.length){
                case 5:
                    $unfold.text('正在加载..');
                    break;
                case 6:
                    $unfold.text('正在加载...');
                    break;
                case 7:
                    $unfold.text('正在加载.');
                    break;
                default:
                    $unfold.text('正在加载.');
                    break;
            }
        },800);
        /*加载评论*/
        $.ajax({
            url:'json/comment.json',
            dataType:'json',
            type:'GET',
            success: function(data){
                var comment = data.comment,
                    $firstPost = $('.user-post:first');
                clearInterval(timer);
                $unfold.hide();
                if(comment.length !== 0){
                    $.each(comment,function(){
                        var $userPost = addOneComment(this).hide();
                        $userPost.insertAfter($firstPost);
                        $userPost.fadeIn(300);
                    });
                }
            },
            error: function(){
                clearInterval(timer);
                $unfold.text('加载失败，请再次点击重试');
            }
        });
    });
    /*添加一个评论*/
    function addOneComment(options){
        var user = options.userName,
            userLink = options.userLink,
            replyTime = options.replyTime,
            replyee= options.replyee,
            replyeeLink = options.replyeeLink,
            content = options.content,
            userPhoto = options.userPhoto,
            _$arrowBox = $arrowBox.clone(),
            _$replyBtn = $replyBtn.clone(),
            $userPost = $('<li></li>').addClass('user-post'),
            $photo = $('<a></a>').attr('href',userLink).append($('<img/>').attr('src',userPhoto).addClass('user-photo')),
            $replyDetail = $('<div></div>').addClass('reply-detail'),
            $commentHeader = $('<h3></h3>').addClass('comment-header'),
            $userName = $('<a></a>').addClass('user-name').text(user),
            $replyTime = $('<span></span>').addClass('reply-time').text(replyTime),
            $content = $('<p></p>').addClass('content'),
            $replyee;
        $commentHeader.append($userName,$replyTime,_$replyBtn);
        if(replyee){
            $replyee = $('<a></a>').addClass('replyee-name').text(replyee).attr('href',replyeeLink);
            $content.append('回复',$replyee,':'+content);
        } else{
            $content.append(content);
        }
        $replyDetail.append($commentHeader,$content);
        $userPost.append($photo,_$arrowBox,$replyDetail);
        return $userPost;
    }
});