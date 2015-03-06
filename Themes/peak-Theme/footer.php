<?php $email = get_theme_mod('oy_email', ''); ?>
<?php $telephone = get_theme_mod('oy_telephone', ''); ?>
	
				</div><!-- /.main-content -->
			</div><!-- /.table -->
			
			<footer class="footer group">
																		
				<p>
					<?php if($telephone) { ?><small itemprop="telephone">T:&nbsp;&nbsp;<a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a></small><?php } ?>
					<?php if($email) { ?><small itemprop="email">E:&nbsp;&nbsp;<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></small><?php } ?>
					<small><?php printf(__('&copy; %1$s %2$s. All rights reserved.', 'onioneye'), date("Y"), get_bloginfo('name')); ?></small>
				</p>
				
			</footer><!-- ./footer -->	
	
		</div><!-- /.main-container -->

	<!-- wordpress footer functions -->
	<?php wp_footer(); ?>
	<!-- end of wordpress footer -->

</body>
</html>