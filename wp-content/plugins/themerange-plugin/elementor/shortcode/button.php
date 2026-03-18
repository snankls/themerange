<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Button extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-button';
    }
	
	public function get_title(){
        return esc_html__( 'TR Button', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		$this->tr_add_button_controls();
		
		//Style Tab
		$this->register_style_background_controls();
	}
	
	/***********************************************
						Style Tab
	***********************************************/
	protected function register_style_background_controls() {
		//Button
		$this->add_button_style_controls();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$link_attr = $this->generate_link_attributes( $btn_link );
		$allowed_html = tr_allowed_html();
	?>
        
        <div class="tr-button">
        	<a <?php echo implode(' ', $link_attr); ?> class="btn">
                <span class="btn_label" data-text="<?php echo wp_kses($btn_name, $allowed_html); ?>"><?php echo wp_kses($btn_name, $allowed_html); ?></span>
                <span class="btn_icon">
                	<i class="fa-solid fa-arrow-up-right"></i>
                </span>
            </a>
        </div>
    
    <?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Button() );