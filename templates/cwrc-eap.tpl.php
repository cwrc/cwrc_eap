<div class="<?php print $classes; ?>">
  <div class="row">
    <div class="slider">
      <?php print render($slider); ?>
    </div>
  </div>
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

      <?php # "Person" associations ?>
      <?php if (count($association_person) > 0) { ?>
        <h3><?php print t('People'); ?></h3>
        <?php foreach ($association_person as $association) { ?>
          <?php print render($association); ?>
        <?php } ?>
      <?php } ?>

      <?php # "Place" associations ?>
      <?php if (count($association_place) > 0) { ?>
        <h3><?php print t('Places'); ?></h3>
        <?php foreach ($association_place as $association) { ?>
          <?php print render($association); ?>
        <?php } ?>
      <?php } ?>

      <?php # "Organization" associations ?>
      <?php if (count($association_organization) > 0) { ?>
        <h3><?php print t('Organizations'); ?></h3>
        <?php foreach ($association_organization as $association) { ?>
          <?php print render($association); ?>
        <?php } ?>
      <?php } ?>

    </div>
  </div>
  <div class="row">
    <?php if (count($materials) > 0) { ?>
      <div class="materials">
        <?php foreach ($materials as $material) { ?>
          <?php print render($material); ?>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>
