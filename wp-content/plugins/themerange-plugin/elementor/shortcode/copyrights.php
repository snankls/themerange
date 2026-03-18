<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Copyrights extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-copyrights';
    }
	
	public function get_title(){
        return esc_html__( 'TR Copyrights', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		$this->start_controls_section(
            'copyrights_tab',
            array(
                'label' => esc_html__( 'Copyrights', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT
            )
        );
		$this->add_control(
            'copyrights',
			array(
                'label' => esc_html__( 'Copyrights', 'themerange' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Copyright © [tr_current_year] [tr_site_title] | Powered by [tr_site_title]', 'themerange' ),
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
		//Text
		$this->add_text_style_controls();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
		?>
        
			<?php if($copyrights) : ?>
            	<div class="tr-text main-footer_copyright"><?php echo do_shortcode( shortcode_unautop( $copyrights ) ); ?></div>
            <?php endif; ?>
        
		<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Copyrights() );