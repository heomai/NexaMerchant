!function(a){function t(){for(var t=p.scrollTop(),e=l.height(),i=e-h,r=i<t?i-t:0,n=0;n<d.length;n++){var s,o,c=d[n];t<=c.stickyWrapper.offset().top-c.topSpacing-r?null!==c.currentTop&&(c.stickyElement.css({width:"",position:"",top:""}),c.stickyElement.parent().removeClass(c.className),c.stickyElement.trigger("sticky-end",[c]),c.currentTop=null):((s=e-c.stickyElement.outerHeight()-c.topSpacing-c.bottomSpacing-t-r)<0?s+=c.topSpacing:s=c.topSpacing,c.currentTop!=s&&(c.getWidthFrom?o=a(c.getWidthFrom).width()||null:c.widthFromWrapper&&(o=c.stickyWrapper.width()),null==o&&(o=c.stickyElement.width()),c.stickyElement.css("width",o).css("position","fixed").css("top",s),c.stickyElement.parent().addClass(c.className),null===c.currentTop?c.stickyElement.trigger("sticky-start",[c]):c.stickyElement.trigger("sticky-update",[c]),c.currentTop===c.topSpacing&&c.currentTop>s||null===c.currentTop&&s<c.topSpacing?c.stickyElement.trigger("sticky-bottom-reached",[c]):null!==c.currentTop&&s===c.topSpacing&&c.currentTop<s&&c.stickyElement.trigger("sticky-bottom-unreached",[c]),c.currentTop=s))}}function e(){h=p.height();for(var t=0;t<d.length;t++){var e=d[t],i=null;e.getWidthFrom?!0===e.responsiveWidth&&(i=a(e.getWidthFrom).width()):e.widthFromWrapper&&(i=e.stickyWrapper.width()),null!=i&&e.stickyElement.css("width",i)}}var i=Array.prototype.slice,r=Array.prototype.splice,n={topSpacing:0,bottomSpacing:0,className:"is-sticky",wrapperClassName:"sticky-wrapper",center:!1,getWidthFrom:"",widthFromWrapper:!0,responsiveWidth:!1},p=a(window),l=a(document),d=[],h=p.height(),s={init:function(t){var r=a.extend({},n,t);return this.each(function(){var t=a(this),e=t.attr("id"),i=t.outerHeight(),e=e?e+"-"+n.wrapperClassName:n.wrapperClassName,e=a("<div></div>").attr("id",e).addClass(r.wrapperClassName);t.wrapAll(e);e=t.parent();r.center&&e.css({width:t.outerWidth(),marginLeft:"auto",marginRight:"auto"}),"right"==t.css("float")&&t.css({float:"none"}).parent().css({float:"right"}),e.css("height",i),r.stickyElement=t,r.stickyWrapper=e,r.currentTop=null,d.push(r)})},update:t,unstick:function(t){return this.each(function(){for(var t=a(this),e=-1,i=d.length;0<i--;)d[i].stickyElement.get(0)===this&&(r.call(d,i,1),e=i);-1!=e&&(t.unwrap(),t.css({width:"",position:"",top:"",float:""}))})}};window.addEventListener?(window.addEventListener("scroll",t,!1),window.addEventListener("resize",e,!1)):window.attachEvent&&(window.attachEvent("onscroll",t),window.attachEvent("onresize",e)),a.fn.sticky=function(t){return s[t]?s[t].apply(this,i.call(arguments,1)):"object"!=typeof t&&t?void a.error("Method "+t+" does not exist on jQuery.sticky"):s.init.apply(this,arguments)},a.fn.unstick=function(t){return s[t]?s[t].apply(this,i.call(arguments,1)):"object"!=typeof t&&t?void a.error("Method "+t+" does not exist on jQuery.sticky"):s.unstick.apply(this,arguments)},a(function(){setTimeout(t,0)})}(jQuery);