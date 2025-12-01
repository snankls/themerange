<?php $tr_theme_options = themerange_get_theme_options(); ?>

<!-- Site Footer - Start
================================================== -->
<footer class="site_footer footer_layout_1">
    <div class="content_box" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/shapes/bg_pattern_3.svg');">
      <!--<div class="container">
        <div class="diract_contact_links text-white">
          <div class="iconbox_block layout_icon_left">
            <div class="iconbox_icon">
              <img src="<?php /*echo get_template_directory_uri(); ?>/assets/images/icons/icon_mail.svg" alt="Mail SVG Icon">
            </div>
            <div class="iconbox_content">
              <h3 class="iconbox_title">Write to us</h3>
              <p class="mb-0">
                Techco@gmail.com
              </p>
            </div>
          </div>
          <div class="iconbox_block layout_icon_left">
            <div class="iconbox_icon">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/icon_calling.svg" alt="Calling Check SVG Icon">
            </div>
            <div class="iconbox_content">
              <h3 class="iconbox_title"> Call Us (USA)</h3>
              <p class="mb-0">
                +(1) 1230 452 8597
              </p>
            </div>
          </div>
          <div class="iconbox_block layout_icon_left">
            <div class="iconbox_icon">
              <img src="<?php echo get_template_directory_uri();*/ ?>/assets/images/icons/icon_map_mark.svg" alt="Map Mark Check SVG Icon">
            </div>
            <div class="iconbox_content">
              <h3 class="iconbox_title">Our Office</h3>
              <p class="mb-0">
                Waterloo, Park, Australia
              </p>
            </div>
          </div>
        </div>-->
        
        <?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
        <!--<div class="footer_main_content">
          <div class="row justify-content-lg-between">-->
            <?php dynamic_sidebar( 'footer-sidebar' ); ?>
          <!--</div>
        </div>-->
        <?php endif; ?>
        
      <!--</div>-->
    </div>
    
    <div class="footer_bottom">
      <div class="container d-md-flex align-items-md-center justify-content-md-between">
        <p class="copyright_text m-0">
          <?php echo "Copyright &copy; ".date("Y")." themerange. All Rights Reserved."; ?>
        </p>
      </div>
    </div>
</footer>
<!-- Site Footer - End
================================================== -->
