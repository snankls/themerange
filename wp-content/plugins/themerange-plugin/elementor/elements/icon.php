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
		// Layouts
		$this->tr_add_layout_controls(2);

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
            'text',
            array(
                'label' => esc_html__('Text', 'themerange' ),
				'type' => Controls_Manager::TEXTAREA,
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

		<?php if ($layout == 'layout2') { ?>

			<div class="tr-icon">
				<div class="side-icon"><?php \Elementor\Icons_Manager::render_icon($icon); ?></div>
			</div>
		
		<?php } else { ?>

			<div class="tr-icon-inner">
				<div class="tr-icon">
					<div class="about-three_image-certificate">
						<?php $link_attr = $this->generate_link_attributes( $link );
						if( $link_attr ): ?>
						<a <?php echo implode(' ', $link_attr); ?>>
						<?php endif; ?>
						
						<?php \Elementor\Icons_Manager::render_icon($icon); ?>
						
						<?php $link_attr = $this->generate_link_attributes( $link );
						if( $link_attr ): ?>
						</a>
						<?php endif; ?>
						
						<p><?php echo wp_kses($text, $allowed_html); ?></p>
					</div>
					
				</div>
			</div>

		<?php } ?>
        
		<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Icon() );
