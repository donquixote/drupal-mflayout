<?php

/**
 * @file
 * Multi-field layout with 1 column and background image.
 *
 * @var string $ds_content_wrapper
 * @var string $layout_attributes
 * @var string $classes
 * @var string $ds_content
 *   HTML contents of the main region.
 * @var \Drupal\mflayout\MfLayoutSlotValues $mflayout_slots
 */

?>
<<?php print $ds_content_wrapper; print $layout_attributes; ?> class="ds-1col <?php print $classes;?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php print $ds_content; ?>
</<?php print $ds_content_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
