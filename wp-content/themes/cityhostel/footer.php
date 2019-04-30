<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

						// Widgets area inside page content
						cityhostel_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					cityhostel_create_widgets_area('widgets_below_page');

					$cityhostel_body_style = cityhostel_get_theme_option('body_style');
					if ($cityhostel_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$cityhostel_footer_style = cityhostel_get_theme_option("footer_style");
			if (strpos($cityhostel_footer_style, 'footer-custom-')===0) $cityhostel_footer_style = 'footer-custom';
			get_template_part( "templates/{$cityhostel_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (cityhostel_is_on(cityhostel_get_theme_option('debug_mode')) && cityhostel_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(cityhostel_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>