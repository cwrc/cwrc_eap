<h3><?php print $label; ?></h3>
<?php foreach ($elements as $delta => $element) { ?>
  <?php print render($element); ?>
<?php } ?>
