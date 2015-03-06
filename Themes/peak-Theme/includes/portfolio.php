<?php
	$desired_width = 440;
	$desired_height = 0;
		
	if(is_tax()) { // is category page
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$args = array( 'post_type' => 'portfolio', 'portfolio_category' => $term -> slug, 'posts_per_page' => -1, 'orderby' => 'menu_order' ); 
	}
	else { // is main portfolio page
		$args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'menu_order' ); 
	}
	 
   	$loop = new WP_Query( $args );
		
	if($loop->have_posts()) {
?>

	<div class="pf-gallery-container">   
		<div class="pf-adjuster">	   	
			<div id="isotope-trigger" class="portfolio-gallery group">
				
				<?php
				//output the latest projects from the 'my_portfolio' custom post type
				while ($loop->have_posts()) : $loop->the_post();
					$preview_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full-size' );
					$preview_img_url = $preview_img['0'];
					$image_full_width = $preview_img[1];
					$image_full_height = $preview_img[2];						
				?>
						
					<div data-id="id-<?php echo $post->ID; ?>" class="isotope-item portfolio-item portfolio-item-<?php the_ID(); ?> <?php $terms = get_the_terms( $post -> ID, 'portfolio_category' ); if ( !empty( $terms ) ) { foreach( $terms as $term ) { echo $term -> slug . ' '; } } ?>">		
									
						<a class="project-link" href="<?php the_permalink(); ?>">
									
							<?php if ($preview_img_url) { ?>
										
								<div class="thumb-container">
									<?php
										$thumb = oy_get_attachment_id_from_src( $preview_img_url );
										$image = vt_resize( $thumb, '', $desired_width, true );
									?>	
																									    
									<?php // If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size ?>
									<?php if( $image_full_width > $desired_width || $image_full_height > $desired_height ) { ?>
										
										<img class="preview-img" src="<?php echo $image[url]; ?>" alt="<?php the_title(); ?>" />
														    				       		  								              
									<?php } else { ?>	
											
										<img class="preview-img" src="<?php echo $preview_img_url; ?>" alt="<?php the_title(); ?>" />	          	
																	              
									<?php } ?>
									
									<div class="view-button">×</div>
																				
								</div><!-- /.thumb-container -->
										
							<?php } ?>
									
							<h3 class="project-title caps"><?php the_title(); ?></h3>
																									
						</a><!-- /.project-link -->
			
					</div><!-- /.portfolio-item -->
					
				<?php endwhile; ?>
				
			</div><!-- /#isotope-trigger -->
		</div><!-- /.pf-adjuster -->
	</div><!-- /.pf-gallery-container -->
	
<?php } // end if ?>	