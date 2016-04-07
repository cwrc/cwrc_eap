(function ($) {
  $(document).ready(function() {
    var settings = Drupal.settings.cwrc_eap;

    // Set the BASE URL to the CWRC API for loading/saving/creating/searching.
    cD.setCwrcApi(settings.base_url + '/cwrc/api/');

    // Set the base repo URL.
    // cD.setRepositoryBaseObjectURL(settings.base_url + '/islandora/object/');

    // Set CWRC entity schemas.
    cD.setPersonSchema("http://cwrc.ca/schemas/entities.rng");
    cD.setOrganizationSchema("http://cwrc.ca/schemas/entities.rng");
    cD.setPlaceSchema("http://cwrc.ca/schemas/entities.rng");

    // set URL from the outside linked data sources
    // cD.setGeonameUrl(settings.base_url + "/geonames/");
    // cD.setViafUrl(settings.base_url + "/viaf/");
    // cD.setGoogleGeocodeUrl("http://maps.googleapis.com/maps/api/geocode/xml");

    // On success we need to reload to see the changes.
    settings.opts.success = function() {
      location.reload();
    }

    // On error we just alert that something went wrong.
    settings.opts.error = function() {
      window.alert(Drupal.t('There was an error processing your request.'));
    }

    // Open editing dialog.
    $('#cwrc-eap-edit-link').click(function (e) {
      e.preventDefault();
      switch (settings.entity_type) {
        case 'person':
          cD.popEditPerson(settings.opts);
          break;
        case 'organization':
          cD.popEditOrganization(settings.opts);
          break;
        case 'place':
          cD.popEditPlace(settings.opts);
          break;
        case 'title':
          cD.popEditTitle(settings.opts);
          break;
      }
    });
  });
})(jQuery);
