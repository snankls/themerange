<?php $tr_theme_options = themerange_get_theme_options();
$btn_style = $tr_theme_options['tr_header_button_style'];
$btn_name = $tr_theme_options['tr_header_button_name'];
$btn_link = $tr_theme_options['tr_header_button_link']; ?>

<!-- Site Header - Start
================================================== -->
<header class="site_header site_header_1">
    <div class="header_top text-center">
      <div class="container">
        <p class="m-0">Subscribe us and receive <b>20% bonus</b> discount on checkout. <a href="pricing.html"><u>Learn more</u> <i class="fa-solid fa-angle-right"></i></a></p>
      </div>
    </div>
    <div class="header_bottom stricky">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-3 col-lg-2 col-5">
            <div class="site_logo">
              <?php themerange_theme_logo('normal'); ?>
              <div class="badge bg-danger-subtle text-danger">We’re Hiring</div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-7 col-2">
            <nav class="main_menu navbar navbar-expand-lg">
              <div class="main_menu_inner collapse navbar-collapse justify-content-lg-center" id="main_menu_dropdown">
                <?php 
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
						array(
							'container' => 'nav',
							'container_class' => 'tr-mega-menu-wrapper navigation clearfix',
							'menu_class' => 'main_menu_list unordered_list justify-content-center',
							'theme_location' => 'primary',
							'walker' => new Themerange_Walker_Nav_Menu() )
						);
					}
					else{
						wp_nav_menu( array(
							'container' => 'nav',
							'container_class' => 'main-menu pc-menu tr-mega-menu-wrapper',
							'menu_class' => 'main_menu_list unordered_list justify-content-center'
						) );
					}
				?>
              </div>
            </nav>
          </div>
          <div class="col-xl-3 col-lg-3 col-5">
            <ul class="header_btns_group unordered_list justify-content-end">
              <?php if($tr_theme_options['tr_header_enable_button']) : ?>
              <li>
                <button class="mobile_menu_btn" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="far fa-bars"></i>
                </button>
              </li>
              <?php endif; ?>
              
              <?php if($tr_theme_options['tr_header_enable_button']) : ?>
              <li>
                <?php echo tr_button($btn_style, $btn_name, $btn_link); ?>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
</header>
<!-- Site Header - End
================================================== -->
