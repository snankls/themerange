<?php $tr_theme_options = themerange_get_theme_options();
$btn_style = $tr_theme_options['tr_header_button_style'];
$btn_name = $tr_theme_options['tr_header_button_name'];
$btn_link = $tr_theme_options['tr_header_button_link']; ?>

<!-- Site Header - Start -->
<header>

  <!-- tp-header-area-start -->
  <div id="header-sticky" class="tp-header-area pre-header tp-header-wd-wrap sticky-white-bg tp-header-blur header-transparent tp-header-lg-spacing">
      <div class="container-fluid container-1800">
        <div class="row align-items-center">
            <div class="col-xl-3 col-6">
              <div class="tp-header-logo">
                  <?php themerange_theme_logo('normal'); ?>
              </div>
            </div>
            <div class="col-xl-6 d-none d-xl-block">
              <div class="tp-main-menu tp-header-dropdown dropdown-white-bg d-flex justify-content-center">
                  <nav class="tp-mobile-menu-active">
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
                  </nav>
              </div>
            </div>
            <div class="col-xl-3 col-6">
              <div class="tp-header-right d-flex align-items-center justify-content-end">
                <?php if($tr_theme_options['tr_enable_search']) : ?>
                <div class="tp-header-search">
                  <button class="tp-header-search-btn tp-search-click">
                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4823 8.58366C14.4823 9.35829 14.3298 10.1253 14.0333 10.841C13.7369 11.5567 13.3024 12.2069 12.7547 12.7547C12.2069 13.3024 11.5567 13.7369 10.841 14.0333C10.1253 14.3298 9.35829 14.4823 8.58366 14.4823C7.80904 14.4823 7.04199 14.3298 6.32633 14.0333C5.61067 13.7369 4.96041 13.3024 4.41266 12.7547C3.86492 12.2069 3.43042 11.5567 3.13399 10.841C2.83755 10.1253 2.68498 9.35829 2.68498 8.58366C2.68498 7.01923 3.30644 5.51888 4.41266 4.41266C5.51888 3.30644 7.01923 2.68498 8.58366 2.68498C10.1481 2.68498 11.6484 3.30644 12.7547 4.41266C13.8609 5.51888 14.4823 7.01923 14.4823 8.58366ZM14.5093 13.3178C15.7192 11.8034 16.3033 9.88316 16.1416 7.95155C15.98 6.01993 15.0849 4.22353 13.6401 2.93127C12.1953 1.63901 10.3106 0.949 8.37298 1.00294C6.43537 1.05688 4.59194 1.85068 3.22131 3.22131C1.85068 4.59194 1.05688 6.43537 1.00294 8.37298C0.949 10.3106 1.63901 12.1953 2.93127 13.6401C4.22353 15.0849 6.01993 15.98 7.95155 16.1416C9.88316 16.3033 11.8034 15.7192 13.3178 14.5093L15.5719 16.7635C15.7308 16.917 15.9437 17.0019 16.1647 17C16.3856 16.998 16.5969 16.9094 16.7532 16.7532C16.9094 16.5969 16.998 16.3856 17 16.1647C17.0019 15.9437 16.917 15.7308 16.7635 15.5719L14.5093 13.3178Z" fill="currentColor" />
                      </svg>
                  </button>
                </div>
                <?php endif; ?>

                <?php if($tr_theme_options['tr_header_enable_button']) : ?>
                <div class="tp-header-btn tp-header-btn-spacing d-none d-md-inline-block ml-20">
                  <a href="contact-light.html" class="tp-btn-lg d-inline-block lh-0 tp-round-26 fs-15 tp-bg-common-black text-uppercase ls-0 tp-btn-switch-animation tp-text-common-white hover-text-white tp-ff-heading fw-500">
                      <span class="d-flex align-items-center justify-content-center">
                        <span class="btn-text">Let’s Talk</span>
                        <span class="btn-icon">
                            <svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
                            </svg>
                        </span>
                        <span class="btn-icon">
                            <svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
                            </svg>
                        </span>
                    </span> 
                  </a>
                </div>
                <button class="tp-menu-bar tp-header-sidebar-btn ml-20 d-xl-none">
                  <span></span>
                  <span></span>
                  <span></span>
                </button>
                <?php endif; ?>
              </div>
            </div>
        </div>
      </div>
  </div>
  <!-- tp-header-area-end -->
    
</header>
<!-- Site Header - End -->
