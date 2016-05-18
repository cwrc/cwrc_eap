<?php

function render_list($v, $title, $id) {
  print "<div id=\"assocation-" . $id . "\" class=\"associations-collapsible block\">";
  print "<h2 class=\"collapsiblock";

  if (count($v['#items']) > 5) {
    print " collapsiblockCollapsed";
  }

  print "\"><a href=\"#association-" . $id . "\" role=\"link\">" . $title . "</a></h2>";
  print "<div class=\"content\"";

  if (count($v['#items']) > 5) {
    print " style=\"display:none;\"";
  }

  print ">";
  print render($v);
  print "</div></div>";
}

?>
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

      <?php # "Person" associations ?>
      <?php if (!empty($associations_person)) { ?>
        <?php render_list($associations_person, t('People'), 'people'); ?>
      <?php } ?>

      <?php # "Place" associations ?>
      <?php if (!empty($associations_place)) { ?>
        <?php render_list($associations_place, t('Places'), 'places'); ?>
      <?php } ?>

      <?php # "Organization" associations ?>
      <?php if (!empty($associations_organization)) { ?>
        <?php render_list($associations_organization, t('Organizations'), 'organizations'); ?>
      <?php } ?>

    </div>
  </div>
  <div class="row">
    <?php if (count($materials) > 0) { ?>
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
    <?php } ?>
  </div>
</div>
