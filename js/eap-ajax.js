(function ($, Drupal) {
  Drupal.behaviors.eapAjax = {
    attach: function (context, settings) {
      console.log(Drupal.settings);
      // Populate associations.
      $('.associations').each(function() {
        // Get component and element for use in success callback.
        var component = $(this).data('component');
        var element = this;

        // Component must be defined to proceed.
        if (typeof(component) != 'undefined') {
          // Lookup data for this component.
          $.ajax('/islandora/cwrc-eap/' + Drupal.settings.cwrc_eap_ajax_pid + '/' + component, {
            success: function(data) {
              // Change count on badge and render list.
              if (typeof(data[component]) != 'undefined') {
                $(element).find('h2 .badge').text(data[component].length);
                var list = $(element).find('.content ul');
                for(var i = 0; i < data[component].length; i++) {
                  var obj = data[component][i];
                  $(list).append('<li><a href="' + obj.uri + '">' + obj.fedoraLabel + '</a></li>');
                }
              } else {
                $(element).find('h2 .badge').text('0');
              }
            },
            error: function(jqxhr) {}
          });
        }
      });
    }
  };
})(jQuery, Drupal);
