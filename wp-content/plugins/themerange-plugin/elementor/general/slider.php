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
    
		<!-- IT Solution Hero Section - Start
    ================================================== -->
    <section class="it_solution_hero_section">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="it_solution_hero_content" style="background-image: url('assets/images/shapes/it_solution_hero_bg_1.svg');">
              
              <div class="heading_focus_text mb-0 d-inline-flex align-items-center">
                👋 Welcome To <span class="badge bg-secondary text-white">Our Agency</span>
              </div>
              <h1>We Build Modern Websites That Grow Your Business</h1>
              <p>In today’s competitive market, every business needs efficient IT solutions, modern websites, and high-performance mobile apps to grow faster, work smarter, and stay ahead of the competition.</p>

              <ul class="btns_group unordered_list p-0 justify-content-start">
                <li>
                  <a class="btn" href="pricing.html">
                    <span class="btn_label" data-text="Get Started">Get Started</span>
                    <span class="btn_icon">
                      <i class="fa-solid fa-arrow-up-right"></i>
                    </span>
                  </a>
                </li>

                <li>
                  <a class="btn" href="pricing.html">
                    <span class="btn_label" data-text="Get Quote">Get Quote</span>
                    <span class="btn_icon">
                      <i class="fa-solid fa-arrow-up-right"></i>
                    </span>
                  </a>
                </li>
              </ul>

            </div>
          </div>

          <div class="col-lg-5">
            <ul class="it_solution_hero_images unordered_list">

              <li>
                <img src="assets/images/hero/it_solution_hero_image_1.webp" alt="Web & IT Services">
              </li>

              <li>
                <div class="worldwide_clients">
                  <div class="counter_value">150+</div>
                  <p>
                    Projects Delivered Across the Globe
                  </p>
                  <ul class="avatar_group unordered_list">
                    <li><img src="assets/images/avatar/avatar_1.webp" alt="Client"></li>
                    <li><img src="assets/images/avatar/avatar_2.webp" alt="Client"></li>
                    <li><img src="assets/images/avatar/avatar_3.webp" alt="Client"></li>
                    <li>5k+</li>
                  </ul>
                </div>
              </li>

              <li>
                <ul class="categories unordered_list_block">
                  <li>
                    <a href="#!">
                      <span>Web Development</span>
                      <i class="fa-solid fa-plus"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#!">
                      <span>WordPress & Ecommerce</span>
                      <i class="fa-solid fa-plus"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#!">
                      <span>Digital Strategy</span>
                      <i class="fa-solid fa-plus"></i>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                <div class="business_growth_content" style="background-image: url('assets/images/hero/it_solution_hero_image_2.webp');">
                  <div class="progress_content">
                    <div class="business_growth" data-pie='{ "percent": 92 }'></div>
                    <p>
                      92% Client Satisfaction & Business Growth
                    </p>
                  </div>
                </div>
              </li>

            </ul>
          </div>

        </div>
      </div>
    </section>
    <!-- IT Solution Hero Section - End
    ================================================== -->
    
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Slider() );