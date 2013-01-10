
/*
* Plugin developed by Dan Bentley
* @dan_bentley
*
* @danott: Found on http://csswizardry.com/. No licensing information provided, so I will use it
* unless told otherwise by it's author.
*/

(function($) {

  var defaults = {};

  $.fn.fixedscroll = function(opts) {

    var options = $.extend(defaults, opts);

    var el = $(this);
    if (el.css('position') !== 'fixed') return;

    var lockPosition = options.lockElement.offset().top - el.outerHeight();
    var offsetTop = options.offset.top || 0;

    $(window).bind('load scroll', function(e) {

      if ($(window).scrollTop() + offsetTop >= lockPosition) {
        el.css({
          position: "absolute",
          top: lockPosition
        });
      } else {
        el.css({
          position: "fixed",
          top: offsetTop
        });
      }
    });
  };

})(jQuery);
