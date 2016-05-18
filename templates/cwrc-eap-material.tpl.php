<div class="<?php print $classes ?>">
  <?php if ($image) { ?>
    <div class="image">
      <a href="<?php print url('islandora/object/' . $pid); ?>"><?php print $image; ?></a>
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
        <?php print truncate_utf8($summary, 200, true, true); ?>
      </div>
    <?php } ?>
  </div>
</div>
