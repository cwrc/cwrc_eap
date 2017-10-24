(function ($, Drupal) {
  Drupal.behaviors.eapAjax = {
    attach: function (context, settings) {

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
              if (typeof(data.connections[component]) != 'undefined') {
                $(element).find('h2 .badge').text(data.connections[component].length);
                var list = $(element).find('.content ul');
                for(var i = 0; i < data.connections[component].length; i++) {
                  var obj = data.connections[component][i];
                  $(list).append('<li><a href="' + obj.uri + '">' + obj.fedoraLabel + '</a></li>');
                }
              } else {
                $(element).find('h2 .badge').text('0');
              }
            },
            error: function(jqxhr) {
              $(element).find('h2 .badge').text(Drupal.t('Error'));
            }
          });
        }
      });

      // Populate materials.
      $('.materials').each(function() {
        // Get component and element for use in success callback.
        var component = $(this).data('component');
        var element = this;

        // Component must be defined to proceed.
        if (typeof(component) != 'undefined') {
          // Lookup data for this component.
          $.ajax('/islandora/cwrc-eap/material/' + Drupal.settings.cwrc_eap_ajax_pid + '/' + component, {
            success: function(data) {
              // Change count on badge and render list.
              if (typeof(data.material[component]) != 'undefined') {
                $('[aria-controls="' + $(element).attr('id') + '"] .badge').text(data.material[component].length);
                // $(element).find('h2 .badge').text(data.material[component].length);
                var list = $(element).find('ul');
                for(var i = 0; i < data.material[component].length; i++) {
                  var html = data.material[component][i];
                  $(list).append('<li>' + html + '</li>');
                }
              } else {
                $('[aria-controls="' + $(element).attr('id') + '"] .badge').text('0');
              }
            },
            error: function(jqxhr) {
                $('[aria-controls="' + $(element).attr('id') + '"] .badge').text(Drupal.t('Error'));
            }
          });
        }
      });
    }
  };
})(jQuery, Drupal);
