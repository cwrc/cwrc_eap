/**
 * @file
 * Set up the EAP edit page.
 */

(function ($) {
  $(document).ready(function () {
    var settings = Drupal.settings.cwrc_eap;

    // Set the BASE URL to the CWRC API for loading/saving/creating/searching.
    cD.setCwrcApi(settings.base_url + '/cwrc/api/');

    // Set CWRC entity schemas.
    cD.setPersonSchema("https://cwrc.ca/schemas/entities.rng");
    cD.setOrganizationSchema("https://cwrc.ca/schemas/entities.rng");
    cD.setPlaceSchema("https://cwrc.ca/schemas/entities.rng");

    // On success we need to reload to see the changes.
    settings.opts.success = function () {
      location.reload();
    }

    // On error we just alert that something went wrong.
    settings.opts.error = function () {
      window.alert(Drupal.t('There was an error processing your request.'));
    }

    // Open editing dialog.
    $('.cwrc-eap-edit-link').click(function (e) {
      e.preventDefault();
      switch (settings.entity_type) {
        case 'person':
          window.open('/sites/default/libraries/cwrc-entity-management-forms-static/build/person?entityId=' + settings.opts.id);
          break;

        case 'organization':
          window.open('/sites/default/libraries/cwrc-entity-management-forms-static/build/organization?entityId=' + settings.opts.id);
          break;

        case 'place':
          window.open('/sites/default/libraries/cwrc-entity-management-forms-static/build/place?entityId=' + settings.opts.id);
          break;

        case 'title':
         // cD.popEditTitle(settings.opts);
          break;
      }
    });
  });
})(jQuery);
