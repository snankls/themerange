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
    
    	<?php ob_start();
        $data_posts = '';
		$fliteration = array();
		while($portfolio->have_posts() ): $portfolio->the_post();
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
        
        <!-- Portfolio Section - Start
        ================================================== -->
        <section class="portfolio_section section_space bg-light">
          <div class="container">
            <div class="filter_elements_nav">
              <ul class="unordered_list justify-content-center">
                <li class="active" data-filter="all"><?php esc_html_e('See All', 'themerange'); ?></li>
                <?php foreach($fliteration as $t): ?>
                <li data-filter="<?php echo esc_attr($t->slug); ?>"><?php echo wp_kses($t->name, $allowed_html); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="filter_elements_wrapper row">
            	<?php echo wp_kses($data_posts, $allowed_html); ?>
            </div>
          </div>
        </section>
        <!-- Portfolio Section - End
        ================================================== -->
        
	<?php }
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Portfolio() );