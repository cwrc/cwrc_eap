<?php

/**
 * @file
 * Displays an EAP.
 */
?>
<div class="<?php print $classes; ?>">

  <div class="row">

    <?php
// "Information" goes on the left. ?>
    <div class="left">
      <h2><?php print t('Information'); ?></h2>

      <div class="information-left">


      <?php if (!empty($image) || !empty($summary)) { ?>
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
      <?php } ?>

      <div class="about-info">
      <?php
// "Record" Information. ?>
      <?php if (count($info_record) > 0) { ?>
        <h3><?php print t('About'); ?></h3>
        <?php foreach ($info_record as $info) { ?>
          <?php print render($info); ?> 
        <?php } ?>
      <?php } ?>
      </div>

      <?php
// "Identity" Information. ?>
      <?php if (count($info_identity) > 0) { ?>
        <h3><?php print t('Identity'); ?></h3>
        <?php foreach ($info_identity as $info) { ?>
          <?php print render($info); ?>
        <?php } ?>
      <?php } ?>
      </div>

      <div class="information-right">
      <?php
// "Description" Information. ?>
      <?php if (count($info_description) > 0) { ?>
        <h3><?php print t('Description'); ?></h3>
        <?php foreach ($info_description as $info) { ?>
          <?php print render($info); ?>
        <?php } ?>
      <?php } ?>
    </div></div>

    <?php
// "Associations" goes on the right. ?>
    <div class="right">
      <h2><?php print t('Associations'); ?></h2>

      <div id="association-people" class="associations-collapsible block" data-component="<?php print $associations_person['component']; ?>">
        <h2 class="collapsiblock collapsiblockCollapsed">
          <a href="#association-people" role="link">
            <?php print t('People'); ?>
            <span class="badge"><?php print t('Loading...'); ?></span>
          </a>
        </h2>
        <div class="content" style="display:none;">
          <ul></ul>
        </div>
      </div>

      <div id="association-places" class="associations-collapsible block" data-component="<?php print $associations_place['component']; ?>">
        <h2 class="collapsiblock collapsiblockCollapsed">
          <a href="#association-places" role="link">
            <?php print t('Places'); ?>
            <span class="badge"><?php print t('Loading...'); ?></span>
          </a>
        </h2>
        <div class="content" style="display:none;">
          <ul></ul>
        </div>
      </div>

      <div id="association-orgs" class="associations-collapsible block" data-component="<?php print $associations_organization['component']; ?>">
        <h2 class="collapsiblock collapsiblockCollapsed">
          <a href="#association-orgs" role="link">
            <?php print t('Organizations'); ?>
            <span class="badge"><?php print t('Loading...'); ?></span>
          </a>
        </h2>
        <div class="content" style="display:none;">
          <ul></ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="materials tabs">
      <ul class="material-tabs">
        <?php foreach ($materials as $material) { ?>
          <li class="material-tab-row">
            <a href="#material-<?php print $material['type'] ?>"><?php print $material['label'] ?></a>
            <span class="badge"><?php print t('Loading...'); ?></span>
          </li>
        <?php } ?>
      </ul>
      <?php foreach ($materials as $material) { ?>
        <div class="material-tab-inner-row" id="material-<?php print $material['type']; ?>" data-component="<?php print $material['type']; ?>">
          <ul></ul>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
