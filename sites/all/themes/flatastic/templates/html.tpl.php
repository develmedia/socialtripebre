<?php
/**
 * @file
 * Zen theme's implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation. $language->dir
 *   contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $jump_link_target: The HTML ID of the element that the "Jump to Navigation"
 *   link should jump to. Defaults to "main-menu".
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It should be placed within the <body> tag. When selecting through CSS
 *   it's recommended that you use the body tag, e.g., "body.front". It can be
 *   manipulated through the variable $classes_array from preprocess functions.
 *   The default values can contain one or more of the following:
 *   - front: Page is the home page.
 *   - not-front: Page is not the home page.
 *   - logged-in: The current viewer is logged in.
 *   - not-logged-in: The current viewer is not logged in.
 *   - node-type-[node type]: When viewing a single node, the type of that node.
 *     For example, if the node is a Blog entry, this would be "node-type-blog".
 *     Note that the machine name of the content type will often be in a short
 *     form of the human readable label.
 *   The following only apply with the default sidebar_first and sidebar_second
 *   block regions:
 *     - two-sidebars: When both sidebars have content.
 *     - no-sidebars: When no sidebar content exists.
 *     - one-sidebar and sidebar-first or sidebar-second: A combination of the
 *       two classes when only one of the two sidebars have content.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see zen_preprocess_html()
 * @see template_process()
 */
?>

<?php
global $base_url;
global $theme_root; 
$curr_uri = request_uri();

$array_curr_uri = explode('/', $curr_uri);
$data = arg(0);
foreach($array_curr_uri as $k => $v){
    if($v == ''){
        unset($array_curr_uri[$k]);
    }
}
array_push($array_curr_uri, $data);

$arrayTypeSettings = array(
    'page_wide_layout','page_boxed_layout',
    'header_1', 'header_2', 'header_3', 'header_4', 'header_5',
    'footer_1', 'footer_2', 'footer_3', 'footer_4', 'footer_5', 'footer_6'
);

