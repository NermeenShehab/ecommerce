"use strict";!function(o){o.bind("preview-ready",function(){var f=document,p=window,b=document.getElementById.bind(document);o.selectiveRefresh.bind("partial-content-rendered",function(s){switch(s.partial.params.selector){case"#to-top-wrap":var e=b("to-top");e&&(e.addEventListener("click",function(s){s.preventDefault(),p.scroll({top:0,left:0,behavior:"smooth"})}),p.addEventListener("scroll",function(s){60<p.pageYOffset?e.classList.add("visible"):e.classList.remove("visible")}),p.dispatchEvent(new Event("scroll")));break;case"#top-wrap":b("header-affix-wrap")&&(c=b("header"),a=(o=c).offsetTop,r=o.id,n=f.getElementById("header-absolute-wrap"),c=o.getAttribute("data-bg"),d=[],(l="header"===r&&n&&c&&o.classList.contains("transparent"))&&(d=c.split(" ")),p.onscroll=function(s){p.pageYOffset>=a?o.classList.contains("affix")||(l&&t(o,d,!0),o.classList.add("affix")):o.classList.contains("affix")&&(l&&t(o,d,!1),o.classList.remove("affix")),0===p.pageYOffset&&o.classList.contains("affix")&&(l&&t(o,d,!1),o.classList.remove("affix")),this.oldScroll>this.scrollY?(o.classList.add("scrolling-up"),o.classList.remove("scrolling-down")):(o.classList.remove("scrolling-up"),o.classList.add("scrolling-down")),this.oldScroll=this.scrollY}),p.dispatchEvent(new Event("scroll"));break;case"#preloader-wrap":var i=b("preloader");i&&setTimeout(function(){i.classList.add("loaded")},1500);break;case"head":jQuery("body").animate({opacity:1},1e3)}function t(e,s,i){i?e.classList.contains("affix")||(e.classList.remove("i"),s.forEach(function(s){e.classList.add(s)})):e.classList.contains("affix")&&(s.forEach(function(s){e.classList.remove(s)}),e.classList.add("i"))}var o,a,r,n,c,d,l});[{controlId:"blog_single_sidebar_position",view:"post"},{controlId:"blog_sidebar_position",view:"archive"},{controlId:"search_sidebar_position",view:"search"},{controlId:"shop_sidebar_position",view:"shop"},{controlId:"product_sidebar_position",view:"product"},{controlId:"bbpress_sidebar_position",view:"bbpress"},{controlId:"buddypress_sidebar_position",view:"buddypress"},{controlId:"events_sidebar_position",view:"events"},{controlId:"event_sidebar_position",view:"event"},{controlId:"wpjm_sidebar_position",view:"wpjm"}].forEach(function(s,e){var i,t;i=s.controlId,t=s.view,o(i,function(s){s.bind(function(s){if(t===p.exsPreviewObject.viewGlobal)switch(f.body.classList.remove("with-sidebar","sidebar-left"),s){case"left":f.body.classList.add("with-sidebar","sidebar-left");break;case"right":f.body.classList.add("with-sidebar")}})})})})}(wp.customize);