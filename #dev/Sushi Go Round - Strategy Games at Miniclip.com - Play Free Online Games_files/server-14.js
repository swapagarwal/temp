/*!version:14.2.0*/
var cdx,cdxu;function cdxs(){this.b=10000;this.b1=40000;this.f=[];this.g=null;this.i=[];this.k2=this.k1()}cdxs.prototype.a=function(b){var a;if(null===b){return}a=cdx.reqs[b.r.z+"-"+b.r.c];a.e.push(b.p.i);this.a04(b);this.f.push(b);this.h()};cdxs.prototype.c00=function(){var a=this;return function(b){a.c01(b)}};cdxs.prototype.c01=function(b){var k,g=this.g,i=this.a0(),j,c,a,h=function(l){return parseInt(l,10)},f,e,d="";if(!g||!i){return}k=JSON.parse(b.data);if("undefined"===typeof k.source){if(h(k.m)!==i.t){return}}if((h(k.p.z)!==g.p.z)||(h(k.p.c)!==g.p.c)||(h(k.p.i)!==g.p.i)||(h(k.r.z)!==g.r.z)||(h(k.r.c)!==g.r.c)){return}clearTimeout(i.d);switch(k.s){case"l":i.b="loaded";return;case"e":i.b="error";this.a12();return}if(k.s!=="s"){return}if(i.c){return}if("undefined"===typeof k.source){e=0;if("undefined"!==typeof i.s){e=i.s}f=cdx.reqs[k.r.z+"-"+k.r.c];d+="request signature: "+f.a;d+="\ntid: "+f.tid;d+="\nprovider id: "+k.p.i;switch(k.m){case"1":d+="\ncold: "+(parseInt(k.connectEnd,10)-parseInt(k.domainLookupStart,10))+" ms";break;case"0":d+="\nrtt: "+(parseInt(k.responseStart,10)-parseInt(k.requestStart,10))+" ms";break;case"14":d+="\nthroughput: "+((e*1000)/(parseInt(k.responseStart,10)-parseInt(k.requestStart,10)))+" ms";break}j=[];j.push("f2");j.push(k.m);j.push(k.p.z);j.push(k.p.c);j.push(k.p.i);j.push(e);j.push(0);for(c=0;c<cdxs.o.length;c++){a=k[cdxs.o[c]];j.push(("undefined"===typeof a)?0:a);d+="\n"+cdxs.o[c]+": "+k[cdxs.o[c]]}j.push(f.a);j.push(k.h);this.i.push(j)}else{if("uni"===k.source){g.node_id=k.node_id}}this.a12()};cdxs.prototype.e=function(a){cdx.s.j(a)};cdxs.prototype.h=function(){if(this.g===null){if(0<this.f.length){this.g=this.f.pop();this.a12()}}};cdxs.prototype.a0=function(){var a;if(this.g){a=this.g;if("number"===typeof a.p.d){if(a.p.d<a.p.p.length){return a.p.p[a.p.d]}}}return null};cdxs.prototype.a01=function(){var a=this.g;this.g=null;this.h();if(a){this.j(a.r.z+"-"+a.r.c)}};cdxs.prototype.a03=function(){var h=window.performance,d=1,f,g=this.g,c=cdx.reqs[g.r.z+"-"+g.r.c],e,b,a;this.a03b();if("undefined"!==typeof h){if(h.timing){f=h.timing;d=0}}e=[];e.push("n1");e.push(d);for(b=0;b<cdxs.o.length;b++){if(f){a=this.i4(f[cdxs.o[b]]);e.push(a)}else{e.push(0)}}e.push(c.a);this.i.push(e);this.ac()};cdxs.prototype.a03b=function(){var j=window.performance||window.mozPerformance||window.msPerformance||window.webkitPerformance||{},a,h=function(){},e=this.g,d=cdx.reqs[e.r.z+"-"+e.r.c],b,f,k,g=[[[17,40,41],[19,42,43]],[[26,44,45],[33,46,47]]],c=0,l=0;if(1===e.m){c=1}if("https:"===window.location.protocol){l=1}if("undefined"!==typeof j.timing){a=j.timing;b=[{t:g[c][l][0],i:a.loadEventEnd-a.fetchStart},{t:g[c][l][1],i:a.responseEnd-a.responseStart},{t:g[c][l][2],i:a.loadEventEnd-a.responseEnd}];for(f=0;f<b.length;f++){k=b[f];if(12000>k.i){this.i.push(["f1",d.a,d.z,d.c,e.p.i,k.t,0,k.i])}}}};cdxs.prototype.a04=function(f){var b,a,d,e,c;b={88:{v1:101684,v2:102376},246:{v1:145993,v2:156228},243:{v1:145993,v2:156228},244:{v1:145993,v2:156228},248:{v1:145993,v2:156228},245:{v1:145993,v2:156228},247:{v1:145993,v2:156228},220:{v1:145993,v2:156228},351:{v1:145993,v2:156228}};if(b.hasOwnProperty(f.p.i)){a=f.p.p;for(d=0;d<a.length;d++){e=a[d];if(cdxs.a(cdxs.p,e.t)){if(b[f.p.i].hasOwnProperty(e.a)){c=b[f.p.i][e.a];e.s=Math.floor(c/1024)}}}}};cdxs.prototype.a1=function(c){var j=document,i=this.g,b=j.getElementById("cdx"),d=j.createElement("iframe"),a,g=this.g,f=cdx.reqs[g.r.z+"-"+g.r.c],h=this.b,e=this.d2();if(false===g.p.b){e="none"}c.b="loading";c.c=false;if(cdxs.a(cdxs.p,c.t)){if((0===g.p.z)&&(0===g.p.c)){f.h++}else{f.i++}h=this.b1}a=c.u+"?rnd="+c.t+"-"+i.p.z+"-"+i.p.c+"-"+i.r.z+"-"+i.r.c+"-"+i.p.i+"-bAz2aJxxPeO7-72-"+e;d.src=a;d.style.display="none";c.d=setTimeout(this.a20(c),h);b.appendChild(d);this.d3()};cdxs.prototype.a12=function(){var a=cdx.s.g,b;if(!a){this.a01()}else{if("pageload"===a.a){this.a03()}else{if("probe"===a.a){if("undefined"===typeof a.p.d){a.p.d=0}else{a.p.d++}b=this.a0();if(b){switch(b.a){case"v1":this.d01(b);break;case"v2":this.a1(b);break;case"custom-page":this.a30(b);break;case"custom-js":this.a31(b);break;case"custom-img":this.a32(b);break;case"uni":if(this.k2){this.a33(b)}else{this.a12()}break;default:return}}else{this.ac()}}}}};cdxs.prototype.a20=function(b){var a=this;return function(){a.a21(b)}};cdxs.prototype.a21=function(a){var b=this.a0();if(b===a){a.b="timeout";a.c=true;this.i5(a)}};cdxs.prototype.a22=function(b){var a=this;return function(){a.a23(b)}};cdxs.prototype.a23=function(a){var b=this.a0();if(b===a){a.b="timeout";a.c=true;this.ac()}};cdxs.prototype.a30=function(e){var g=document,b=g.getElementById("cdx"),h=g.createElement("iframe"),a=this.g,d=cdx.reqs[a.r.z+"-"+a.r.c],f,c=e.u;f=a.p.z+"-"+a.p.c+"-"+a.p.i+"-"+this.d2();if(false!==a.p.b){if(0>c.indexOf("?",0)){c+="?rnd="+f}else{c+="&rnd="+f}}h.src=c;h.style.display="none";e.b="loading";e.c=false;h.onload=this.a40(d,a,e);e.d=setTimeout(this.a41(d,a,e),this.b);e.e=this.i1();b.appendChild(h);this.d3()};cdxs.prototype.a31=function(f){var h=document,b=h.getElementById("cdx"),c=h.createElement("script"),a=this.g,e=cdx.reqs[a.r.z+"-"+a.r.c],g,d=f.u;g=a.p.z+"-"+a.p.c+"-"+a.p.i+"-"+this.d2();if(false!==a.p.b){if(0>d.indexOf("?",0)){d+="?rnd="+g}else{d+="&rnd="+g}}c.src=d;c.onload=this.a40(e,a,f);f.d=setTimeout(this.a41(e,a,f),this.b);f.e=this.i1();b.appendChild(c)};cdxs.prototype.a32=function(e){var h=document,b=h.createElement("img"),a=this.g,d=cdx.reqs[a.r.z+"-"+a.r.c],g,c=e.u,f=this.b;g=a.p.z+"-"+a.p.c+"-"+a.p.i+"-"+this.d2();if(false!==a.p.b){if(0>c.indexOf("?",0)){c+="?rnd="+g}else{c+="&rnd="+g}}if(cdxs.a(cdxs.p,e.t)){f=this.b1}b.onload=this.a40(d,a,e);e.d=setTimeout(this.a41(d,a,e),f);e.e=this.i1();b.src=c};cdxs.prototype.a33=function(e){var f=document,b=f.getElementById("cdx"),h=f.createElement("iframe"),g=this.g,a=this.g,d=cdx.reqs[a.r.z+"-"+a.r.c],c;e.b="loading";e.c=false;c=e.u+"?rnd="+g.r.z+"-"+g.r.c+"-"+g.p.z+"-"+g.p.c+"-"+g.p.i+"-"+this.d2();h.src=c;h.style.display="none";e.d=setTimeout(this.a22(e),this.b);b.appendChild(h);this.d3()};cdxs.prototype.a40=function(a,d,c){var b=this;return function(){var e,f;clearTimeout(c.d);if(d===b.g){e=b.i1()-c.e;f=[];f.push("f1");f.push(a.a);f.push(d.p.z);f.push(d.p.c);f.push(d.p.i);f.push(c.t);f.push(0);if(cdxs.a(cdxs.p,c.t)){f.push(b.i2(e,c.s))}else{f.push(e)}b.i.push(f);b.a12()}}};cdxs.prototype.a41=function(a,d,c){var b=this;return function(){var e;if(d===cdx.s.g){c.b="timeout";c.c=true;e=[];e.push("f1");e.push(a.a);e.push(d.p.z);e.push(d.p.c);e.push(d.p.i);e.push(c.t);e.push(1);e.push(0);b.i.push(e);b.a12()}}};cdxs.prototype.ac=function(){var e,g=document,b=g.getElementById("cdx"),f,a,k,d,h,c="0",j;if(!this.k2){c="1"}else{if(undefined!==this.g.node_id){c=this.g.node_id}}while(0<this.i.length){e=this.i.shift();j=e[0];f=g.createElement("script");a="//report.init.cedexis-radar.net";k="";for(d=0;d<e.length;d++){h=e[d];k+="/"+h}switch(j){case"f1":case"f2":k+="/"+c;break}a+=k;f.src=a;b.appendChild(f)}setTimeout((function(i){return function(){i.a01()}}(this)),2000)};cdxs.prototype.al=function(e){var b,c,d=[],a=this.g;c=cdx.reqs[a.r.z+"-"+a.r.c];d.push("f1");d.push(c.a);d.push(a.p.z);d.push(a.p.c);d.push(a.p.i);d.push(e.t);if(!e.c&&radar.stoppedAt){b=radar.stoppedAt.getTime()-e.e;d.push(0);if(cdxs.a(cdxs.p,e.t)){d.push(this.i2(b,e.s))}else{d.push(b)}}else{d.push(1);d.push(0)}this.i.push(d);this.a12()};cdxs.prototype.d=function(d){var i=document,h=i.createElement("script"),b=i.getElementById("cdx"),g=this.d1("14.2.0"),c=(location.protocol==="https:")?"s":"i",e,a,f=this.i0();e="i1-js-"+g+"-"+this.i3(d.z.toString(10),"0",2)+"-"+this.i3(d.c.toString(10),"0",5)+"-"+d.tid+"-"+c;a="//"+e+".init.cedexis-radar.net/i1/"+f+"/"+d.tid+"/jsonp?seed="+e;h.type="text/javascript";h.src=a;b.appendChild(h)};cdxs.prototype.d1=function(a){var d=a.indexOf("."),c=a.lastIndexOf("."),b=a;if(d!==c){b=a.substring(0,c)}return b.replace(".","-")};cdxs.prototype.d2=function(){var d="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",b=32,c,a=[];for(c=0;c<b;c++){a.push(d.charAt(this.e01(0,d.length-1)))}return a.join("")};cdxs.prototype.d3=(function(){var a=document.createElement("iframe");a.style.display="none";return function(){var b=document.body;b.appendChild(a);b.removeChild(a)}}());cdxs.prototype.d01=function(c){var i=document,b=i.getElementById("cdx"),h=i.createElement("script"),a,f=this.g,d,e=cdx.reqs[f.r.z+"-"+f.r.c],g=this.b;a=c.u;if(cdxs.a(cdxs.p,c.t)){if((0===f.p.z)&&(0===f.p.c)){e.h++}else{e.i++}g=this.b1}if(false!==f.p.b){d=f.p.z+"-"+f.p.c+"-"+f.p.i+"-"+this.d2();if(0>a.indexOf("?",0)){a+="?rnd="+d}else{a+="&rnd="+d}}h.src=a;h.type="text/javascript";if("undefined"!==typeof h.onreadystatechange){h.onreadystatechange=this.d04(c)}else{h.onload=this.d02(c)}h.onerror=this.d05(c);c.c=false;c.d=setTimeout(this.d03(c),g);c.e=this.i1();radar.stoppedAt=null;b.appendChild(h)};cdxs.prototype.d02=function(b){var a=this;return function(){var c=a.a0();if(b===c){clearTimeout(b.d);a.al(b)}}};cdxs.prototype.d03=function(b){var a=this;return function(){b.c=true;a.al(b)}};cdxs.prototype.d04=function(c){var a=false,b=this;return function(){var d;if(!a){if(("loaded"===this.readyState)||("complete"===this.readyState)){a=true;d=b.a0();if(c===d){if(!c.c){clearTimeout(c.d);b.al(c)}}}}}};cdxs.prototype.d05=function(b){var a=this;return function(){var c=a.a0();if(b===c){b.c=true;clearTimeout(b.d);a.al(b)}}};cdxs.prototype.e01=function(b,a){return Math.floor(Math.random()*(a-b+1))+b};cdxs.prototype.i0=function(){return String(Math.round(this.i1()/1000))};cdxs.prototype.i1=function(){return(new Date()).getTime()};cdxs.prototype.i2=function(b,a){return Math.floor(8*1000*a/b)};cdxs.prototype.i3=function(b,d,c){var a=b;while(c>a.length){a=d+a}return a};cdxs.prototype.i4=function(a){if("undefined"===typeof a){return"0"}return a};cdxs.prototype.i5=function(f){var e=[],d,b,a=this.g,c=cdx.reqs[a.r.z+"-"+a.r.c];e.push("f2");e.push(f.t);e.push(a.p.z);e.push(a.p.c);e.push(a.p.i);e.push(0);e.push(1);for(d=0;d<21;d++){b=0;e.push(b)}e.push(c.a);e.push(0);this.i.push(e);this.a12()};cdxs.prototype.j=function(c){var d=document,b=cdx.reqs[c],a=d.createElement("script"),e;a.type="text/javascript";e="//probes.cedexis.com/?z="+b.z+"&c="+b.c+"&n="+(this.k(window)?"1":"0");if(0<b.e.length){e+="&i="+b.e.join(",")}if(0<b.h){e+="&t="+b.h}if(0<b.i){e+="&u="+b.i}e+="&sig="+b.a;a.src=e;d.getElementById("cdx").appendChild(a)};cdxs.prototype.k=function(a){var c=a.performance,b=document;if("function"!==typeof a.postMessage){return false}if("undefined"!==typeof b.documentMode){if(9>b.documentMode){return false}}if("BackCompat"===b.compatMode){return false}if("undefined"!==typeof c){if("undefined"!==typeof c.timing){return true}}return false};cdxs.prototype.k1=function(){var a,b;if("function"!==typeof window.postMessage){return false}b=[/chrome/i];for(a=0;a<b.length;a++){if(b[a].test(navigator.userAgent)){return false}}return true};cdxs.a=function(c,b){var a;for(a=0;a<c.length;a++){if(b===c[a]){return true}}return false};cdxs.o=["navigationStart","unloadEventStart","unloadEventEnd","redirectStart","redirectEnd","fetchStart","domainLookupStart","domainLookupEnd","connectStart","connectEnd","secureConnectionStart","requestStart","responseStart","responseEnd","domLoading","domInteractive","domContentLoadedEventStart","domContentLoadedEventEnd","domComplete","loadEventStart","loadEventEnd"];cdxs.p=[14,15,23,30];(function(){if(cdx&&("undefined"===typeof cdx.s)&&("undefined"===typeof cdxu)){cdx.s=new cdxs();if(window.addEventListener){window.addEventListener("message",cdx.s.c00(),false)}window.radar={}}}());