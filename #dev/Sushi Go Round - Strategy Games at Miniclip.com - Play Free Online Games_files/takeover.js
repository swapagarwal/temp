var takeover_current={};var takeover_active=false;function do_takeover(){if(typeof(takeover.background_image)=="undefined"){return}takeover_active=true;takeover_current=takeover;var d=[0,90,136,170];if(takeover.header_height==undefined||takeover.header_height>=d.length||takeover.header_height<0){takeover.header_height=2}if(takeover.header_height>=1){$("body").addClass("use-takeover")}if(takeover.background_color==undefined){takeover.background_color=[""]}if(typeof(takeover.background_color)=="string"){takeover.background_color=[takeover.background_color]}if(takeover.background_image==undefined){takeover.background_image=[""]}if(typeof(takeover.background_image)=="string"){takeover.background_image=[takeover.background_image]}if(typeof(takeover.hide_leaderboard)=="undefined"){takeover.hide_leaderboard=true}if(!takeover.mpu_click_url&&takeover.click_url){takeover.mpu_click_url=takeover.click_url}if(takeover.internal==undefined){takeover.internal=false}if(takeover.mpu_swf!=undefined&&takeover.mpu_swf!=""){if(takeover.mpu_click_url){takeover.mpu_swf=takeover.mpu_swf+"?clickTag="+encodeURIComponent(takeover.mpu_click_url.replace("[timestamp]",ord))}var c=$('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" id="Ad_that_changes_background_AS1" width="300" height="250" align="middle"><param name="allowScriptAccess" value="always" /><param name="movie" value="'+takeover.mpu_swf+'" /><param name="quality" value="high" /><embed src="'+takeover.mpu_swf+'" quality="high" width="300" height="250" swLiveConnect=true id="Ad_that_changes_background_AS1" name="Ad_that_changes_background_AS1" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');if($(".promo-unit .container-300x250")!=null){$(".promo-unit .container-300x250").html(c)}else{document.write(c)}}$("#site-container").css({"padding-top":d[takeover.header_height],"background-color":takeover_color(takeover.background_color[0]),"background-image":takeover_image("url("+takeover.background_image[0]+")"),"background-position":"top center","border-bottom":"1px solid "+takeover_color(takeover.background_color[0]),"background-repeat":"no-repeat"});if(takeover.footer_image!=undefined){var f=$('<div style="padding:0 0 20px 0; text-align:center;"><image src="'+takeover.footer_image+'" /></div>');$("#container").after(f)}if(takeover.click_url){var e="_blank";if(takeover.internal){e="_self"}var b=$('<a href="'+takeover.click_url+'" target="'+e+'" class="takeover">&nbsp;</a>').css({width:"1010px",height:d[takeover.header_height]+"px",display:"block",position:"absolute",top:0,left:"50%","margin-left":"-505px"});b.click(function(){takeover_stats("/click-header/");return true});$("#container").before(b)}if(takeover.hide_leaderboard){$("#promo-mast").remove()}else{$("#promo-mast").css({"background-color":"transparent"});var a=d[takeover.header_height]-$("#promo-mast").outerHeight();if(a<0){a=0}$("#site-container").css({"padding-top":a+"px"})}takeover_stats();if(takeover.track_url!=undefined){takeover_click_track(takeover.track_url)}takeover={}}function takeover_color(a){if(a.indexOf("#")==-1){a="#"+a}return a}function takeover_image(a){return a}function takeover_ad_string(a){if(a!=undefined){return a.toLowerCase().replace(" ","-")}else{return"none"}}function takeover_stats(a){takeover_current.agency=takeover_ad_string(takeover_current.agency);takeover_current.client=takeover_ad_string(takeover_current.client);takeover_current.campaign=takeover_ad_string(takeover_current.campaign);if(a==undefined){a=""}var b="/advertising/takeovers/"+encodeURI(takeover_current.agency)+"/"+encodeURI(takeover_current.client)+"/"+encodeURI(takeover_current.campaign)+a;if(b.charAt(b.length-1)!=="/"){b=b+"/"}statTracker(b)}function takeover_click_track(b){if(b!=undefined){b=b.replace("[timestamp]",ord);var a=new Image();a.src=b}}var isInternetExplorer=navigator.appName.indexOf("Microsoft")!=-1;function Ad_that_changes_background_AS1_DoFSCommand(e,b){var c=isInternetExplorer?document.all.Ad_that_changes_background_AS1:document.Ad_that_changes_background_AS1;var d="";if(takeover_current.background_image[b]!=undefined){d=takeover_current.background_image[b]}var a="";if(takeover_current.background_color[b]!=undefined){a=takeover_current.background_color[b]}takeover_stats("/swapBackground/"+b);jQuery("#site-container").css({"background-image":takeover_image("url("+d+")"),"border-bottom":"1px solid "+takeover_color(a),"background-color":takeover_color(a)})}if(navigator.appName&&navigator.appName.indexOf("Microsoft")!=-1&&navigator.userAgent.indexOf("Windows")!=-1&&navigator.userAgent.indexOf("Windows 3.1")==-1){document.write('<script type="text/javascript" event="FSCommand(command,args)" for="Ad_that_changes_background_AS1">\n');document.write("      Ad_that_changes_background_AS1_DoFSCommand(command, args);\n");document.write("<\/script>\n")};