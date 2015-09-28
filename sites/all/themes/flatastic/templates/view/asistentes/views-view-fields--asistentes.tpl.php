<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<div class="col-lg-4 col-md-4 col-sm-4">
	<div class="imatge-assitent"><?php print $fields["field_foto"]->content;?></div>
	<h3 class="titol-asistent"><?php print $fields["title"]->content;?></h3>
	<div class="vista-descripcio"><?php print $fields["body"]->content;?></div>
	<div class="social-icons">
	
		<?php if(isset($fields["field_instagram"]->content)) { ?>
			<span class="icono-social">
				<a href="<?php print $fields["field_instagram"]->content;?>"> <img id="instagram-image" src="<?php print base_path()?>sites/all/themes/flatastic/images/instagram.png" onmouseover="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/instagram-hover.png'" onmouseout="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/instagram.png'" alt="instagram"/></a>
			</span>
		<?php } ?>	
		
		<?php if(isset($fields["field_facebook"]->content)) { ?>
			<span class="icono-social">
				<a href="<?php print $fields["field_facebook"]->content;?>"> <img id="facebook-image" src="<?php print base_path()?>sites/all/themes/flatastic/images/facebook.png" onmouseover="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/facebook-hover.png'" onmouseout="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/facebook.png'" alt="Facebook"/></a>
			</span>	
		<?php }	?>		
		
		<?php if(isset($fields["field_twitter"]->content)) { ?>

			<span class="icono-social">
				<a href="<?php print $fields["field_twitter"]->content;?>"> <img id="twitter-image" src="<?php print base_path()?>sites/all/themes/flatastic/images/twitter.png" onmouseover="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/twitter-hover.png'" onmouseout="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/twitter.png'" alt="twitter"/></a>
			</span>	
		<?php }	?>
		
		<?php if(isset($fields["field_google_plus"]->content)) { ?>
			<span class="icono-social">
				<a href="<?php print $fields["field_google_plus"]->content;?>"> <img id="google-plus-image" src="<?php print base_path()?>sites/all/themes/flatastic/images/google-plus.png" onmouseover="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/google-plus-hover.png'" onmouseout="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/google-plus.png'" alt="google-plus"/></a>
			</span>		
		<?php }	?>

		<?php if(isset($fields["field_youtbe"]->content)) { ?>
			<span class="icono-social">
				<a href="<?php print $fields["field_youtbe"]->content;?>"> <img id="youtube-image" src="<?php print base_path()?>sites/all/themes/flatastic/images/youtube.png" onmouseover="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/youtube-hover.png'" onmouseout="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/youtube.png'" alt="youtube"/></a>
			</span>		
		<?php }	?>		
		
		<?php if(isset($fields["field_web"]->content)) { ?>		
			<span class="icono-social">
				<a href="<?php print $fields["field_web"]->content;?>"> <img id="web-image" src="<?php print base_path()?>sites/all/themes/flatastic/images/web.png" onmouseover="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/web-hover.png'" onmouseout="this.src='<?php print base_path()?>sites/all/themes/flatastic/images/web.png'" alt="web"/></a>
			</span>				
		<?php } else { } ?>	
	</div>
</div>	