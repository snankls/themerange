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

class TR_Elementor_Widget_About_Us extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-about_us';
    }
	
	public function get_title(){
        return esc_html__( 'TR About_Us', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	protected function register_controls(){
		//About_Us
		$this->start_controls_section(
      'about_us_tab',
      array(
      'label' => esc_html__( 'About_Us', 'themerange' ),
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
		
		//Style Tab
		$this->register_style_background_controls();
	}
	
	/***********************************************
						Style Tab
	***********************************************/
	protected function register_style_background_controls() {
		//SubTitle
		$this->start_controls_section(
			'subtitle_tab',
			array(
				'label' => esc_html__('Sub Title', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		//Title
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'subtitle_typography',
                'label' => __('Sub Title Typography', 'themerange'),
                'selector' => '{{WRAPPER}} .tr-sub-heading',
            )
        );
		$this->add_control(
			'subtitle_color',
			array(
				'label' => esc_html__( 'Sub Title Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-sub-heading' => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_section();
		
		//Title
		$this->start_controls_section(
			'title_tab',
			array(
				'label' => esc_html__('Title', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		//Title
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'title_typography',
                'label' => __('Title Typography', 'themerange'),
                'selector' => '{{WRAPPER}} .tr-heading',
            )
        );
		$this->add_control(
			'title_color',
			array(
				'label' => esc_html__( 'Title Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tr-heading span' => '-webkit-text-stroke-color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_section();
		
		//Text
		$this->add_text_style_controls();
		
		//Button
		$this->add_button_style_controls();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
	?>
    
    <!-- tp-about-area-start -->
    <div id="about" class="tp-about-area pt-130 pb-110 p-relative z-index-1">
        <span class="tp-about-wd-shape-2">
          <svg width="452" height="382" viewBox="0 0 452 382" fill="none" xmlns="http://www.w3.org/2000/svg">
              <mask id="mask0_246_150" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="452" height="382">
                <rect x="-0.5" y="0.5" width="451" height="381" transform="matrix(-1 0 0 1 451 0)" fill="#D9D9D9" stroke="black" />
              </mask>
              <g mask="url(#mask0_246_150)">
                <circle cx="465.95" cy="465.95" r="405.95" transform="matrix(-1 0 0 1 923.516 0)" stroke="#F0F0F0" stroke-width="120" />
              </g>
          </svg>
        </span>
        <div class="container">
          <div class="row">
              <div class="col-xl-8 col-lg-10">
                <div class="tp-about-wd-title-wrap mb-50 tp_fade_anim" data-delay=".3">
                    <h2 class="tp-about-wd-title tp-ff-teko fw-600 fs-70 fs-sm-60 fs-xs-43 text-uppercase">We’re Global Brand<br>
                      <img src="assets/img/about/wd/shape.png" alt="">
                      Design Agency.</h2>
                </div>
                <div class="tp-about-wd-para-wrap mb-75">
                    <div class="row">
                      <div class="col-lg-6">
                          <div class="tp-about-wd-para mb-30 tp_fade_anim" data-delay=".5">
                            <p class="fs-18 fw-500">We believe a website isn’t just a<br> digital presence— <span class="tp-text-common-black">it’s a powerful tool<br> that tells your story.</span></p>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="tp-about-wd-para mb-30 tp_fade_anim" data-delay=".7">
                            <p class="fs-18">We’re a team of passionate designers, developers, and strategists dedicated to creating stunning, functional websites that align with your unique business goals.</p>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-xl-2 col-lg-2">
                <div class="tp-about-wd-shape tp_fade_anim" data-delay=".4" data-fade-from="top" data-ease="bounce">
                    <span class="shape-1 mb-10 d-inline-block">
                      <svg width="35" height="33" viewBox="0 0 35 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M35 0V33H0L35 0Z" fill="#C4EE18" />
                      </svg>
                    </span>
                    <span class="shape-1">
                      <svg width="80" height="40" viewBox="0 0 80 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M40 40C62.0914 40 80 22.0914 80 0H0C0 22.0914 17.9086 40 40 40Z" fill="#030303" />
                      </svg>
                    </span>
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="tp-about-wd-thumb-wrap mb-30 fix">
                    <img class="myimg w-100" data-speed=".9" src="assets/img/about/wd/thumb.jpg" alt="" >
                </div>
              </div>
              <div class="col-lg-3 col-md-6">
                <div class="tp-rounded-btn-wrap tp-about-wd-btn tp-rounded-btn-wd mt-100 text-md-end mr-40 mb-30 tp_fade_anim" data-delay=".9" data-fade-from="top" data-ease="bounce">
                    <div class="btn_wrapper d-inline-block">
                      <a href="about-modern-light.html" class="tp-btn-rounded tp-ff-teko btn-item">
                          Discover<br> More Today
                          <span class="d-block mt-10">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3791 3.0269C14.6431 2.80336 18.8916 1.42595 21.9998 0C20.5732 3.10763 19.1953 7.35556 18.9723 10.6196L16.8276 6.04382L1.05193 21.82C0.936264 21.9354 0.779526 22.0001 0.616152 22C0.494263 22 0.375118 21.9638 0.273781 21.8961C0.172441 21.8284 0.0934544 21.7321 0.046814 21.6195C0.000171661 21.5069 -0.0120335 21.383 0.0117397 21.2634C0.035511 21.1439 0.0941944 21.034 0.18037 20.9478L15.956 5.17221L11.3791 3.0269Z" fill="currentColor" />
                            </svg>
                          </span>
                          <i class="tp-btn-circle-dot"></i>
                      </a>
                    </div>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="tp-about-expreance tp-about-wd-expreance d-flex align-items-end mb-30 tp_fade_anim" data-delay=".9">
                    <h2 class="tp-ff-teko fw-600 fs-100 p-relative d-inline-block mb-0 lh-1">12 <span class="plus fs-25">+</span></h2>
                    <span class="fs-18 fw-500 lh-22 tp-text-common-black mb-15 ml-35">Years of<br> Experience</span>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="tp-about-wd-thumb2 p-relative mb-30">
                    <div class="tp-about-wd-thumb3 z-index-1" data-speed=".9">
                      <img class="myimg" src="assets/img/about/wd/thumb-2.jpg" alt="" >
                    </div>
                    <div class="tp-about-wd-thumb4">
                      <img class="myimg" src="assets/img/about/wd/thumb-3.jpg" alt="" >
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
    <!-- tp-about-area-end -->
    
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_About_Us() );