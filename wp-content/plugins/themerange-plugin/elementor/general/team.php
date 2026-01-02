<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Team extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-team';
    }
	
	public function get_title(){
        return esc_html__( 'TR Team', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	public function get_script_depends() {
		wp_register_script( 'swiper-carousels', THEMERANGE_URL . 'assets/js/swiper-script.js', [ 'elementor-frontend' ], THEMERANGE_VERSION, true );
		return [ 'swiper-carousels' ];
	}
	
	protected function register_controls(){
		//Layouts
		$this->tr_add_layout_controls(2);
		
		//Heading
		$this->tr_add_heading_controls();
		
		//Text
		$this->tr_add_text_controls();
		
		//Button
		$this->tr_add_button_controls();
		
		//Query {Item Count, Category}
		$this->tr_add_query_controls(3, 'team_cat');
		
		//Settings
		$this->start_controls_section(
            'setting_tab',
            array(
                'label' => esc_html__( 'Settings', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );
		$this->add_control(
			'show_title',
			array(
				'label' => esc_html__( 'Show Title', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'0'	=> esc_html__( 'No', 'themerange' ),
					'1'	=> esc_html__( 'Yes', 'themerange' ),
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
			'show_designation',
			array(
				'label' => esc_html__( 'Show Designation', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'0'	=> esc_html__( 'No', 'themerange' ),
					'1'	=> esc_html__( 'Yes', 'themerange' ),
				),
			)
		);
		$this->add_control(
			'show_social_icons',
			array(
				'label' => esc_html__( 'Show Social Icons', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'0'	=> esc_html__( 'No', 'themerange' ),
					'1'	=> esc_html__( 'Yes', 'themerange' ),
				),
			)
		);
		$this->add_control(
            'target',
            array(
                'label' 		=> esc_html__( 'Target', 'themerange' ),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> '_self',
				'options'		=> array(
					'_blank'	=> esc_html__( 'Open New Tab', 'themerange' ),
					'_self'		=> esc_html__( 'Open Same Tab', 'themerange' ),
				),
                'description' => '',
				'condition' => array( 'show_social_icons' => '1' ),
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
				'condition' => array('layout' => 'layout2')
			)
		);
		$this->add_control(
            'post_btn_style',
            array(
                'label' => esc_html__('Style', 'themerange'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'two',
                'options' => tr_button_style(),
				'condition' => array( 'show_pagination_button' => 'button' ),
            )
        );
		$this->add_control(
            'post_btn_name',
            array(
                'label' => __( 'Name', 'themerange' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'themerange' ),
				'condition' => array( 'show_pagination_button' => 'button' ),
			)
        );
        $this->add_control(
            'post_btn_link',
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
			'post_button_alignment',
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
					'{{WRAPPER}} .team-button, {{WRAPPER}} .styled-pagination' => 'text-align: {{VALUE}}',
				],
				'default' => 'center',
				'condition' => array(
                    'show_pagination_button' => array('pagination', 'button')
                ),
			)
		);
		$this->end_controls_section();
		
		//ThemeRange Swiper Options		(loop, autoplay, autoplay_delay, item_show, item_space, item_speed, arrows, dots
		$this->tr_swiper_addtional_options('true', 'true', 6000, 3, 25, 500, 'yes', 'no');
		
		//Style Tab
		$this->register_style_background_controls();
	}
	
	protected function register_style_background_controls() {
		//Layout
		$this->add_layout_style_controls('.tr-team');
		
		//Post Style
		$this->start_controls_section(
			'post_style_tab',
			array(
				'label' => esc_html__('Post Style', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'title_typography',
                'label' => __('Title Typography', 'themerange'),
                'selector' => '{{WRAPPER}} .tr-heading',
            )
        );
		
		//Color Tabs
		$this->start_controls_tabs( 'title_achor_colors' );
		$this->start_controls_tab(
			'title_colors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tr-heading a' => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_colors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
			'title_color_hover',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-heading a:hover' => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		//Heading Tag
		$this->add_control(
			'title_tag',
			array(
				'label' => esc_html__( 'HTML Tag', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'options' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
					'strong' => 'strong',
				),
				'default' => 'h5',
			)
		);
		
		//Designation
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'designation_typography',
                'label' => __('Designation Typography', 'themerange'),
                'selector' => '{{WRAPPER}} .tr-designation',
				'separator' => 'before',
            )
        );
		$this->add_control(
			'designation_color',
			array(
				'label' => esc_html__( 'Designation Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-designation' => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
		
		global $post, $wp_query, $tr_team;
		$paged = get_query_var('paged');
        $paged = get_post_meta($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;
		$args = array(
			'post_type'			=> 'tr_team',
			'post_status'		=> 'publish',
			'posts_per_page'	=> $limit,
			'orderby' 			=> $orderby,
			'order' 			=> $order,
            'paged'				=> $paged,
		);
		
		if( $categories ){
			$args['team_cat'] = $categories;
		}
		
		$team = new WP_Query($args);
		if( $team->have_posts() ){
		?>
        
		<!-- tp-team-area-start -->
		<div class="tp-team-area pt-110 pb-50">
			<div class="container">
				<div class="row">
					<div class="col-xl-4 col-lg-3 col-md-3 d-none d-md-block">
						<div class="tp-about-wd-shape tp-team-sa-shape tp-about-sa-shape">
							<span class="shape-1 d-inline-block mr-10" data-speed=".9">
								<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0 40C0 17.9086 17.9086 0 40 0V40H0Z" fill="#7D5DFF" />
								</svg>
							</span>
							<span class="shape-1 mb-15">
								<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M40 40C40 17.9086 22.0914 0 0 0V40H40Z" fill="#030303" />
								</svg>
							</span>
						</div>
					</div>
					<div class="col-xl-6 col-lg-8 col-md-9">
						<div class="tp-team-sa-title-wrap">
							<h2 class="tp-team-sa-title mb-25 tp_fade_anim" data-delay=".3"><?php echo $title; ?></h2>
							<div class="tp-service-2-para tp-techonolgy-para tp-team-sa-para tp_fade_anim" data-delay=".5">
								<p class="fs-18"><?php echo $text; ?></p>
							</div>
						</div>
					</div>
					
					<?php while( $team->have_posts() ){
						$team->the_post();
					?>
					<div class="col-lg-3 col-md-6">
						<div class="tp-team-sa-item mb-90" data-speed=".-9">
							<div class="tp-team-sa-thumb mb-20 tp--hover-item p-relative">
								<div class="tp--hover-img" data-displacement="assets/img/team/thumb-4.jpg" data-intensity="0.6" data-speedin="1" data-speedout="1">
									<?php the_post_thumbnail('team_310x400'); ?>
								</div>
							</div>
							<div class="tp-team-sa-content text-center">
								<h5 class="tp-ff-heading fw-500 fs-25 mb-5"><?php echo get_the_title(); ?></h5>
								<span class="fs-16 tp-text-grey-1"><?php echo wp_kses(get_post_meta($post->ID, 'tr_designation', true), $allowed_html); ?></span>
							</div>
						</div>
					</div>
					<?php }
						wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
		<!-- tp-team-area-end -->
        
		<?php }
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Team() );