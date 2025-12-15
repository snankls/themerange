<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Services extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-services';
    }
	
	public function get_title(){
        return esc_html__( 'TR Services', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
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
        $services = new \WP_Query($args);
		
		if($services->have_posts()) {
	?>
    
    	<?php ob_start();
        $data_posts = '';
		$fliteration = array();
		while($services->have_posts() ): $services->the_post();
			global $post;
			$post_terms = get_the_terms( get_the_id(), 'portfolio_cat');
			foreach( (array)$post_terms as $pos_term )
				$fliteration[$pos_term->term_id] = $pos_term;
				$temp_category = get_the_term_list(get_the_id(), 'portfolio_cat', '', ', ');
				
				$post_terms = wp_get_post_terms( get_the_id(), 'portfolio_cat');
				$term_slug = '';
				
				if($post_terms)
					foreach($post_terms as $p_term)
						$term_slug .= $p_term->slug.' ';
						$term_list = wp_get_post_terms(get_the_id(), 'portfolio_cat', array("fields" => "names"));
					?>
					
					<div class="col-lg-4 <?php echo esc_attr($term_slug); ?>">
						<div class="portfolio_block portfolio_layout_2">
							<div class="portfolio_image">
                            	<span><?php echo wp_kses(get_post_meta($post->ID, 'tr_price', true), $allowed_html); ?></span>
								<a href="<?php echo esc_url(get_permalink(get_the_id())); ?>" class="portfolio_image_wrap bg-light">
									<?php echo get_the_post_thumbnail(); ?>
								</a>
							</div>
							<div class="portfolio_content">
								<h3 class="portfolio_title">
									<a href="<?php echo esc_url(get_permalink(get_the_id())); ?>">
										<?php echo get_the_title(); ?>
									</a>
								</h3>
								<ul class="category_list unordered_list">
									<li><?php echo esc_attr($term_slug); ?></li>
								</ul>
							</div>
						</div>
					</div>
                        
		<?php endwhile; ?>

		<?php wp_reset_postdata();
		$data_posts = ob_get_contents();
		ob_end_clean();
		ob_start(); ?>
        
        <!-- Service Section - Start
		================================================== -->
		<section class="service_section section_space xb-hidden pb-0">
		<div class="container">
			<div class="heading_block text-center">
			<div class="heading_focus_text">
				Our 
				<span class="badge bg-secondary text-white">Services</span>
			</div>
			<h2 class="heading_text mb-0">
				Software & Web Development Solutions
			</h2>
			</div>

			<div class="row">

			<!-- WordPress Development -->
			<div class="col-lg-6">
				<div class="service_block">
				<div class="service_image">
					<img src="assets/images/services/service_image_1.webp" alt="WordPress Development">
				</div>
				<div class="service_content">
					<h3 class="service_title">
					<a href="service_details.html">
						WordPress Development
					</a>
					</h3>
					<div class="links_wrapper">
					<ul class="category_btns_group unordered_list">
						<li><a href="#!">Custom Themes</a></li>
						<li><a href="#!">Plugins</a></li>
						<li><a href="#!">Speed & SEO</a></li>
					</ul>
					<a class="icon_block" href="service_details.html">
						<i class="fa-regular fa-arrow-up-right"></i>
					</a>
					</div>
				</div>
				</div>
			</div>

			<!-- PHP Development -->
			<div class="col-lg-6">
				<div class="service_block">
				<div class="service_image">
					<img src="assets/images/services/service_image_2.webp" alt="PHP Development">
				</div>
				<div class="service_content">
					<h3 class="service_title">
					<a href="service_details.html">
						PHP & Backend Development
					</a>
					</h3>
					<div class="links_wrapper">
					<ul class="category_btns_group unordered_list">
						<li><a href="#!">Laravel</a></li>
						<li><a href="#!">APIs</a></li>
						<li><a href="#!">Databases</a></li>
					</ul>
					<a class="icon_block" href="service_details.html">
						<i class="fa-regular fa-arrow-up-right"></i>
					</a>
					</div>
				</div>
				</div>
			</div>

			<!-- MERN Stack -->
			<div class="col-lg-4">
				<div class="service_block">
				<div class="service_image">
					<img src="assets/images/services/service_image_3.webp" alt="MERN Stack Development">
				</div>
				<div class="service_content">
					<h3 class="service_title">
					<a href="service_details.html">
						MERN Stack Development
					</a>
					</h3>
					<div class="links_wrapper">
					<ul class="category_btns_group unordered_list">
						<li><a href="#!">MongoDB</a></li>
						<li><a href="#!">Express</a></li>
						<li><a href="#!">React</a></li>
						<li><a href="#!">Node.js</a></li>
					</ul>
					<a class="icon_block" href="service_details.html">
						<i class="fa-regular fa-arrow-up-right"></i>
					</a>
					</div>
				</div>
				</div>
			</div>

			<!-- MEAN Stack -->
			<div class="col-lg-4">
				<div class="service_block">
				<div class="service_image">
					<img src="assets/images/services/service_image_4.webp" alt="MEAN Stack Development">
				</div>
				<div class="service_content">
					<h3 class="service_title">
					<a href="service_details.html">
						MEAN Stack Development
					</a>
					</h3>
					<div class="links_wrapper">
					<ul class="category_btns_group unordered_list">
						<li><a href="#!">MongoDB</a></li>
						<li><a href="#!">Express</a></li>
						<li><a href="#!">Angular</a></li>
						<li><a href="#!">Node.js</a></li>
					</ul>
					<a class="icon_block" href="service_details.html">
						<i class="fa-regular fa-arrow-up-right"></i>
					</a>
					</div>
				</div>
				</div>
			</div>

			<!-- UI/UX & Mobile -->
			<div class="col-lg-4">
				<div class="service_block">
				<div class="service_image">
					<img src="assets/images/services/service_image_5.webp" alt="UI UX & Mobile App Development">
				</div>
				<div class="service_content">
					<h3 class="service_title">
					<a href="service_details.html">
						UI/UX & Mobile App Development
					</a>
					</h3>
					<div class="links_wrapper">
					<ul class="category_btns_group unordered_list">
						<li><a href="#!">UI/UX Design</a></li>
						<li><a href="#!">React Native</a></li>
						<li><a href="#!">User Research</a></li>
					</ul>
					<a class="icon_block" href="service_details.html">
						<i class="fa-regular fa-arrow-up-right"></i>
					</a>
					</div>
				</div>
				</div>
			</div>

			</div>

			<div class="btns_group pb-0">
			<a class="btn btn-outline-light" href="service.html">
				<span class="btn_label" data-text="View All Services">View All Services</span>
				<span class="btn_icon">
				<i class="fa-solid fa-arrow-up-right"></i>
				</span>
			</a>
			</div>
		</div>
		</section>
		<!-- Service Section - End
		================================================== -->
        
	<?php }
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Services() );