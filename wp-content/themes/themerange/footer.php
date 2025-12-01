<?php $theme_options = themerange_get_theme_options();
$page_options = themerange_get_page_options(); ?>
<div class="clear"></div>
</main>
<!-- #main .wrapper -->
<div class="clear"></div>
	
    <?php
		// Check if a specific footer block is set in page options
		if (!empty($page_options['tr_footer_block'])) {
			themerange_get_footer_content($page_options['tr_footer_block']);
		}
		// Check if a specific footer block is set in theme options
		else if (!empty($theme_options['el_footer_block'])) {
			themerange_get_footer_content($theme_options['el_footer_block']);
		}
		// Include the default footer if no specific footer block is set
		else {
			require_once get_template_directory() . '/templates/footer/footer.php';
		}
	?>
	
    <!-- Back To Top - Start -->
    <div class="backtotop">
        <a href="#" class="scroll">
          <i class="fa-solid fa-arrow-up"></i>
        </a>
    </div>
    <!-- Back To Top - End -->
    
</div>
<!-- #page -->

<?php wp_footer(); ?>
</body>
</html>