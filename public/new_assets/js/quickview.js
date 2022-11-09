function custom_bg() {
	$("*").css('background-color', function() {
		return jQuery(this).data('bgcolor');
	});
	$("body,div,section,span").css('background', function() {
		return jQuery(this).data('bgimage');
	});
	$("div,section").css('background-size', function() {
		return 'cover';
	});
}

jQuery('#btn-close-quick-view').on("click", function () {
    $(".de__quick-view").fadeOut("normal", function() {
            $(this).hide();
            $('html,body').removeClass("no-scroll");
        });
});

jQuery(".de__product-popup .atr__colors div").on("click", function () {
    var img_url = jQuery(this).attr('data-image');
    var sc = jQuery(this).parent().parent().parent().parent().find(".atr__image-main");
    sc.attr('src',img_url);
    jQuery(this).parent().find("div").removeClass("active");
    jQuery(this).addClass("active");
});

custom_bg();

// input number 

(function() {
 
  window.inputNumber = function(el) {

    var min = el.attr('min') || false;
    var max = el.attr('max') || false;

    var els = {};

    els.dec = el.prev();
    els.inc = el.next();

    el.each(function() {
      init($(this));
    });

    function init(el) {

      els.dec.on('click', decrement);
      els.inc.on('click', increment);

      function decrement() {
        var value = el[0].value;
        value--;
        if(!min || value >= min) {
          el[0].value = value;
        }
      }

      function increment() {
        var value = el[0].value;
        value++;
        if(!max || value <= max) {
          el[0].value = value++;
        }
      }
    }
  }
})();

inputNumber($('.input-number'));