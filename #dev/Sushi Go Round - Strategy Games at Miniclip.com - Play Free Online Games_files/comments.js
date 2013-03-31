var Comments={per_page:5,current_page:1,channel_id:1,object_id:0,user_id:0,is_adding:0,id_prefix:"#game-comment-",comment_box:"#comment-contents",comment_list_container:"#game-comment-list",comment_nav_container:"#game-comment-nav",init:function(b,a){this.user_id=a;this.object_id=b;this.getComments(this.current_page);wlchat.dictionary.terms["!"]=["!"];wlchat.dictionary.terms["?"]=["?"];wlchat.dictionary.terms["."]=["."];wlchat.dictionary.terms[","]=[","];wlchat.dictionary.terms[":"]=[":"];wlchat.dictionary.terms["!!"]=["!!"];wlchat.dictionary.terms["??"]=["??"];wlchat.dictionary.terms[":-"]=[":-)",":-(",":-/",":-P",":-D",":->"];wlchat.dictionary.terms[":)"]=[":)"];wlchat.dictionary.terms[":("]=[":("];wlchat.dictionary.terms[":P"]=[":P"];wlchat.dictionary.terms[":D"]=[":D"];wlchat.dictionary.terms[";-"]=[";-)"];wlchat.dictionary.terms[";)"]=[";)"];wlchat.dictionary.terms["x-"].push("x-)");$(this.comment_box).smartTextBox({separator:" ",submitKeys:[32,13],submitChars:[" "],autocomplete:true,fullSearch:false,autocompleteValues:wlchat.dictionary.terms,onlyAutocomplete:false,uniqueValues:false,caseSensitive:true,highlight:false,onElementAdd:function(d,c){},onElementRemove:function(d,c){},onElementFocus:function(d,c){}});$("#post-game-comments").click(function(c){Comments.addCommentOnclickEvent(c);c.stopPropagation();c.preventDefault()})},getComments:function(a){this.current_page=a;$.ajax({type:"POST",dataType:"json",url:"/games/ajax/getcomments/",async:true,data:{object_id:this.object_id,channel_id:this.channel_id,per_page:this.per_page,current_page:this.current_page},success:function(b){if(b.success){$(Comments.comment_list_container).html("");$.each(b.result.comments,function(c,d){Comments.generateCommentRow(d)});$(".report-button").click(function(d){var c=$(this).attr("id").replace(Comments.id_prefix+"-report-","").split("-");Comments.reportComment(c[0],c[1]);d.stopPropagation();d.preventDefault()});Comments.generateCommentPages(b.result.count)}else{$(Comments.comment_list_container).html('<li class="no-comment"><p class="notification-bar information">'+translate.no_comments+"</p></li>")}},error:function(d,b,c){}})},generateCommentRow:function(b){var a="block";if(b.report){a="none"}$(this.comment_list_container).append('<li class="clear"><a class="avatar" href="/players/en/card/?uid='+b.post_user_id+'"><img src="/players/en/resize.php?w=40&h=40&uid='+b.post_user_id+'" width="40" height="40" alt="'+b.username+'" title="'+b.username+' Avatar" /></a><p><a class="author" href="/players/en/card/?uid='+b.post_user_id+'">'+b.username+"</a>"+b.contents+'</p><p style="display:'+a+';" class="options"><a href="#" id="'+Comments.id_prefix+"-report-"+b.thread_id+"-"+b.post_id+'" class="report-button">'+translate.report+"</a></p></li>")},generateCommentPages:function(d){$(this.comment_nav_container).html("");if(d>this.per_page){$(this.comment_nav_container).css("display","block");var a=Math.ceil(d/this.per_page);var c="";this.current_page=parseInt(this.current_page);c=c+'<span class="left-arrow-pager">«</span>';var b=this.current_page*this.per_page;if(this.current_page*this.per_page>d){b=d}c=c+"<b>"+this.current_page+"</b> of "+a;c=c+'<span class="right-arrow-pager">&raquo;</span>';$(this.comment_nav_container).html(c);$(".left-arrow-pager").click(function(e){if(Comments.current_page>1){Comments.current_page=Comments.current_page-1;Comments.getComments(Comments.current_page)}e.stopPropagation();e.preventDefault()});$(".right-arrow-pager").click(function(e){if(a!=Comments.current_page){Comments.current_page=Comments.current_page+1;Comments.getComments(Comments.current_page)}e.stopPropagation();e.preventDefault()})}else{$(this.comment_nav_container).css("display","none")}},likeComment:function(b){var a=$(this).attr("id").replace(this.id_prefix+"-like-","").split("-");$.ajax({type:"POST",dataType:"json",url:"/games/ajax/likecomment/",async:true,data:{thread_id:a[0],post_id:a[1]},success:function(c){if(c.success){if(c.result){Comments.getComments(Comments.current_page)}else{alert(translate.comment_like_failed)}}else{alert(c.msg)}},error:function(e,c,d){}});b.stopPropagation();b.preventDefault()},reportComment:function(b,a){$.ajax({type:"POST",dataType:"json",url:"/games/ajax/reportcomment/",async:true,data:{thread_id:b,post_id:a},success:function(c){if(c.success){if(c.result){Comments.getComments(Comments.current_page)}else{alert(translate.comment_reporting_failed)}}else{alert(c.msg)}},error:function(e,c,d){}})},addCommentOnclickEvent:function(b){var d=$(".smartTextBox-input-elem-valueInput").length;var a=$(".smartTextBox-input-elem-valueInput");var f=a[d-1].value;var e=a[d-1].value;var c=f.substr(f.length-1,1);if(f.length>1&&(c=="."||c==","||c=="?"||c=="!"||c==":")){f=f.substr(0,f.length-1)}if(f.length>0&&$.inArray(f,wlchat.dictionary.terms[f.substr(0,2)])!=-1){a[d-1].value="";$(this.comment_box).smartTextBox("add",e)}d=$(".smartTextBox-input-elem-valueInput").length;a=$(".smartTextBox-input-elem-valueInput");f=a[d-1].value;e=a[d-1].value;c=f.substr(f.length-1,1);if(f.length>1&&(c=="."||c==","||c=="?"||c=="!"||c==":")){f=f.substr(0,f.length-1)}if(!$(this.comment_box).val()||f.length>0){if(f.length>0){alert(translate.the_word_is_not_allowed.replace("%s",escape(f)))}b.stopPropagation();b.preventDefault()}else{this.addCommentEvent(b)}},addCommentEvent:function(b){var c=$(this.comment_box).val();var a={type:"POST",dataType:"json",async:true,url:"/games/ajax/addcomment/",data:{object_id:this.object_id,channel_id:this.channel_id,contents:c},success:function(e){$("#comment-form").fadeOut("fast");setTimeout(function(){$("#comment-form").fadeIn("fast")},30000);Comments.clearCommentText();if(e.success){$(".smartTextBox-input-elem-valueInput").blur();Comments.getComments(1)}else{$(Comments.comment_box).smartTextBox("add",c);if(e.msg.indexOf("There are blacklisted words")!=-1){Comments.makeBadWordsRed();alert(translate.remove_red_messages)}else{if(e.msg.indexOf("You are not currently logged")!=-1){alert(e.msg)}else{if(e.msg.indexOf("User is banned")!=-1){var d=e.msg.split("|");alert("Sorry, it seems that you have been banned from doing this. Reason for banning: "+d[1]+"\nBan ends in: "+d[2])}else{alert("Sorry, it seems an error has occurred. Please try again later.")}}}}Comments.is_adding=0},error:function(d,f,e){Comments.clearCommentText();$(Comments.comment_box).smartTextBox("add",c);alert("An error occurred, please try again.");Comments.is_adding=0}};if($(Comments.comment_box).val().length<=160&&Comments.is_adding==0){Comments.clearCommentText();$(Comments.comment_box).smartTextBox("add","Posting comment . . .");$(".smartTextBox-input-elem-valueInput").blur();$.ajax(a);Comments.is_adding=1}b.stopPropagation();b.preventDefault()},clearCommentText:function(){$(this.comment_box).smartTextBox("clear")},makeBadWordsRed:function(){var b=[];var a=[];$(".smartTextBox-elem-valueContainer").each(function(){elem2=$(this);a.push(elem2);b.push(elem2.text().toLowerCase());elem2.removeClass("bad-comment")});var c=b.join(" ");if(b.length>=1){$.each(wlchat.dictionary.badterms,function(d,e){black_array=e.split(" ");if(c.indexOf(e)!=-1){$.each(b,function(f,h){if(h==e){a[f].addClass("bad-comment")}var i=[];if(h==black_array[0]){for(var g=0;g<black_array.length;g++){if(black_array[g]==b[f+g]){i.push(f+g)}}}if(i.length>1&&i.length==black_array.length){$.each(i,function(j,l){a[l].addClass("bad-comment")})}})}})}}};$(document).ready(function(){Comments.init(object_id,user_id)});