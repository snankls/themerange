<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

class TR_Elementor_Widget_Icon extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-icon';
    }
	
	public function get_title(){
        return esc_html__( 'TR Icon', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		// Icons
		$this->start_controls_section(
            'section_icon',
            array(
                'label' => esc_html__( 'Icon', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT
            )
        );
		$this->add_control(
            'icon',
            array(
                'label' => esc_html__('Icon', 'themerange' ),
				'type' => Controls_Manager::ICONS,
            )
        );
		$this->add_control(
            'link',
            array(
				'label' => esc_html__('Link', 'themerange'),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com/', 'themerange' ),
				'show_external' => true,
				'dynamic'  => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
            )
        );
		$this->end_controls_section();
		
		//Style Tab
		$this->register_style_background_controls();
	}
	
	/***********************************************
						Style Tab
	***********************************************/
	protected function register_style_background_controls() {
		//Icon
		$this->add_svg_icon_style_controls();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
	?>

		<div class="funfact_icon tr-icon">
			<div class="side-icon"><?php \Elementor\Icons_Manager::render_icon($icon); ?></div>
		</div>
        
		<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Icon() );
