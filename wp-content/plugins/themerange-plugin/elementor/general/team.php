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
		//Heading
		$this->tr_add_heading_controls();
		
		//Text
		$this->tr_add_text_controls();
		
		//Query {Item Count, Category}
		$this->tr_add_query_controls(4, 'team_cat');
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