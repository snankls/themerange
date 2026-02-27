<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Portfolio extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-portfolio';
    }
	
	public function get_title(){
        return esc_html__( 'TR Portfolio', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	public function get_script_depends() {
		wp_register_script( 'portfolio-carousels', THEMERANGE_URL . 'assets/js/portfolio.js', [ 'elementor-frontend' ], THEMERANGE_VERSION, true );
		return [ 'portfolio-carousels' ];
	}
	
	protected function register_controls(){
		//Heading
		$this->tr_add_heading_controls();
		
		//Text
		$this->tr_add_text_controls();

		//Portfolio
		$this->start_controls_section(
			'portfolio_tab',
			array(
				'label' => esc_html__( 'Portfolio', 'themerange' ),
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
			'category',
			[
				'label' => esc_html__('Category', 'themerange'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'image',
			array(
				'label' => esc_html__( 'Image', 'themerange' ),
				'type' => Controls_Manager::MEDIA,
				'default' => array( 'id' => '', 'url' => '' ),
				'description' => '',
			)
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'themerange' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'themerange' ),
				'show_external' => true,
				'dynamic'  => array( 'active' => true ),
				'default' => array( 'url' => '' ),
			]
		);
		$this->add_control(
			'portfolio',
			[
				'label'       => __( 'Portfolio', 'themerange' ),
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
        
		<!-- tp-portfolio-area-start -->
		<div class="tp-portfolio-area portfolio__area pt-110 pb-135 p-relative">
			<img class="tp-portfolio-sa-shape" src="assets/img/portfolio/sa/shape.png" alt="">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
					<div class="tp-portfolio-sa-title-wrap pb-70 d-lg-flex align-items-end justify-content-center text-center">
						<span class="fw-500 fs-35 text-uppercase mb-40 mr-35 tp-text-common-black d-inline-block text-end">
							<svg class="mb-30" width="110" height="12" viewBox="0 0 110 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect y="10" width="110" height="2" rx="1" fill="#030303" />
								<rect x="60" width="50" height="2" rx="1" fill="#999999" />
							</svg>
							<span class="d-block">Selected</span>
						</span>
						<h2 class="tp-portfolio-sa-title text-uppercase portfolio__text tp-text-common-black">Work</h2>
						<span class="tp-ff-heading fw-500 fs-35 tp-text-grey-1 mb-40 ml-35">(2018-2025)</span>
					</div>
					</div>
				</div>

				<div class="row gx-50">
					<?php foreach($settings['portfolio'] as $index => $item) : ?>
					<div class="col-lg-6">
						<div class="tp-portfolio-sa-item mb-50 not-hide-cursor portfolio__item" data-cursor="View<br>Demo">
							<div class="tp-portfolio-sa-thumb mb-25">
								<a href="<?php echo wp_get_attachment_url($item['link']['url']); ?>" class="cursor-hide">
									<img src="<?php echo wp_get_attachment_url($item['image']['id']); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="w-100 mover">
								</a>
							</div>
							<div class="tp-portfolio-sa-content">
								<h4 class="tp-portfolio-sa-item-title fs-25 lh-1 mb-15"><a class="underline-black" href="<?php echo wp_get_attachment_url($item['link']['url']); ?>"><?php echo wp_kses($item['title'], true); ?></a></h4>
								<span class="tp-portfolio-sa-item-tag fw-700 fs-16 tp-text-grey-1 tp-ff-heading tp-bg-common-white-2 d-inline-block"><?php echo wp_kses($item['category'], true); ?></span>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>

				<div class="row">
					<div class="col-12">
					<div class="tp-rounded-btn-wrap mt-30 text-center tp_fade_anim" data-delay=".5" data-fade-from="top" data-ease="bounce">
						<div class="btn_wrapper d-inline-block">
							<a href="portfolio-col-4-light.html" class="tp-btn-rounded tp-ff-teko  btn-item">
								<span class="d-block mb-10">
								<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3791 3.0269C14.6431 2.80336 18.8916 1.42595 21.9998 0C20.5732 3.10763 19.1953 7.35556 18.9723 10.6196L16.8276 6.04382L1.05193 21.82C0.936264 21.9354 0.779526 22.0001 0.616152 22C0.494263 22 0.375118 21.9638 0.273781 21.8961C0.172441 21.8284 0.0934544 21.7321 0.046814 21.6195C0.000171661 21.5069 -0.0120335 21.383 0.0117397 21.2634C0.035511 21.1439 0.0941944 21.034 0.18037 20.9478L15.956 5.17221L11.3791 3.0269Z" fill="currentColor" />
								</svg>
								</span>
								View All<br> Works
								<i class="tp-btn-circle-dot"></i>
							</a>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<!-- tp-portfolio-area-end -->
		
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Portfolio() );