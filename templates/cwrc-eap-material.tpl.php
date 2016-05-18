<div class="<?php print $classes ?>">
  <?php if ($image) { ?>
    <div class="image">
      <?php print $image; ?>
    </div>
  <?php } else { ?>
    <div class="no-image"></div>
  <?php } ?>
  <div class="text-wrapper">
    <div class="label">
      <a href="<?php print url('islandora/object/' . $pid); ?>"><?php print $label; ?></a>
    </div>
    <?php if ($summary) { ?>
      <div class="summary">
        <?php print $summary; ?>
      </div>
    <?php } ?>
  </div>
</div>
