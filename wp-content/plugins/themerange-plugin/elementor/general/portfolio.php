<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
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
		//Query {Item Count, Category, Excerpt}
		$this->tr_add_query_controls(8, 'portfolio_cat', 'no');
		
		//Settings
		$this->start_controls_section(
            'setting_tab',
            array(
                'label' => esc_html__( 'Settings', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );
		$this->add_control(
			'show_columns',
			array(
				'label' => esc_html__( 'Show Columns', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2column',
				'options' => array(
					'2column'	=> esc_html__( '2 Columns', 'themerange' ),
					'3column'	=> esc_html__( '3 Columns', 'themerange' ),
					'4column'	=> esc_html__( '4 Columns', 'themerange' ),
					'5column'	=> esc_html__( '5 Columns', 'themerange' ),
					'6column'	=> esc_html__( '6 Columns', 'themerange' ),
				),
			)
		);
		$this->add_control(
			'show_thumbnail',
			array(
				'label' => esc_html__( 'Show Image', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'0'	=> esc_html__( 'No', 'themerange' ),
					'1'	=> esc_html__( 'Yes', 'themerange' ),
				),
			)
		);
		$this->add_control(
			'show_lightbox_image',
			array(
				'label' => esc_html__( 'Show Lightbox Image', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'0'	=> esc_html__( 'No', 'themerange' ),
					'1'	=> esc_html__( 'Yes', 'themerange' ),
				),
			)
		);
		$this->add_control(
			'show_link',
			array(
				'label' => esc_html__( 'Show Link', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'0'	=> esc_html__( 'No', 'themerange' ),
					'1'	=> esc_html__( 'Yes', 'themerange' ),
				),
			)
		);
		$this->add_control(
			'show_pagination_button',
			array(
				'label'			=> esc_html__( 'Pagination / Button', 'themerange' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> '',
				'options'		=> array(
					''				=> esc_html__( 'None', 'themerange' ),
					'pagination'	=> esc_html__( 'Pagination', 'themerange' ),
					'button' 		=> esc_html__( 'Button', 'themerange' ),
				),
				'condition' => array( 'layout' => array('layout1, layout3, layout4, layout5') ),
			)
		);
		$this->add_control(
            'portfolio_btn_style',
            array(
                'label' => esc_html__('Style', 'themerange'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'two',
                'options' => tr_button_style(),
				'condition' => array( 'show_pagination_button' => 'button' ),
            )
        );
		$this->add_control(
            'pagination_btn_name',
            array(
                'label' => __( 'Name', 'themerange' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'themerange' ),
				'condition' => array( 'show_pagination_button' => 'button' ),
			)
        );
        $this->add_control(
            'pagination_btn_link',
            array(
                'label' => __( 'Link', 'themerange' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'themerange' ),
                'show_external' => true,
                'dynamic'  => array( 'active' => true ),
				'default' => array( 'url' => '' ),
				'condition' => array( 'show_pagination_button' => 'button' ),
            )
        );
		$this->add_responsive_control(
			'portfolio_button_alignment',
			array(
				'label' => esc_html__( 'Alignment', 'themerange' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'themerange' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themerange' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themerange' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .load-more-wrapper, {{WRAPPER}} .styled-pagination' => 'text-align: {{VALUE}}',
				],
				'default' => 'center',
				'condition' => array(
                    'show_pagination_button' => array('pagination', 'button')
                ),
			)
		);
		$this->end_controls_section();
		
		//Style Tab
		$this->register_style_background_controls();
	}
	
	protected function register_style_background_controls() {
		//Layout
		$this->add_layout_style_controls();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
		
		global $post, $wp_query, $tr_portfolio;
        $paged = get_query_var('paged');
        $paged = get_post_meta($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;
		
		$args = array(
			'post_type'			=> 'tr_portfolio',
			'post_status'		=> 'publish',
			'posts_per_page'	=> $limit,
			'orderby' 			=> $orderby,
			'order' 			=> $order,
            'paged'				=> $paged
		);
		
		//Terms
        if( $categories ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_cat',
					'field' => 'slug',
					'terms' => $categories,
				)
			);
		}
        $portfolio = new \WP_Query($args);
		
		if($portfolio->have_posts()) {
	?>
        
        <!-- tp-portfolio-area-start -->
		<div class="tp-portfolio-area pt-115">
			<div class="container-fluid container-1800">
				<div class="row">
					<div class="col-12">
						<div class="tp-portfolio-wd-title-wrap text-center mb-70">
							<h2 class="tp-portfolio-wd-title tp-ff-teko fw-600 text-uppercase tp-text-perspective">Latest Work</h2>
							<div class="tp-portfolio-tag tp-portfolio-wd-tag tp_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
								<svg class="mr-30" height="6" viewBox="0 0 153 6" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M5 2.5L0 0.113249V5.88675L5 3.5V2.5ZM148 3.5L153 5.88675V0.113249L148 2.5V3.5ZM4.5 3.5H148.5V2.5H4.5V3.5Z" fill="#030303" />
								</svg>
							</div>
						</div>
						<div class="tp-portfolio-wd-wrap des-portfolio-wrap">
							<div class="tp-portfolio-wd-item des-portfolio-panel p-relative not-hide-cursor mb-30" data-cursor="View<br>Demo">
								<a class="cursor-hide" href="portfolio-details-light.html">
									<div class="tp-portfolio-wd-thumb p-relative">
									<img src="https://html.aqlova.com/aleric-prev/aleric/assets/img/portfolio/wd/thumb.jpg" alt="">
									</div>
									<div class="tp-portfolio-wd-category">
										<span>Research</span>
										<span>Development</span>
									</div>
									<div class="tp-portfolio-wd-category portfolio-meta">
										<span>2025</span>
									</div>
								</a>
								<div class="tp-portfolio-wd-content">
									<h2 class="tp-ff-teko tp-text-common-white fs-100 fs-lg-70 fs-md-50 fs-xs-40 lh-1 fw-500"><a href="portfolio-details-light.html">Polygona Arct Design</a></h2>
								</div>
							</div>
							<div class="tp-portfolio-wd-item des-portfolio-panel p-relative not-hide-cursor mb-30" data-cursor="View<br>Demo">
								<a class="cursor-hide" href="portfolio-details-light.html">
									<div class="tp-portfolio-wd-thumb p-relative">
										<img src="https://html.aqlova.com/aleric-prev/aleric/assets/img/portfolio/wd/thumb.jpg" alt="">
									</div>
									<div class="tp-portfolio-wd-category">
										<span>Research</span>
										<span>Development</span>
									</div>
									<div class="tp-portfolio-wd-category portfolio-meta">
										<span>2025</span>
									</div>
								</a>
								<div class="tp-portfolio-wd-content">
									<h2 class="tp-ff-teko tp-text-common-white fs-100 fs-lg-70 fs-md-50 fs-xs-40 lh-1 fw-500"><a href="portfolio-details-light.html">Epic Strategy App</a></h2>
								</div>
							</div>
							<div class="tp-portfolio-wd-item des-portfolio-panel p-relative not-hide-cursor mb-30" data-cursor="View<br>Demo">
								<a class="cursor-hide" href="portfolio-details-light.html">
									<div class="tp-portfolio-wd-thumb p-relative">
										<img src="https://html.aqlova.com/aleric-prev/aleric/assets/img/portfolio/wd/thumb.jpg" alt="">
									</div>
									<div class="tp-portfolio-wd-category">
										<span>Research</span>
										<span>Development</span>
									</div>
									<div class="tp-portfolio-wd-category portfolio-meta">
										<span>2025</span>
									</div>
								</a>
								<div class="tp-portfolio-wd-content">
									<h2 class="tp-ff-teko tp-text-common-white fs-100 fs-lg-70 fs-md-50 fs-xs-40 lh-1 fw-500"><a href="portfolio-details-light.html">Making Brands Shine</a></h2>
								</div>
							</div>
							<div class="tp-portfolio-wd-item des-portfolio-panel p-relative not-hide-cursor mb-30" data-cursor="View<br>Demo">
								<a class="cursor-hide" href="portfolio-details-light.html">
									<div class="tp-portfolio-wd-thumb p-relative">
										<img src="https://html.aqlova.com/aleric-prev/aleric/assets/img/portfolio/wd/thumb.jpg" alt="">
									</div>
									<div class="tp-portfolio-wd-category">
										<span>Research</span>
										<span>Development</span>
									</div>
									<div class="tp-portfolio-wd-category portfolio-meta">
										<span>2025</span>
									</div>
								</a>
								<div class="tp-portfolio-wd-content">
									<h2 class="ttp-ff-teko tp-text-common-white fs-100 fs-lg-70 fs-md-50 fs-xs-40 lh-1 fw-500"><a href="portfolio-details-light.html">Creating Impact Online</a></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- tp-portfolio-area-end -->
        
	<?php }
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Portfolio() );