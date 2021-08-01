"use strict";!function(x,E,k){function c(e,t,o,a,s){t.classList.add(o),a.classList.add(s),e.setAttribute("aria-expanded","true"),"search_toggle"===e.id&&k("search_dropdown").children[0].children[0].focus(),"message_top_toggle"!==e.id&&"message_bottom_toggle"!==e.id||(a=e.getAttribute("data-id"),(s=new Date).setTime(s.getTime()+31536e6),s="expires="+s.toUTCString(),x.cookie=a+"=1;"+s+";path=/",e.parentNode.remove())}function d(e,t,o,a,s){t.classList.remove(o),a.classList.remove(s),e.setAttribute("aria-expanded","false")}function l(e,t){return-1!==e.className.indexOf(t)}function D(a,s,n,i,r){i.addEventListener("click",function(e){var t=k(s),o=k(a);t&&o&&(e.target.id!==s&&!e.target.closest("#"+s)||(l(o,n)?d:c)(t,o,n,i,r),l(o,n)&&e.target.id!==s&&e.target.closest("#"+s)!==t&&!e.target.closest("#"+a)&&d(t,o,n,i,r))}),"message_top_toggle"!==s&&"message_bottom_toggle"!==s&&E.addEventListener("scroll",function(e){var t=k(s),o=k(a);t&&o&&l(o,n)&&d(t,o,n,i,r)})}function S(){x.body.dispatchEvent(new Event("click"))}function A(e,t){e=e.offsetHeight;t.style.minHeight=e+"px"}x.addEventListener("DOMContentLoaded",function(e){var i=x.body;D("nav_top","nav_toggle","active",i,"top-menu-active"),D("nav_side","nav_side_toggle","active",i,"side-menu-active"),D("search_dropdown","search_toggle","active",i,"search-dropdown-active"),D("topline_dropdown","topline_dropdown_toggle","active",i,"topline-dropdown-active"),D("dropdown-cart","dropdown-cart-toggle","active",i,"cart-dropdown-active"),D("message_top","message_top_toggle","active",i,"messagee-top-active"),D("message_bottom","message_bottom_toggle","active",i,"messagee-bottom-active");var t=k("search_modal_close"),o=k("search_toggle"),a=x.querySelector("#search_dropdown .search-field");t&&(t.onclick=function(e){o&&(S(),o.focus(),e.preventDefault(),e.stopPropagation())},t.onblur=function(e){a&&a.focus()});var s=k("logo"),n=k("nav_toggle"),r=k("nav_close"),c=x.querySelector(".top-menu li:first-child>a"),d=k("skip_link");r&&n&&n.addEventListener("click",function(e){r.focus()}),x.addEventListener("keydown",function(e){"Escape"===e.key&&S(),e.key,"Tab"===e.key&&e.shiftKey&&(e.target===r&&(S(),n&&n.focus(),e.preventDefault(),e.stopPropagation()),e.target===c&&r&&(r.focus(),e.preventDefault(),e.stopPropagation()),e.target===a&&t&&(t.focus(),e.preventDefault(),e.stopPropagation()),e.target===o&&(s.focus(),e.preventDefault(),e.stopPropagation()),e.target===n&&((o||s).focus(),e.preventDefault(),e.stopPropagation()),e.target===s&&d&&(d.focus(),e.preventDefault(),e.stopPropagation()))}),r&&(r.onblur=function(e){c&&c.focus()},r.addEventListener("click",function(e){S(),n&&n.focus()})),function(e){for(var t=0;t<e.length;++t)e[t].addEventListener("click",function(e){e.preventDefault()})}(x.querySelectorAll('a[href="#"]'));var l,f,u,g,p,v,m,L=k("header-affix-wrap");function h(t,e,o){o?t.classList.contains("affix")||(t.classList.remove("i"),e.forEach(function(e){t.classList.add(e)})):t.classList.contains("affix")&&(e.forEach(function(e){t.classList.remove(e)}),t.classList.add("i"))}if(L&&(l=k("header"),u=(f=l).offsetTop,g=f.id,p=x.getElementById("header-absolute-wrap"),y=f.getAttribute("data-bg"),v=[],(m="header"===g&&p&&y&&f.classList.contains("transparent"))&&(v=y.split(" ")),E.onscroll=function(e){E.pageYOffset>=u?f.classList.contains("affix")||(m&&h(f,v,!0),f.classList.add("affix")):f.classList.contains("affix")&&(m&&h(f,v,!1),f.classList.remove("affix")),0===E.pageYOffset&&f.classList.contains("affix")&&(m&&h(f,v,!1),f.classList.remove("affix")),this.oldScroll>this.scrollY?(f.classList.add("scrolling-up"),f.classList.remove("scrolling-down")):(f.classList.remove("scrolling-up"),f.classList.add("scrolling-down")),this.oldScroll=this.scrollY},setTimeout(function(){A(l,L)},200),E.addEventListener("resize",function(){setTimeout(function(){A(l,L)},200)})),"undefined"!=typeof Masonry&&"undefined"!=typeof imagesLoaded){var _=x.querySelectorAll(".masonry");if(_.length)for(var b=0;b<_.length;b++)imagesLoaded(_[b],function(e){new Masonry(e.elements[0],{itemSelector:".grid-item",columnWidth:".grid-sizer",percentPosition:!0})})}var w=k("to-top");w&&(w.addEventListener("click",function(e){e.preventDefault(),E.scroll({top:0,left:0,behavior:"smooth"})}),E.addEventListener("scroll",function(e){60<E.pageYOffset?w.classList.add("visible"):w.classList.remove("visible")})),(w||L)&&E.dispatchEvent(new Event("scroll"));var y=x.querySelectorAll(".exs-ajax-form");y&&y.forEach(function(e,t){e.onsubmit=function(e){e.preventDefault();var a=e.target,e=a.querySelector(".exs-form-message");e&&e.remove();var s=a.querySelector("button");s&&(s.setAttribute("disabled","disabled"),s.classList.add("loading"));for(var t="nonce="+i.getAttribute("data-nonce")+"&action=exs_ajax_form",o=0;o<a.length-1;o++)t+="&"+a[o].name+"="+a[o].placeholder+"|||"+a[o].value;var n=new XMLHttpRequest;n.onload=function(e){var t=JSON.parse(n.response),o=x.createElement("div");o.classList.add("exs-form-message"),o.appendChild(x.createTextNode(t.data.message)),a.appendChild(o),a.reset(),s.removeAttribute("disabled")},n.onerror=function(){console.error("error")},n.open("post",i.getAttribute("data-ajax")),n.setRequestHeader("Content-type","application/x-www-form-urlencoded"),n.send(t)}}),i.classList.add("dom-loaded")}),E.onload=function(){x.body.classList.add("window-loaded");var e=k("preloader");e&&e.classList.add("loaded")}}(document,window,document.getElementById.bind(document));