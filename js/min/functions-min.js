svgeezy.init("nocheck","png"),jQuery(document).ready(function($){$(".menu-toggle").click(function(t){"Explore"==$(this).text()?$(this).text("Hide Menu"):"Hide Menu"==$(this).text()&&$(this).text("Explore")}),$("a").each(function(){var t=new RegExp("/"+window.location.host+"/");t.test(this.href)||-1!==this.href.indexOf("mailto:")||-1!==this.href.indexOf("tel://")||$(this).click(function(t){t.preventDefault(),t.stopPropagation(),window.open(this.href,"_blank")})})});