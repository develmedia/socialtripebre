<?php
global $theme_root;
global $base_url;
global $user;
global $language ;
$curr_uri = request_uri();
$array_curr_uri = explode('/', $curr_uri);
$data = arg(0);
$wishlist = flag_get_user_flags('node');
$count_wishlist = 0;
if(isset($wishlist['shop'])){
    $count_wishlist = count($wishlist['shop']);
}
?>
<!--[if (lt IE 9) | IE 9]>
        <div style="background:#fff;padding:8px 0 10px;">
        <div class="container" style="width:1170px;"><div class="row wrapper"><div class="clearfix" style="padding:9px 0 0;float:left;width:83%;"><i class="fa fa-exclamation-triangle scheme_color f_left m_right_10" style="font-size:25px;color:#e74c3c;"></i><b style="color:#e74c3c;">Attention! This page may not display correctly.</b> <b>You are using an outdated version of Internet Explorer. For a faster, safer browsing experience.</b></div><div class="t_align_r" style="float:left;width:16%;"><a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode" class="button_type_4 r_corners bg_scheme_color color_light d_inline_b t_align_c" target="_blank" style="margin-bottom:2px;">Update Now!</a></div></div></div></div>
<![endif]-->
<!--markup header-->
<div class="header-dipu">
        <div class="container">
            <div class="pull-left">
                <a href="http://www.diputaciodetarragona.cat/" target="_blank"><img src="<?php print base_path()?>sites/all/themes/flatastic/images/dipu_head.gif" alt=""></a>
            </div>

            <div class="pull-right">
                <ul class="languages-selector">
                    <li><a href="<?php print $GLOBALS['base_url']; ?>/ca">CA</li>
                     <li><a href="<?php print $GLOBALS['base_url']; ?>/es">ES</li>

                </ul>
            </div>
        </div>
    </div>
<header role="banner">
    <!--header top part-->
    <?php if ($page['topbar_1']) : ?>
        <div class="h_top_part">
            <div class="container">
                <div class="row clearfix">
                    <?php print render($page['topbar_1']); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!--header bottom part-->
    <div class="h_bot_part container">
        <div class="clearfix row">
            <div class="col-lg-6 col-md-6 col-sm-4 t_xs_align_c">
                <?php if ($logo): ?>
					<?php 
						if(theme_get_setting('use_logo_default') == 0) {
							if(strpos($curr_uri, 'index-construction') || theme_get_setting('demo') == 'construction') { $logo = file_create_url(theme_get_setting('logo_construction')); }
							elseif(strpos($curr_uri, 'index-corporate') || theme_get_setting('demo') == 'corporate') { $logo = file_create_url(theme_get_setting('logo_corporate')); }
							elseif(strpos($curr_uri, 'interior-variant') || strpos($curr_uri, 'interior-landing') || theme_get_setting('demo') == 'interior') { $logo = file_create_url(theme_get_setting('logo_interior')); }
							elseif(strpos($curr_uri, 'one-page')) { $logo = file_create_url(theme_get_setting('logo_onepage')); }
						}
					?>
                    <a href="<?php print $front_page; ?>" class="logo m_xs_bottom_15 d_xs_inline_b">
                        <img width="auto" height="auto" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>">
                    </a>
                <?php elseif ($site_name || $site_slogan): ?>
                    <?php if ($site_name): ?>
                        <a href="<?php print $front_page; ?>" class="logo m_xs_bottom_15 d_xs_inline_b">
                            <?php print $site_name; ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($site_slogan): ?>
                        <span id="site-slogan"<?php if ($disable_site_slogan) { print ' class="hidden"';} ?>>
                        <?php print $site_slogan; ?>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8 t_align_r t_xs_align_c">
             <ul class="social-icons-header">
                   <li class="instagram"><a href="https://www.instagram.com/terresebre" target="_blank" title="Instagram">Instagram</a></li>
           
   			  <li class="facebook"><a href="https://www.facebook.com/turismeterresdelebre" target="_blank" title="Facebook">Facebook</a></li>
                <li class="twitter"><a href="https://twitter.com/terresebretur" target="_blank" title="Twitter">Twitter</a></li>
                <li class="googleplus"><a href="https://plus.google.com/+TerresdelebreTravel/posts" target="_blank" title="Google+">Google+</a></li>
                <li class="youtube"><a href="https://www.youtube.com/user/terresdelebretravel" target="_blank" title="Youtube">Linkedin</a></li>
            </ul>
            </div>
        </div>
    </div>
    <!--main menu container-->
    <div class="menu_wrap relative">
        <div class="container clearfix">
            <!--button for responsive menu-->
            <button id="menu_button" class="r_corners centered_db d_none tr_all_hover d_xs_block m_bottom_10">
                <span class="centered_db r_corners"></span>
                <span class="centered_db r_corners"></span>
                <span class="centered_db r_corners"></span>
            </button>
            <!--main menu-->
            <nav role="navigation" class="f_left f_xs_none d_xs_none">
                <?php print render($page['menu']); ?>
            </nav>
            <button class="f_right search_button tr_all_hover f_xs_none d_xs_none">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <!--search form-->
        <div class="searchform_wrap tf_xs_none tr_all_hover">
            <div class="container vc_child h_inherit relative">
                <?php
                $block = module_invoke('search', 'block_view', 'form');
                print render($block['content']);
                ?>
                <button class="close_search_form tr_all_hover d_xs_none color_dark">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</header>
