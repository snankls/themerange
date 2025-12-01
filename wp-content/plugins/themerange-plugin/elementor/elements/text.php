<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Text extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-text';
    }
	
	public function get_title(){
        return esc_html__( 'TR Text', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		$this->tr_add_text_controls();
		
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
        
        <?php if($text) : ?>
        <div class="heading_block tr-text mb-0">
            <div class="heading_description">
				<?php echo wp_kses($text, $allowed_html); ?>
            </div>
        </div>
        <?php endif; ?>
        
		<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Text() );