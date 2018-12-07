(function($, Drupal, drupalSettings) {
   $(document).ready(function() {
       //alert('Hello !');
       $("a[href^='http']").attr('target', '_blank');
       var host = window.location.origin;
       $(".node a[href^='http']")
           .css('background-image', 'url("' + host + '/poei/web/themes/custom/ive/images/external-link.gif")')
           .css('background-size', '20px')
           .css('background-repeat', 'no-repeat')
           .css('padding-left', '25px')
           .css('background-position', 'left center');
       $('.block h2').click(function(){
          $(this).parent().find('.content').slideToggle();
       });
   });
}) (jQuery, Drupal, drupalSettings);