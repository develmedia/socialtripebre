<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>
<?php print $wrapper_prefix; ?>
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>

    <?php foreach ($rows as $id => $row): ?>
<?php if ($id == 0): ?>
<div class="row-fluid">
 <?php endif; ?>
<?php if ($id == 3): ?>
<div class="row-fluid">
 <?php endif; ?>
<?php if ($id == 6): ?>
<div class="row-fluid">
 <?php endif; ?>

<span class="span4 producte-grid">
	 <?php print $row; ?>
	 </span>
<?php if ($id == 2): ?>
</div>
 <?php endif; ?>    

<?php if ($id == 5): ?>
</div>
 <?php endif; ?>
<?php if ($id == 8): ?>
</div>
 <?php endif; ?>    
    <?php endforeach; ?>

<?php print $wrapper_suffix; ?>
