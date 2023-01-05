<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package V4
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php if (get_field('show_topbar', 'option')) : ?>
	<div class="top-bar py-2">
		<div class="container">
			<div class="top-bar__data"><ul>
				<?php
					$topbar = [];
					if ($company_phone = get_field('company_phone', 'option')) {
						array_push($topbar, '<li><i class="fas fa-phone"></i>' . '<a href="tel:+1'.$company_phone.'">'.$company_phone.'</a></li>');
					}
					if ($company_email_address = get_field('company_email_address', 'option')) {
						array_push($topbar, '<li><i class="fas fa-envelope"></i><a href="mailto:'.$company_phone.'">' . $company_email_address.'</a></li>');
					}
					if ($company_address = get_field('company_address', 'option')) {
						array_push($topbar, '<li><i class="fas fa-envelope-open-text"></i>' . $company_address.'</li>');
					}
					echo join($topbar);

				?>
			</ul></div>

		</div>
	</div>
	<?php endif;?>

	<?php 
		$navbar_style_addon = false;
		if ($header_image = get_field('header_background_image', 'option')) {
			$header_image_url = $header_image['url'];
			
			$navbar_style_addon = "background-image: url('".$header_image_url."');";
		}
	?>
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'v4' ); ?></a>
	<header id="masthead" class="<?php echo (get_field('sticky_nav', 'option')) ? 'sticky-top' : ''; ?> site-header bg-color__<?php echo v4_retrieve_color_name('header_background_color', 'option') ?> text-color__<?php echo v4_retrieve_color_name('header_text_color') ?> bg-<?php echo v4_retrieve_overlay_header_boolean() ?>">
		<div class="<?php echo (get_field('page_header_width', 'option') == 'full') ? '' : 'container'; ?>">
			<nav class="navbar navbar-expand-lg <?php echo (get_field('nav_on_its_own_line', 'option')) ? 'pt-4 pb-0' : 'py-4'; ?> " style="<?php echo $navbar_style_addon;?>">
			  <div class="container-full <?php echo (get_field('nav_on_its_own_line', 'option')) ? 'navbar--ownline' : ''; ?>">
					<div class="site-branding">
						<?php
						the_custom_logo();
						?>
					</div><!-- .site-branding -->
			    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse flex-grow-1 text-right bg-color__<?php echo v4_retrieve_color_name('navbar_background_color') ?>" id="navbarSupportedContent">
						<?php
						wp_nav_menu(array(
								'theme_location' => 'main-menu',
								'container' => false,
								'menu_class' => '',
								'fallback_cb' => '__return_false',
								'items_wrap' => '<ul id="%1$s" class="navbar-nav ms-auto flex-nowrap %2$s">%3$s</ul>',
								'depth' => 2,
								'walker' => new bootstrap_5_wp_nav_menu_walker()
						));
						?>
				</div>
			  </div>
			</nav>


		</div>
	</header><!-- #masthead -->
