<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class TR_Elementor_Widget_Features extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-features';
    }
	
	public function get_title(){
        return esc_html__( 'TR Features', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	protected function register_controls(){
		//Features
		$this->start_controls_section(
      'features_tab',
      array(
      'label' => esc_html__( 'Features', 'themerange' ),
      'tab' => Controls_Manager::TAB_CONTENT,
      )
    );
    $repeater->add_control(
			'highlighted_title',
			[
				'label' => esc_html__('Highlighted Title', 'themerange'),
				'type' => Controls_Manager::TEXT,
			]
		);
    $repeater->add_control(
			'normal_title',
			[
				'label' => esc_html__('Normal Title', 'themerange'),
				'type' => Controls_Manager::TEXT,
			]
		);
    $repeater->add_control(
      'icon',
      array(
          'label' => esc_html__( 'Icon', 'themerange' ),
          'type' => Controls_Manager::ICONS,
          'default' => array( 'id' => '', 'url' => '' ),
          'description' => '',
      )
    );
    $repeater->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'themerange'),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		$this->add_control(
			'features',
			[
				'label'       => __( 'Features', 'themerange' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ highlighted_title }}}',
			]
		);
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
	?>
    
    <!-- tp-skill-area-start -->
    <div class="tp-skill-area bg-position pt-100 pb-95" data-background="assets/img/skill/bg.jpg">
        <div class="container">
          <div class="row">
              <div class="col-lg-12">
                <div class="text-center mb-60">
                    <h2 class="tp-ff-teko tp-text-perspective fw-600 fs-70 fs-sm-60 fs-xs-42 text-uppercase tp-text-common-white lh-1">Proven Experience <br> on Digital Platform.</h2>
                </div>
              </div>

              <?php foreach($settings['features'] as $index => $item) : ?>
              <div class="col-lg-4 col-md-6">
                <div class="tp-skill-wd-item tpshake-wrap p-relative pb-50 pt-50 tp_fade_anim" data-delay=".4" data-fade-from="left">
                    <span class="tp-skill-wd-border">
                      <?php \Elementor\Icons_Manager::render_icon($item['icon']); ?>
                    </span>
                    <span class="tp-skill-wd-icon mb-35">
                      <svg class="tpshake" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M44.9609 30.8008C46.9336 29.0527 47.9883 27.0703 47.9883 25C47.9883 22.8906 46.875 20.8398 44.7754 19.043C46.8652 17.2559 47.9883 15.2148 47.9883 13.0762C47.9883 9.92187 45.5566 6.96289 41.1328 4.75586C36.7578 2.56836 30.9375 1.35742 24.7559 1.35742C18.5742 1.35742 12.7441 2.56836 8.36914 4.75586C3.94531 6.96289 1.51367 9.92187 1.51367 13.0762C1.51367 15.2148 2.62695 17.2559 4.72656 19.043C2.62695 20.8398 1.51367 22.8906 1.51367 25C1.51367 27.1387 2.62695 29.1797 4.72656 30.9668C2.62695 32.7637 1.51367 34.8145 1.51367 36.9238C1.51367 40.0781 3.94531 43.0371 8.36914 45.2441C12.7441 47.4316 18.5645 48.6426 24.7461 48.6426C30.9277 48.6426 36.748 47.4414 41.123 45.2441C41.8066 44.9023 42.4512 44.541 43.0371 44.1602C46.3281 42.1582 48.291 39.5898 48.291 36.7969C48.291 34.5996 47.0703 32.5488 44.9609 30.8008ZM1.9043 13.0762C1.9043 6.83594 12.1484 1.74805 24.7461 1.74805C37.3438 1.74805 47.5879 6.82617 47.5879 13.0762C47.5879 19.3164 37.3438 24.4043 24.7461 24.4043C12.1484 24.4043 1.9043 19.3164 1.9043 13.0762ZM24.7461 36.3281C12.1484 36.3281 1.9043 31.2402 1.9043 25C1.9043 22.9883 2.98828 21.0254 5.0293 19.2969C5.9668 20.0488 7.08008 20.7617 8.36914 21.3965C12.7441 23.584 18.5645 24.7949 24.7461 24.7949C30.9277 24.7949 36.748 23.5938 41.123 21.3965C42.4121 20.752 43.5254 20.0488 44.4629 19.2969C46.5039 21.0254 47.5879 22.998 47.5879 25C47.5879 31.2402 37.3438 36.3281 24.7461 36.3281Z" fill="#C4EE18" />
                      </svg>
                    </span>
                    <h3 class="tp-ff-teko fw-600 fs-35 fs-lg-30 tp-text-theme-primary mb-20"><?php echo esc_attr($item['highlighted_title']); ?> <span class="tp-text-common-white"><?php echo esc_attr($item['normal_title']); ?></span></h3>
                    <p class="fs-18 tp-text-grey-2"><?php echo esc_attr($item['text']); ?></p>
                </div>
              </div>
              <?php endforeach; ?>
              
              <div class="col-lg-12">
                <div class="tp-skill-wd-bottom text-center mt-35 tp_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                    <p class="tp-skill-wd-para fw-500 fs-18 tp-text-common-white">Don’t hesitate collaborate with expertise- 
                      <a href="contact-dark.html" class="ml-40 d-inline-block lh-0 tp-round-26 fs-15 text-uppercase ls-0 tp-btn-switch-animation tp-text-theme-primary tp-ff-heading fw-500">
                          <span class="d-flex align-items-center justify-content-center">
                            <span class="btn-text">Let’s Talk</span>
                            <span class="btn-icon">
                                <svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
                                </svg>
                            </span>
                            <span class="btn-icon">
                                <svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
                                </svg>
                            </span>
                        </span> 
                      </a>
                    </p>
                </div>
              </div>
          </div>
        </div>
    </div>
    <!-- tp-skill-area-end -->
    
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Features() );