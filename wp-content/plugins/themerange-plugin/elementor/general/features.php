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
    //General
		$this->start_controls_section(
      'general_tab',
      array(
        'label' => esc_html__( 'General', 'themerange' ),
        'tab' => Controls_Manager::TAB_CONTENT,
      )
    );
    $this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'themerange'),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
    $this->add_control(
			'bottom_text',
			[
				'label' => esc_html__('Bottom Text', 'themerange'),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
    $this->add_control(
      'btn_name',
      [
        'label' => __( 'Name', 'themerange' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Read More', 'themerange' ),
      ]
    );
    $this->add_control(
      'btn_link',
      [
        'label' => __( 'Link', 'themerange' ),
        'type' => Controls_Manager::URL,
        'placeholder' => __( 'https://your-link.com', 'themerange' ),
        'show_external' => true,
        'dynamic'  => array( 'active' => true ),
        'default' => array( 'url' => '' ),
      ]
      );
		$this->end_controls_section();

		//Features
		$this->start_controls_section(
      'features_tab',
      array(
        'label' => esc_html__( 'Features', 'themerange' ),
        'tab' => Controls_Manager::TAB_CONTENT,
      )
    );

    $repeater = new Repeater();
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

    $link_attr = $this->generate_link_attributes( $btn_link );
		$allowed_html = tr_allowed_html();
	?>
    
    <!-- tp-skill-area-start -->
    <div class="tp-skill-area bg-position pt-100 pb-95">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center mb-60">
              <h2 class="tp-ff-teko tp-text-perspective fw-600 fs-70 fs-sm-60 fs-xs-42 text-uppercase tp-text-common-white lh-1"><?php echo esc_attr($settings['title']); ?></h2>
            </div>
          </div>

          <?php foreach($settings['features'] as $index => $item) : ?>
          <div class="col-lg-4 col-md-6">
            <div class="tp-skill-wd-item tpshake-wrap p-relative pb-50 pt-50 tp_fade_anim" data-delay=".4" data-fade-from="left">
              <span class="tp-skill-wd-border">
                <svg width="6" height="330" viewBox="0 0 6 330" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.5 5L5.88675 0H0.113249L2.5 5H3.5ZM2.5 325L0.113249 330H5.88675L3.5 325H2.5ZM2.5 4.5V325.5H3.5V4.5H2.5Z" fill="white" fill-opacity="0.1" />
                </svg>
              </span>
              <span class="tp-skill-wd-icon mb-35">
                <?php \Elementor\Icons_Manager::render_icon($item['icon']); ?>
              </span>
              <h3 class="tp-ff-teko fw-600 fs-35 fs-lg-30 tp-text-theme-primary mb-20"><?php echo esc_attr($item['highlighted_title']); ?> <span class="tp-text-common-white"><?php echo esc_attr($item['normal_title']); ?></span></h3>
              <p class="fs-18 tp-text-grey-2"><?php echo esc_attr($item['text']); ?></p>
            </div>
          </div>
          <?php endforeach; ?>
          
          <div class="col-lg-12">
            <div class="tp-skill-wd-bottom text-center mt-35 tp_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
              <p class="tp-skill-wd-para fw-500 fs-18 tp-text-common-white"><?php echo esc_attr($settings['bottom_text']); ?>
                <a <?php echo implode(' ', $link_attr); ?> class="ml-40 d-inline-block lh-0 tp-round-26 fs-15 text-uppercase ls-0 tp-btn-switch-animation tp-text-theme-primary tp-ff-heading fw-500">
                  <span class="d-flex align-items-center justify-content-center">
                    <span class="btn-text"><?php echo esc_attr($settings['btn_name']); ?></span>
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