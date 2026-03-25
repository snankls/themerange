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
        return esc_html__( 'TR Partners', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	public function get_script_depends() {
		wp_register_script( 'partners-carousels', THEMERANGE_URL . 'assets/js/partners.js', [ 'elementor-frontend' ], THEMERANGE_VERSION, true );
		return [ 'partners-carousels' ];
	}
	
	protected function register_controls(){
		//Partners
		$this->start_controls_section(
            'section_partners',
            array(
                'label' => esc_html__( 'Partners', 'themerange' ),
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
			'image',
			[
				'label' => esc_html__('Icon', 'themerange'),
				'type' => Controls_Manager::MEDIA,
                'default' => array( 'id' => '', 'url' => '' ),
                'description' => '',
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
				'label'       => __( 'Partners', 'themerange' ),
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
		$allowed_html = tr_allowed_html();
	?>
        
		<!-- tp-brands-area-start -->
		<div class="tp-brand-area tp-brand-spacing tp-bg-common-white z-index-1 p-relative">
			<span class="tp-brand-bottom-border"></span>
			<div class="tp-brand-customer-wrap">
				<span class="tp-brand-customer tp-ff-heading fs-18 fs-xs-15 fw-700 tp-text-common-black">We’ve 2,000+ Happiest Customer</span>
			</div>
			<div class="tp-brand-wrap">
				<div class="swiper-container tp-brand-slide-active">
					<div class="swiper-wrapper slide-transtion">
						<?php foreach($settings['partners'] as $index => $item) :
							//$link_attr = $this->generate_link_attributes( $link ); ?>
							<div class="swiper-slide">
								<div class="tp-brand-item">
									<a href="#">
										<img src="<?php echo wp_get_attachment_url($item['image']['id']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- tp-brands-area-end -->
    
    <?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Partners() );
