<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class TR_Elementor_Widget_Slider extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-slider';
    }
	
	public function get_title(){
        return esc_html__( 'TR Slider', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	protected function register_controls(){
		//Slider
		$this->start_controls_section(
      'slider_tab',
      array(
      'label' => esc_html__( 'Slider', 'themerange' ),
      'tab' => Controls_Manager::TAB_CONTENT,
      )
    );
    $this->add_control(
      'image',
      array(
          'label' => esc_html__( 'Image', 'themerange' ),
          'type' => Controls_Manager::MEDIA,
          'default' => array( 'id' => '', 'url' => '' ),
          'description' => '',
      )
    );
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
	?>
    
    <!-- hero area start -->
    <div class="section-triger pre-header">
      <div class="tp-hero-area tp-hero-wd-spacing p-relative bg-position" data-background="assets/img/hero/hero-3/grid-bg.png">
          <a href="#about" class="tp-smooth tp-hero-wd-btp d-none d-xl-block">
            <svg class="upslide-1" width="11" height="25" viewBox="0 0 11 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.4105 18.675L6.13362 24.72C6.06483 24.806 5.97087 24.8766 5.86024 24.9255C5.74961 24.9744 5.6258 25 5.5 25C5.37421 25 5.2504 24.9744 5.13977 24.9255C5.02914 24.8766 4.93518 24.806 4.86638 24.72L0.589462 18.675C0.511191 18.5572 0.483164 18.4215 0.509799 18.2892C0.536433 18.157 0.616215 18.0358 0.736567 17.9446C0.856918 17.8535 1.01099 17.7977 1.1745 17.7859C1.33801 17.7742 1.50165 17.8072 1.63963 17.8798L4.76665 19.633V0.598757C4.76665 0.439957 4.84391 0.287661 4.98144 0.175371C5.11897 0.0630817 5.3055 0 5.5 0C5.6945 0 5.88103 0.0630817 6.01856 0.175371C6.15609 0.287661 6.23336 0.439957 6.23336 0.598757V19.633L9.36038 17.8798C9.49835 17.8072 9.66199 17.7742 9.8255 17.7859C9.98901 17.7977 10.1431 17.8535 10.2634 17.9446C10.3838 18.0358 10.4636 18.157 10.4902 18.2892C10.5168 18.4215 10.4888 18.5572 10.4105 18.675Z" fill="#030303" />
            </svg>
          </a>
          <div class="container-fluid containers container-1800">
            <div class="row">
                <div class="col-xl-2 col-lg-3">
                  <div class="tp-hero-wd-text mb-30">
                    <span class="d-inline-block mb-10">
                      <svg width="110" height="12" viewBox="0 0 110 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect y="10" width="110" height="2" rx="1" fill="#030303" />
                        <rect width="50" height="2" rx="1" fill="#999999" />
                      </svg>
                    </span>
                    <p class="fw-400 fs-20"><span class="tp-text-common-black fw-500">We’re Tech Solutions,</span> building scalable digital products through strategy & design.</p>
                  </div>
                </div>
                <div class="col-xxl-6 col-xl-7 col-lg-9">
                  <div class="tp-hero-wd-title-wrap mb-30">
                      <h2 class="tp-hero-wd-title tp-ff-teko fs-100 text-uppercase mb-20">Engineering 
                      <span class="shape upslide d-inline-block">
                        <svg width="112" height="60" viewBox="0 0 112 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0 1C30.8503 1 34.8743 21.4865 34.8743 42.3801C46.3872 37.2924 68.8096 33.4936 66.3952 59C71.3134 46.6764 81.1497 11.5146 112 11.5146M40.5749 20.3333C41.1337 22.4815 42.1844 27.5918 41.9162 30.848C43.7046 29.039 48.4216 25.8281 52.982 27.4561" stroke="#030303" stroke-width="1.5" />
                        </svg>
                      </span><br>
                        <span class="d-inline-block title-space">
                          Digital
                          <span class="icons d-inline-block">
                            <svg width="40" height="16" viewBox="0 0 40 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M29.88 15.8569L39.552 9.01379C39.6896 8.90372 39.8026 8.75338 39.8808 8.57638C39.959 8.39937 40 8.20127 40 8C40 7.79873 39.959 7.60063 39.8808 7.42363C39.8026 7.24662 39.6896 7.09628 39.552 6.98621L29.88 0.143139C29.6915 0.0179054 29.4743 -0.0269382 29.2628 0.0156776C29.0512 0.0582934 28.8572 0.185945 28.7114 0.378507C28.5656 0.571069 28.4763 0.817589 28.4575 1.0792C28.4387 1.34081 28.4916 1.60264 28.6077 1.8234L31.4128 6.82663L0.958012 6.82663C0.70393 6.82663 0.460255 6.95026 0.280594 7.1703C0.100933 7.39035 0 7.6888 0 8C0 8.3112 0.100933 8.60965 0.280594 8.8297C0.460255 9.04975 0.70393 9.17337 0.958012 9.17337L31.4128 9.17337L28.6077 14.1766C28.4916 14.3974 28.4387 14.6592 28.4575 14.9208C28.4763 15.1824 28.5656 15.4289 28.7114 15.6215C28.8572 15.8141 29.0512 15.9417 29.2628 15.9843C29.4743 16.0269 29.6915 15.9821 29.88 15.8569Z" fill="#030303" />
                            </svg>
                          </span>
                          Tech<br>
                        </span>
                        Solutions.</h2>
                      <div class="tp-hero-wd-customer p-relative">
                        <div class="tp-hero-customer d-flex align-items-center mb-30 mr-95">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/resources/avatar.png" alt="Avtar" class="mr-20">
                            <p class="fw-500 fs-16 tp-text-grey-1 lh-22 mb-0 d-inline-block">We have <b class="tp-text-common-black tp-ff-teko fs-22">2K+</b><br> 
                              customers in world-wide.</p>
                        </div>
                        <div class="tp-hero-video d-flex align-items-center mb-30">
                            <a class="tp-hero-video-btn popup-video mr-20" href="https://www.youtube.com/watch?v=go7QYaQR494">
                              <span>
                                  <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.2595 11.3877C15.9455 10.276 15.9455 7.79857 14.2595 6.68685L4.82854 0.468212C2.95139 -0.769576 0.455619 0.592952 0.476139 2.84432L0.588819 15.2073C0.609123 17.4355 3.08348 18.7571 4.94126 17.5321L14.2595 11.3877Z" fill="currentColor" />
                                  </svg>
                              </span>
                            </a>
                            <p class="lh-110-per mb-0 fw-500 fs-18 tp-text-grey-1">We’re Global <br> Technology & Product Agency.</p>
                        </div>
                        <div class="tp-hero-wd-shape">
                            <span class="shape-1 mb-5">
                              <svg width="41" height="20" viewBox="0 0 41 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M20.6087 -1.90735e-06C9.34689 -1.90735e-06 0.217392 8.70558 0.217392 19.4445H41C41 8.70558 31.8705 -1.90735e-06 20.6087 -1.90735e-06Z" fill="#030303" />
                              </svg>
                            </span>
                            <span class="shape-2">
                              <svg width="67" height="41" viewBox="0 0 67 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M67 0.250122H0V44.0002L67 0.250122Z" fill="#C4EE18" />
                              </svg>
                            </span>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-3 col-lg-5">
                  <div class="tp-hero-wd-right mb-30">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/shape/slider-shape.png" class="mb-150" alt="Slider Shape">
                    <div>
                      <h4 class="tp-ff-teko fw-500 fs-35 mb-5">Awwwards</h4>
                      <p class="fw-400 fs-20">Recognized for digital excellence since 2012.</p>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>

      <div class="tp-hero-bottom pt-40">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-lg-9">
              <div class="tp-hero-bottom-thumb p-relative h-100 mr-40">
                <div class="tp-hero-bottom-height fix scale-up-img">
                  <img src="<?php echo esc_url(wp_get_attachment_url($settings['image']['id'])); ?>" alt="Slider" data-speed="0.8" class="img-cover w-100 h-100 scale-up" />
                </div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/shape/shape.png" class="tp-hero-bottom-shape" alt="Shape">
              </div>
            </div>
            <div class="col-lg-3">
                <div class="tp-hero-bottom-right h-100 tp-bg-common-black tp-left-right p-relative z-index-1 pb-50">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/shape/grid-shape.png" class="tp-hero-customer-shape" alt="Shape">
                  <div class="tp-hero-bottom-box">
                      <span class="tp-hero-bottom-icon d-inline-block mb-55">
                        <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_68_30503" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="100" height="100">
                              <rect width="100" height="100" fill="#D9D9D9" />
                            </mask>
                            <g mask="url(#mask0_68_30503)">
                              <path d="M72.72 0H50.08H49.84H22.8H0C0 26.4423 20.48 48.0769 46.4 50C20.48 51.9231 0 73.5577 0 100H22.8H49.92H50.16H72.72H100V72.6763V50.1603V49.8397V27.3237V0H72.72ZM50.08 95.3525V72.7564V50.2404V49.9199V27.3237V4.72756C52.32 29.0064 71.84 48.2372 96.24 50C71.92 51.8429 52.4 71.0737 50.08 95.3525Z" fill="#C4EE18" />
                            </g>
                        </svg>
                      </span>
                      <span class="tp-hero-bottom-border mb-15">
                        <svg height="6" viewBox="0 0 380 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 2.5L0 0.113249V5.88675L5 3.5V2.5ZM375 3.5L380 5.88675V0.113249L375 2.5V3.5ZM4.5 3.5H375.5V2.5H4.5V3.5Z" fill="#EEEEEE" />
                        </svg>
                      </span>
                      <div class="d-flex align-items-end justify-content-between">
                        <div>
                            <span class="tp-text-common-white fw-400 fs-18 mb-10 d-inline-block">We Recently Launched</span>
                            <h5 class="fw-700 fs-25 tp-text-common-white"><a href="service-details-2-light.html" class="hover-text-white">Revolutionizing Retail with Our POS Solution</a></h5>
                        </div>
                        <span class="tp-arrow-angle mb-10">
                          <svg class="tp-arrow-svg-top-right" width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.943836 13.5C0.685616 13.5 0.45411 13.4021 0.276027 13.224C0.0979452 13.0459 0 12.8055 0 12.5562C0 12.3068 0.0979452 12.0664 0.276027 11.8884L9.76781 2.38767H2.02123C1.49589 2.38767 1.0774 1.96027 1.0774 1.44384C1.0774 0.927397 1.50479 0.5 2.03014 0.5H12.0562C12.1274 0.5 12.1986 0.508904 12.2788 0.526712L12.4034 0.562329L12.537 0.633562C12.5637 0.65137 12.5993 0.678082 12.626 0.69589C12.6973 0.749315 12.7507 0.80274 12.7952 0.856164C12.8219 0.891781 12.8575 0.927397 12.8842 0.989726L12.9555 1.1411L12.9822 1.22123C13 1.29247 13.0089 1.3726 13.0089 1.44384V11.4699C13.0089 11.9952 12.5815 12.4137 12.0651 12.4137C11.5486 12.4137 11.1212 11.9863 11.1212 11.4699V3.72329L1.62055 13.224C1.44247 13.4021 1.20205 13.5 0.943836 13.5Z" fill="white" />
                            <path d="M0.943836 13.5C0.685616 13.5 0.45411 13.4021 0.276027 13.224C0.0979452 13.0459 0 12.8055 0 12.5562C0 12.3068 0.0979452 12.0664 0.276027 11.8884L9.76781 2.38767H2.02123C1.49589 2.38767 1.0774 1.96027 1.0774 1.44384C1.0774 0.927397 1.50479 0.5 2.03014 0.5H12.0562C12.1274 0.5 12.1986 0.508904 12.2788 0.526712L12.4034 0.562329L12.537 0.633562C12.5637 0.65137 12.5993 0.678082 12.626 0.69589C12.6973 0.749315 12.7507 0.80274 12.7952 0.856164C12.8219 0.891781 12.8575 0.927397 12.8842 0.989726L12.9555 1.1411L12.9822 1.22123C13 1.29247 13.0089 1.3726 13.0089 1.44384V11.4699C13.0089 11.9952 12.5815 12.4137 12.0651 12.4137C11.5486 12.4137 11.1212 11.9863 11.1212 11.4699V3.72329L1.62055 13.224C1.44247 13.4021 1.20205 13.5 0.943836 13.5Z" fill="white" />
                          </svg> 
                        </span>
                      </div>
                  </div>
                  <div class="tp-hero-bottom-line mt-100"></div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- hero area end -->
    
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Slider() );