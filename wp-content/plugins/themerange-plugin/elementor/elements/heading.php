<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Heading extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-heading';
    }
	
	public function get_title(){
        return esc_html__( 'TR Heading', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		$this->tr_add_heading_controls();
		
		//Style Tab
		$this->register_style_background_controls();
	}
	
	/***********************************************
						Style Tab
	***********************************************/
	protected function register_style_background_controls() {
		//SubTitle
		$this->add_subtitle_style_controls();
		
		//Transparent
		$this->add_highlighted_subtitle_style_controls();
		
		//Title
		$this->add_title_style_controls();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$link_attr = $this->generate_link_attributes( $heading_link );
		$allowed_html = tr_allowed_html();
	?>
        
        <?php if($subtitle_switcher or $highlighted_subtitle_switcher or $title_switcher) : ?>
        <div class="heading_block mb-0 tr-title">
            <div class="heading_focus_text">
                <?php echo wp_kses($subtitle, $allowed_html); ?>
				<span class="badge bg-secondary text-white"><?php echo wp_kses($highlighted_subtitle, $allowed_html); ?></span>
            </div>

			<?php if($settings['title_tag']) { ?>
            <<?php echo esc_attr($settings['title_tag']); ?>>
				<?php echo wp_kses($title, $allowed_html); ?>
            </<?php echo esc_attr($settings['title_tag']); ?>>
			<?php } ?>
        </div>
        <?php endif; ?>
        
		<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Heading() );