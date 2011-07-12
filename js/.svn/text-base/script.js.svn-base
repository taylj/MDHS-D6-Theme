$(function() {
  $('ul.sf-menu').sooperfish({
    sooperfishWidth: 270,
    hoverClass:  'over',           // hover class
    delay:     1,                // 500ms delay on mouseout as per Jacob Nielsen advice
    dualColumn:     8,
    tripleColumn:     16,
    animationShow:   { "height": "show" },
    speedShow:     1,
    easingShow:    "easeOutOvershoot",
    animationHide:   { "opacity": "hide", "height": "hide" },
    speedHide:     1,
    easingHide:    "easeInCirc",
    autoArrows:  false,              // generation of arrow mark-up
    dropShadows: false
  });

  /* Use js as a workaround for IE6 li:hover */
  $('ul.sf-menu li').hover(function() {
    $(this).addClass('hover');
  }, function() {
    $(this).removeClass('hover');
  });

  $(".view-partner-logos .view-content .item-list ul").simplyScroll({
    autoMode: 'loop',
    pauseOnHover: true,
    speed: 1
  });

  $('#search-theme-form').submit(function() {
    $key = $('#edit-search-theme-form-header').val();
    $href = 'http://search.unimelb.edu.au?q='+ $key +'&sa=Search';
    $(window.location).attr('href', $href);
    return false;
  });
})
