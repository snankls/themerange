<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class TR_Elementor_Widget_Partners extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-partners';
    }
	
	public function get_title(){
        return esc_html__( 'TR Icon Box', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		//Layouts
		$this->tr_add_layout_controls(2);
		
		//Icon Box
		$this->start_controls_section(
            'section_partners',
            array(
                'label' => esc_html__( 'Icon Box', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT
            )
        );
		
		//Start repeater
		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'themerange'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'themerange'),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'themerange'),
				'type' => Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__('URL', 'themerange'),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'dynamic'  => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
			]
		);
		$this->add_control(
			'partners',
			[
				'label'       => __( 'Icon Box', 'themerange' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
		);
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$link_attr = $this->generate_link_attributes( $link );
		$allowed_html = tr_allowed_html();
	?>
        
		<!-- Client Logo Section - Start
        ================================================== -->
        <section class="client_logo_section section_space" style="background-image: url('assets/images/shapes/bg_pattern_1.svg');">
        	<div class="container">
				<div class="section_space pt-0">
					<div class="client_logo_carousel swiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="client_logo_item">
								<img src="assets/images/clients/client_logo_1.webp" alt="Techco - Client Logo Image">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Client Logo Section - End
		================================================== -->
    
    <?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Partners() );
