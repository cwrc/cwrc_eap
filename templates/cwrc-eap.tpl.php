<div class="<?php print $classes; ?>">
  <?php if (!empty($image) || !empty($summary)) { ?>
    <div class="row">
      <header class="header">
        <?php if (!empty($image)) { ?>
          <div class="object-image">
            <?php print render($image); ?>
          </div>
        <?php } ?>
          <?php if (!empty($summary)) { ?>
            <div class="object-summary">
              <?php print render($summary); ?>
            </div>
          <?php } ?>
      </header>
    </div>
  <?php } ?>

  <div class="row">

    <?php # "Information" goes on the left ?>
    <div class="left">
      <h2><?php print t('Information'); ?></h2>

      <?php # "Record" Information ?>
      <?php if (count($info_record) > 0) { ?>
        <h3><?php print t('About'); ?></h3>
        <?php foreach ($info_record as $info) { ?>
          <?php print render($info); ?> 
        <?php } ?>
      <?php } ?>

      <?php # "Identity" Information ?>
      <?php if (count($info_identity) > 0) { ?>
        <h3><?php print t('Identity'); ?></h3>
        <?php foreach ($info_identity as $info) { ?>
          <?php print render($info); ?>
        <?php } ?>
      <?php } ?>

      <?php # "Description" Information ?>
      <?php if (count($info_description) > 0) { ?>
        <h3><?php print t('Description'); ?></h3>
        <?php foreach ($info_description as $info) { ?>
          <?php print render($info); ?>
        <?php } ?>
      <?php } ?>
    </div>

    <?php # "Associations" goes on the right ?>
    <div class="right">
      <h2><?php print t('Associations'); ?></h2>

      <?php if (!empty($associations_person)) { ?>
      <div id="association-people" class="associations-collapsible block">
        <h2 class="collapsiblock <?php if(count($associations_person['#items']) > 5) {
          print " collapsiblockCollapsed";
        }
        ?>">
          <a href="#association-people" role="link"><?php print t('People'); ?></a>
        </h2>
        <div class="content" <?php

        if (count($associations_person['#items']) > 5) {
          print "style=\"display:none;\"";
        }

        ?>>
          <?php print render($associations_person); ?>
        </div>
      </div>
      <?php } ?>

      <?php if (!empty($associations_place)) { ?>
      <div id="association-places" class="associations-collapsible block">
        <h2 class="collapsiblock <?php if(count($associations_place['#items']) > 5) {
          print " collapsiblockCollapsed";
        }
        ?>">
          <a href="#association-places" role="link"><?php print t('Places'); ?></a>
        </h2>
        <div class="content" <?php

        if (count($associations_place['#items']) > 5) {
          print "style=\"display:none;\"";
        }

        ?>>
          <?php print render($associations_place); ?>
        </div>
      </div>
      <?php } ?>

      <?php if (!empty($associations_organization)) { ?>
      <div id="association-orgs" class="associations-collapsible block">
        <h2 class="collapsiblock <?php if(count($associations_organization['#items']) > 5) {
          print " collapsiblockCollapsed";
        }
        ?>">
          <a href="#association-orgs" role="link"><?php print t('Organizations'); ?></a>
        </h2>
        <div class="content" <?php

        if (count($associations_organization['#items']) > 5) {
          print "style=\"display:none;\"";
        }

        ?>>
          <?php print render($associations_organization); ?>
        </div>
      </div>
      <?php } ?>

    </div>
  </div>
  <?php if (count($materials) > 0) { ?>
    <div class="row">
      <div class="materials tabs">
        <ul>
          <?php foreach ($materials as $material) { ?>
            <li><a href="#material-<?php print $material['type'] ?>"><?php print $material['label'] ?></a><span class="badge"><?php print count($material['elements']['#items']); ?></span></li>
          <?php } ?>
        </ul>
        <?php foreach ($materials as $material) { ?>
          <div id="material-<?php print $material['type']; ?>">
            <?php print render($material['elements']); ?>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
</div>
