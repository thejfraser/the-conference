jQuery(document).ready(function($){
	var menuindex = 0;
	var $body = $("body");
	var $window = $(window);
	$("ul#primary-menu>li.menu-item-has-children>a").each(function(){
		var n = 'primary-menu-dropdown-' + menuindex;
		var $this = $(this);
		$this.siblings("ul").attr("id", n).addClass("dropdown-content").css("margin-top",($this).height()).prepend("<li class='menu-item-moved'>"+($this[0].outerHTML)+"</li>");
		$this.attr("href", "#menu").bind("click", function(e){e.preventDefault();})
			.attr("data-activates", n).append("<i class='material-icons right tiny'>arrow_drop_down</i>").dropdown({constrain_width: false});
		menuindex++;
	});
	$("ul#primary-menu ul.sub-menu>li.menu-item-has-children>a").each(function(){
		var n = 'primary-menu-sideways-' + menuindex;
		var $this = $(this);
		var uls = $(this).siblings("ul");
		uls.toggleClass("hide").prepend("<li class='menu-item-moved'>"+($this[0].outerHTML)+"</li>");
		$this.attr("href","#menu").bind("click", function(e){e.preventDefault();e.stopPropagation();uls.toggleClass("hide");})
			.append("<i class='material-icons left tiny'>arrow_drop_down</i>");
	});
	$("a#primary-menu-open").sideNav('show');
	function resizeBody() {
		if ($window.width()>600) {
			var wheight = $(window).height();
			wheight -= $body.find("header").outerHeight();
			wheight -= $body.find("footer").outerHeight();
		} else {
			wheight=0;
		}
		$body.children("main").css("min-height", wheight).children("div").css("min-height", wheight).children().css("min-height",wheight);
	}
	$window.bind("resize", resizeBody);
	resizeBody();

});