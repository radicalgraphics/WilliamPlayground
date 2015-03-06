<!DOCTYPE html>
<!--[if(IE 9)&!(IEMobile)]> <html <?php language_attributes(); ?> class="no-js ie9 oldie"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	
	<!-- title -->	
	<title>
		<?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
		wp_title( '-', true, 'right' );
		// Add the blog name.
		bloginfo( 'name' );
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' - ' . sprintf( __( 'Page %s', 'onioneye' ), max( $paged, $page ) );
		?>
	</title>
	
	<!-- meta tags -->	
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta name="author" content="OnionEye">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
			
  	<!-- RSS and pingback -->
  	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
  	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head -->	
</head>

<body <?php body_class(); ?>>

	<?php $tagline = get_option('blogdescription', ''); ?>
	<?php $main_logo_url = get_theme_mod('oy_logo', ''); ?>
	<?php $is_logo_retina = get_theme_mod('oy_is_logo_retina', ''); ?>
	<?php $facebook_url = get_theme_mod('oy_facebook', ''); ?>		
	<?php $twitter_url = get_theme_mod('oy_twitter', ''); ?>		
	<?php $googleplus_url = get_theme_mod('oy_googleplus', ''); ?>		
	<?php $pinterest_url = get_theme_mod('oy_pinterest', ''); ?>		
	<?php $instagram_url = get_theme_mod('oy_instagram', ''); ?>		
	<?php $youtube_url = get_theme_mod('oy_youtube', ''); ?>		
	<?php $vimeo_url = get_theme_mod('oy_vimeo', ''); ?>			
	<?php $is_social_existent = ($facebook_url || $twitter_url || $googleplus_url || $pinterest_url || $instagram_url || $youtube_url || $vimeo_url) ? 1 : 0; ?>
	<?php $terms = get_terms('portfolio_category'); ?>
	<?php $category_count = count($terms); ?>
	<?php $locations = get_nav_menu_locations(); ?>
	<?php count($locations) ? $is_menu_existent = $locations['main'] : $is_menu_existent = false; ?>
				
	<?php if($is_menu_existent || $tagline || $category_count) { ?>
		<div class="dropdown-container">
			<div class="close-button">×</div>
			<div class="dropdown-content">
				<p class="tagline">
					<?php echo $tagline; ?>
				</p>
				
				<?php // Display the menu for mobile, if the menu, or the categories exists ?>
				<?php if($is_menu_existent || $category_count) { ?>	
					<div class="mobile-menu">															
						<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => 'nav', 'menu' => 'custom_menu', 'container_class' => 'group', 'depth' => 2, 'walker' => new Nfr_Menu_Walker() ) ); ?>
						
						<?php get_template_part('includes/portfolio-filter'); ?>
					</div><!-- /.mobile-menu -->
				<?php } ?>
			</div><!-- /.dropdown-content -->
		</div><!-- /.dropdown-container -->
	<?php } ?>
	
	<div class="main-container group">		
		<header class="header group">
			<div class="table">
				
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						
						<?php if($main_logo_url && $is_logo_retina) { ?>
											
							<?php 
								$image_details = wp_get_attachment_image_src( oy_get_attachment_id_from_src( $main_logo_url ), 'full');
													
								// If the dimensions of the image are correctly returned, calculate half of its width and height. 
								if($image_details[1] && $image_details[2]) { 
									$image_half_width = round($image_details[1] / 2);
									$image_half_height = round($image_details[2] / 2);
								}
							?>
									
							<img src="<?php echo $image_details[0]; ?>" alt="<?php esc_attr_e( 'Site Logo', 'onioneye' ); ?>" width="<?php echo $image_half_width; ?>" 
							height="<?php echo $image_half_height ?>">
												
						<?php } else if($main_logo_url) { ?>
											
							<img src="<?php echo $main_logo_url; ?>" alt="<?php esc_attr_e( 'Site Logo', 'onioneye' ); ?>">
												
						<?php } else { ?>
											
							<span class="textual-logo"><?php echo get_option( 'blogname' ); ?></span>
												
						<?php } ?>	
								
					</a>
				</div><!-- /.logo -->
			
				<div class="header-secondary">
					<ul class="social-and-search group <?php if($is_social_existent) { ?>social-exists<?php } else { ?>search-only<?php } ?>">
						<?php if($facebook_url) { ?>
							<li><a target="_blank" class="facebook-link" href="<?php echo esc_url($facebook_url); ?>" title="<?php esc_attr_e('FaceBook', 'onioneye'); ?>"></a></li>
						<?php } ?>
						<?php if($twitter_url) { ?>
							<li><a target="_blank" class="twitter-link" href="<?php echo esc_url($twitter_url); ?>" title="<?php esc_attr_e('Twitter', 'onioneye'); ?>"></a></li>
						<?php } ?>
						<?php if($googleplus_url) { ?>
							<li><a target="_blank" class="googleplus-link" href="<?php echo esc_url($googleplus_url); ?>" title="<?php esc_attr_e('Google Plus', 'onioneye'); ?>"></a></li>
						<?php } ?>
						<?php if($pinterest_url) { ?>
							<li><a target="_blank" class="pinterest-link" href="<?php echo esc_url($pinterest_url); ?>" title="<?php esc_attr_e('Pinterest', 'onioneye'); ?>"></a></li>
						<?php } ?>
						<?php if($instagram_url) { ?>
							<li><a target="_blank" class="instagram-link" href="<?php echo esc_url($instagram_url); ?>" title="<?php esc_attr_e('Instagram', 'onioneye'); ?>"></a></li>
						<?php } ?>
						<?php if($youtube_url) { ?>
							<li><a target="_blank" class="youtube-link" href="<?php echo esc_url($youtube_url); ?>" title="<?php esc_attr_e('YouTube', 'onioneye'); ?>"></a></li>
						<?php } ?>
						<?php if($vimeo_url) { ?>
							<li><a target="_blank" class="vimeo-link" href="<?php echo esc_url($vimeo_url); ?>" title="<?php esc_attr_e('Vimeo', 'onioneye'); ?>"></a></li>
						<?php } ?>
							<li class="search-item">
								<?php get_template_part('includes/search-form'); ?>
							</li><!-- /.search-item -->
					</ul><!-- /.social-and-search -->	
				</div><!-- /.header-secondary -->	
			
			</div><!-- /.table -->
		
			<div class="mobile-search search-item group">
				<?php get_template_part('includes/search-form'); ?>
			</div><!-- /.mobile-search -->
			
			<?php if($is_menu_existent || $tagline) { ?>
				<div class="header-buttons <?php if($is_menu_existent && $tagline) { ?>menu-and-tagline<?php } ?>">
					<?php if($tagline) { ?><div class="tagline-button"></div><?php } ?>
					<?php if($is_menu_existent) { ?><div class="menu-button"></div><?php } ?>
				</div>
			<?php } ?>										
		</header><!-- /.header -->	
		
		<div class="table-wrapper table">
			
			<div class="menu-container">
			
				<?php // Display the main menu and/or the portfolio filter, if either of them exist ?>
				<?php if ($is_menu_existent) { ?>
								
					<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => 'nav', 'menu' => 'custom_menu', 'container_class' => 'group', 'depth' => 2, 'walker' => new Nfr_Menu_Walker() ) ); ?>
					
				<?php } ?>
				
				<?php if($category_count) { ?>
					
					<?php get_template_part('includes/portfolio-filter'); ?>
					
				<?php } ?>
								
			</div><!-- /.menu-container --> 
								
			<div class="main-content group">	