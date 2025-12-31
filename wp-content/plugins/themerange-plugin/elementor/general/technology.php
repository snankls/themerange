<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Technology extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-technology';
    }
	
	public function get_title(){
        return esc_html__( 'TR Technology', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		//Technology
		$this->start_controls_section(
			'technology_tab',
			array(
				'label' => esc_html__( 'Technology', 'themerange' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'themerange'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'icon_tag',
			[
				'label' => esc_html__('Icon Tag', 'themerange'),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		$this->add_control(
			'technology',
			[
				'label'       => __( 'Technology', 'themerange' ),
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
        
        <!-- tp-techonolgy-area-start  -->
		<div class="tp-techonolgy-area tp-bg-common-white-2 pt-100 tp-techonolgy-capsule-wrapper" data-tp-throwable-scene="true">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-8">
						<div class="tp-techonolgy-title-wrap">
							<h2 class="fs-50 fs-xs-40 lh-120-per mb-60 tp_fade_anim" data-delay=".3">We Use Awesome<br> Technology.</h2>
							<div class="tp-service-2-para tp-techonolgy-para tp_fade_anim" data-delay=".5">
								<p class="fs-18">A high-growth startup agency relies on the best<br> technologies to deliver branding, marketing, and<br> product development.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4">
						<div class="tp-techonolgy-ratings-inner mt-30 p-relative">
							<div class="tp-hero-sa-shape-2 tp-techonolgy-shape tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
								<span class="shape-1 mb-5">
									<svg width="41" height="20" viewBox="0 0 41 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M20.6087 -1.90735e-06C9.34689 -1.90735e-06 0.217392 8.70558 0.217392 19.4445H41C41 8.70558 31.8705 -1.90735e-06 20.6087 -1.90735e-06Z" fill="#030303" />
									</svg>
								</span>
								<span class="shape-2">
									<svg width="67" height="44" viewBox="0 0 67 44" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M67 0.25H0V44L67 0.25Z" fill="#7D5DFF" />
									</svg>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="tp-techonolgy-capsule-item-wrapper">
				<?php foreach($settings['technology'] as $index => $item) : ?>
				<p data-tp-throwable-el="">
					<span class="tp-techonolgy-capsule-item">
						<?php echo $item['icon_tag']; ?>
						<?php echo wp_kses($item['title'], true); ?>
					</span>
				</p>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- tp-techonolgy-area-end  -->
        
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Technology() );