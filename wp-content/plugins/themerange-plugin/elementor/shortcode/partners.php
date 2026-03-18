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
		//Background Image
		$this->tr_add_background_image_controls();

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
		$link_attr = $this->generate_link_attributes( $link );
		$allowed_html = tr_allowed_html();
	?>
        
		<!-- Client Logo Section - Start
        ================================================== -->
        <section class="client_logo_section" <?php if($pattern_image) : ?>style="background-image: url(<?php echo wp_get_attachment_url($pattern_image['id']); ?>)"<?php endif; ?>>
        	<div class="container">
				<div class="client_logo_carousel swiper">
					<div class="swiper-wrapper">
						<?php foreach($settings['partners'] as $index => $item) : ?>
						<div class="swiper-slide">
							<div class="client_logo_item">
								<img src="<?php echo wp_get_attachment_url($item['image']['id']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
							</div>
						</div>
						<?php endforeach; ?>
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
