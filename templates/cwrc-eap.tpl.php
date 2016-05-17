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
      <?php if (!empty($associations_person)) { ?>
        <h3><?php print t('People'); ?></h3>
        <?php print render($associations_person); ?>
      <?php } ?>

      <?php # "Place" associations ?>
      <?php if (!empty($associations_place)) { ?>
        <h3><?php print t('Places'); ?></h3>
        <?php print render($associations_place); ?>
      <?php } ?>

      <?php # "Organization" associations ?>
      <?php if (!empty($associations_organization)) { ?>
        <h3><?php print t('Organizations'); ?></h3>
        <?php print render($associations_organization); ?>
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
