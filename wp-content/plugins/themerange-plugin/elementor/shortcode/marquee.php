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

class TR_Elementor_Widget_Marquee extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-marquee';
    }
	
	public function get_title(){
        return esc_html__( 'TR Marquee', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	protected function register_controls(){
		//Marquee
		$this->start_controls_section(
      'marquee_tab',
      array(
      'label' => esc_html__( 'Marquee', 'themerange' ),
      'tab' => Controls_Manager::TAB_CONTENT,
      )
    );

    $repeater = new Repeater();
    $repeater->add_control(
			'prefix_title',
			[
				'label' => esc_html__('Prefix Title', 'themerange'),
				'type' => Controls_Manager::TEXT,
			]
		);
    $repeater->add_control(
			'postfix_title',
			[
				'label' => esc_html__('Postfix Title', 'themerange'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'marquee',
			[
				'label'       => __( 'Marquee', 'themerange' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ prefix_title }}}',
			]
		);
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
	?>
    
    <!-- tp-text-slider-area-start -->
    <div class="tp-text-slider-area pt-25 pb-25 tp-bg-theme-primary">
      <div class="swiper-container tp-text-slider-active">
        <div class="swiper-wrapper slide-transtion">
          <?php foreach($settings['marquee'] as $index => $item) : ?>
          <div class="swiper-slide">
            <div class="tp-text-slider-item">
                <span><?php echo esc_attr($item['prefix_title']); ?></span>
                <span class="icons">
                  <svg width="68" height="12" viewBox="0 0 68 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M59.416 11.8926L67.62 6.76034C67.7367 6.67779 67.8325 6.56504 67.8989 6.43228C67.9652 6.29953 67.9999 6.15095 67.9999 6C67.9999 5.84905 67.9652 5.70048 67.8989 5.56772C67.8325 5.43496 67.7367 5.32221 67.62 5.23966L59.416 0.107354C59.2561 0.0134291 59.0719 -0.0202036 58.8925 0.0117582C58.713 0.04372 58.5485 0.139459 58.4248 0.28388C58.3011 0.428302 58.2254 0.613192 58.2094 0.809402C58.1935 1.00561 58.2383 1.20198 58.3369 1.36755L60.7161 5.11998L0.812592 5.11998C0.597076 5.11998 0.390396 5.21269 0.238007 5.37773C0.0856171 5.54277 0 5.7666 0 6C0 6.2334 0.0856171 6.45724 0.238007 6.62227C0.390396 6.78731 0.597076 6.88003 0.812592 6.88003C0.812592 6.88003 49.0381 6.88003 60.7161 6.88003L58.3369 10.6325C58.2383 10.798 58.1935 10.9944 58.2094 11.1906C58.2254 11.3868 58.3011 11.5717 58.4248 11.7161C58.5485 11.8605 58.713 11.9563 58.8925 11.9882C59.0719 12.0202 59.2561 11.9866 59.416 11.8926Z" fill="#030303" />
                  </svg>
                </span>
                <span><?php echo esc_attr($item['postfix_title']); ?></span>
                <span class="borders"></span>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- tp-text-slider-area-end -->
    
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Marquee() );