jQuery(document).ready(function($) {
  jQuery(".search_icon").click(function() {
    jQuery(".medihealth-search-form").slideToggle();
  });

  jQuery(document).keydown(function(e) {
    if (e.keyCode == 27) {
      //$(modal_or_menu_element).closeElement();
      jQuery(".medihealth-search-form").hide();
    }
  });
});