$count=1;
foreach($arrayTypeSettings as $type) {
    $var1 = 'page_style'.$count;
    $var2 = 'arrayPageStyle'.$count;
    $var3 = 'getPageStyle'.$count;
    
    $$var1 = theme_get_setting($type);
    $$var1 = str_replace(" ","", $$var1);
    $$var2 = explode(',', $$var1);
    $count++;
    
    $$var3 = array_intersect($$var2, $array_curr_uri);
}
$is_page_header = false;
$is_page_footer = false;
for ($i = 3; $i <= 7; $i++) {
    $header_page = 'getPageStyle' . $i;
    if (count($$header_page) > 0) {
        $header_option_page = 'header_' . ($i - 2);
        $is_page_header = true;
        break;
    }
}
for ($i = 8; $i <= 13; $i++) {
    $footer_page = 'getPageStyle' . $i;
    if (count($$footer_page) > 0) {
        $footer_option_page = 'footer_' . ($i - 7);
        $is_page_footer = true;
        break;
    }
}
if (count($getPageStyle1) > 0) {
    $layout_option = 'wide_layout';
} elseif (count($getPageStyle2) > 0) {
    $layout_option = 'boxed_layout';
} else {
    if (theme_get_setting('layout_option') == 'boxed') {
        $layout_option = 'boxed_layout';
    } else {
        $layout_option = 'wide_layout';
    }
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 ie" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <![endif]-->
<!--[if gt IE 8]> <!-->
<html class="" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"> <!--<![endif]-->
    <head>
        <?php print $head; ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <title>
            <?php 
                if(isset($head_title_array['title'])): 
                    print $head_title; 
                else:
              
                endif;
            ?>
        </title>
        <?php print $styles; ?>
        <style type="text/css">
            <?php if (theme_get_setting('switcher') == 1) : ?>
                <?php if(theme_get_setting('background_type') == 'color' && theme_get_setting('background_color')!='') : ?>
                    #select_color,.bg_image_button{ background:<?php print theme_get_setting('background_color'); ?>;}
                <?php endif; ?>
            <?php endif; ?>
        </style>

		<link rel='stylesheet' href='<?php echo $theme_root; ?>/css/colors/<?php echo theme_get_setting('skins'); ?>.css' type='text/css' media='all' />
		<?php if(theme_get_setting('demo') != 'default') : ?>
            <link rel='stylesheet' href='<?php echo $theme_root; ?>/css/skins/<?php echo theme_get_setting('demo'); ?>.css' type='text/css' media='all' />
		<?php endif; ?>
		
		<?php if(strpos($curr_uri, 'index-construction')) : ?>
			<link rel='stylesheet' href='<?php echo $theme_root; ?>/css/colors/yellow.css' type='text/css' media='all' />
			<link rel='stylesheet' href='<?php echo $theme_root; ?>/css/skins/construction.css' type='text/css' media='all' />
		<?php endif; ?>
		<?php if(strpos($curr_uri, 'index-corporate')) : ?>
			<link rel='stylesheet' href='<?php echo $theme_root; ?>/css/colors/orange.css' type='text/css' media='all' />
			<link rel='stylesheet' href='<?php echo $theme_root; ?>/css/skins/corporate.css' type='text/css' media='all' />
		<?php endif; ?>
		<?php if(strpos($curr_uri, 'interior-variant') || strpos($curr_uri, 'interior-landing')) : ?>
            <link rel='stylesheet' href='<?php echo $theme_root; ?>/css/colors/yellow_light.css' type='text/css' media='all' />
			<link rel='stylesheet' href='<?php echo $theme_root; ?>/css/skins/interior.css' type='text/css' media='all' />
		<?php endif; ?>
		<?php if(strpos($curr_uri, 'one-page')) : ?>
			<link rel='stylesheet' href='<?php echo $theme_root; ?>/css/colors/green.css' type='text/css' media='all' />
		<?php endif; ?>
		
		<?php if (theme_get_setting('rtl') == 1 || strpos($curr_uri, 'index-rtl')) :?>
			<link rel="stylesheet" type="text/css" media="all" href="<?php echo $theme_root; ?>/css/rtl.css">
		<?php endif; ?>
    </head>

    <body class="<?php print $classes; ?>" <?php print $attributes; ?> style="<?php if(theme_get_setting('background_type') == 'color' && theme_get_setting('background_color')!='') : ?>background:<?php print theme_get_setting('background_color'); ?><?php elseif(theme_get_setting('background_image')!=''):?>background:url(<?php echo $theme_root; ?>/images/patterns/<?php print theme_get_setting('background_image'); ?>.png);<?php endif; ?>">
        
		<?php if (theme_get_setting('switcher') == 1) {
            require_once("includes/template_switcher.inc");
        } ?>
        <?php print $page_top; ?>
        <?php print $page; ?>
        <?php print $page_bottom; ?>
        <?php print $scripts; ?>
        <script>
            (function($){
                $(document).ready(function(){

                    if($('ul.main_menu').length){
                        $('ul.main_menu a.active-trail').parents('li.relative').addClass('current');
                        $('ul.main_menu li.current').parents('li.relative').addClass('current');
                        $('ul.main_menu li.current a.active-trail').parents().parents().parents().prev().addClass('active-trail');
                    }
                    var hSelect = $('[name="header_type"]'),
                        fSelect = $('[name="footer_type"]');

                    // Header setting
                    <?php
                    if(isset($_GET['header'])){
                        $header_option = $_GET['header'];
                    } elseif($is_page_header) {
                        $header_option = $header_option_page;
                    } else {
                        $header_option = theme_get_setting('header_option');
                    }
                    ?>
                    <?php
                    switch($header_option):
                        case 'header_1': ?>
                            // Setting Header 1
                            hSelect.prevAll(".select_title").text('Header 1');
                        <?php
                            break;
                        case 'header_2': ?>
                            // Setting Header 2
                            $('.main_menu').addClass('type_2');
                            $('.main_menu .f_xs_none').addClass('m_left_10 m_xs_left_0');
                            $('.main_menu .color_light').removeClass('color_light').addClass('color_dark r_corners');
                            hSelect.prevAll(".select_title").text('Header 2');
                        <?php
                            break;
                        case 'header_3': ?>
                            // Setting Header 3
                            hSelect.prevAll(".select_title").text('Header 3');
                        <?php
                            break;
                        case 'header_4': ?>
                            // Setting Header 4
                            $('.main_menu').addClass('type_3');
                            $('.main_menu li.m_xs_bottom_5').addClass('m_left_40 m_sm_left_10 m_md_left_25 m_xs_left_0');
                            $('.main_menu .color_light').removeClass('color_light').addClass('color_dark r_corners');
                            hSelect.prevAll(".select_title").text('Header 4');
                        <?php
                            break;
                        case 'header_5': ?>
                            // Setting Header 5
                            $('.main_menu').addClass('type_2 header_5');
                            hSelect.prevAll(".select_title").text('Header 5');
                    <?php
                    default:
                        break;
                endswitch;
                 ?>
                    //Footer Seting

                    <?php if(isset($_GET['footer'])){
                        $footer_option = $_GET['footer'];
                    } elseif($is_page_footer) {
                        $footer_option = $footer_option_page;
                    } else {
                        $footer_option = theme_get_setting('footer_option');
                    }
                    ?>
                    <?php
                          switch($footer_option):
                              case 'footer_1': ?>
                            // Setting Footer 1
                    fSelect.prevAll(".select_title").text('Footer 1');
                            <?php
                                break;
                            case 'footer_2': ?>
                            // Setting Footer 2
                    fSelect.prevAll(".select_title").text('Footer 2');
                            <?php
                                break;
                            case 'footer_3': ?>
                            // Setting Footer 3
                    fSelect.prevAll(".select_title").text('Footer 3');
                            <?php
                                break;
                            case 'footer_4': ?>
                            // Setting Footer 4
                    fSelect.prevAll(".select_title").text('Footer 4');
                            <?php
                                break;
                            case 'footer_5:': ?>
                            // Setting Footer 5
                    fSelect.prevAll(".select_title").text('Footer 5');
                            <?php
                            break;
                             case 'footer_6:': ?>
                    // Setting Footer 6
                    fSelect.prevAll(".select_title").text('Footer 6');
                    <?php
                    default:
                        break;
                endswitch;
                 ?>


                    // If enable Switcher
                    <?php if (theme_get_setting('switcher') == 1) : ?>
                        <?php if ($layout_option == 'boxed_layout') { ?>
                            $('#styleswitcher .layout_boxed').addClass('active');
                        <?php } else { ?>
                            $('#styleswitcher .layout_wide').addClass('active');
                        <?php } ?>


                        <?php if(theme_get_setting('background_type') == 'color' && theme_get_setting('background_color')!='') : ?>
                        var sc = $('#select_color');
                        sc.ColorPicker({
                            color: '<?php print theme_get_setting('background_color'); ?>',
                            onShow: function (colpkr){
                                $(colpkr).fadeIn(500);
                                return false;
                            },
                            onHide: function (colpkr) {
                                $(colpkr).fadeOut(500);
                                return false;
                            },
                            onChange: function (hsb, hex, rgb){
                                $('body').css('background-image','none');
                                $('#select_color,body').css('backgroundColor', '#' + hex);
                            }
                        });
                        <?php endif; ?>
                        var sw = $('#styleswitcher'),
                            layout = jQuery('[class*="_layout"]'),
                            color = jQuery('.bg_select_color'),
                            bgSelect = jQuery('select[name="bg_color"]'),
                            image = jQuery('.bg_select_image'),
                            reset = sw.find('button[type="reset"]');
                        reset.on('click',function(){
                            var h = $('[role="banner"]'),
                                f = $('.footer_top_part');

                            $('body,#select_color').css({
                                <?php if(theme_get_setting('background_type') == 'image' && theme_get_setting('background_image')!='') : ?>
                                'backgroundImage' : 'url(<?php echo $theme_root; ?>/images/patterns/<?php print theme_get_setting('background_image'); ?>.png)',
                                <?php endif; ?>
                                <?php if(theme_get_setting('background_type') == 'color' && theme_get_setting('background_color')!='') : ?>
                                'backgroundColor' : '<?php print theme_get_setting('background_color'); ?>',
                                'backgroundImage' : 'none'
                                <?php endif; ?>
                            });

                            if(!(sw.find('.homepage').length)){
                                sw.find('[data-layout]').removeClass('active');
                                <?php if ($layout_option == 'boxed_layout') { ?>
                                    layout.removeClass('wide_layout').addClass('boxed_layout');
                                    $('#styleswitcher .layout_boxed').addClass('active');
                                <?php } else { ?>
                                    layout.removeClass('boxed_layout').addClass('wide_layout');
                                    $('#styleswitcher .layout_wide').addClass('active');
                                <?php } ?>
                            }

                            image.slideUp(function(){
                                color.slideDown();
                            });

                            bgSelect.prevAll(".select_title").text('Color');
                            bgSelect.prev('.select_list').children('li').removeClass('active').first().addClass('active');

                                    });
                    <?php endif; ?>
					
					// jackbox
					if($(".jackbox[data-group]").length){
						jQuery(".jackbox[data-group]").jackBox("init",{ 
							showInfoByDefault: false,
							preloadGraphics: false, 
							fullscreenScalesContent: true,
							autoPlayVideo: false,
							flashVideoFirst: false,
							defaultVideoWidth: 960,
							defaultVideoHeight: 540,
							baseName: "<?php echo $base_url; ?>/jackbox",
							className: ".jackbox",
							useThumbs: true,
							thumbsStartHidden: false,
							thumbnailWidth: 75,
							thumbnailHeight: 50,
							useThumbTooltips: false,
							showPageScrollbar: false,
							useKeyboardControls: true 
						});
					}
					
					// twitter
					(function(){
						$('.twitterfeed').tweet({
							username: '<?php echo theme_get_setting('twitter_username'); ?>',
							modpath : '<?php echo $base_url; ?>/twitter/',
							count: 2,
							loading_text: 'loading twitter feed...',
							template: '<a class="color_dark" href="{user_url}">@{screen_name}</a> {text}<div>{time}</div><ul class="horizontal_list clearfix tw_buttons"><li>{reply_action}</li><li class="m_left_5">{retweet_action}</li><li class="m_left_5">{favorite_action}</li></ul>'
						});
					})();

                })
            })(jQuery);
        </script>

        <button class="t_align_c r_corners type_2 tr_all_hover animate_ftl" id="go_to_top"><i class="fa fa-angle-up"></i></button>
	</body>
</html>


