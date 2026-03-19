<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Form extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-form';
    }
	
	public function get_title(){
        return esc_html__( 'AgenkX Form', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	public function get_script_depends() {
		wp_register_script( 'form-script', THEMERANGE_URL . 'assets/js/form-script.js', [ 'elementor-frontend' ], THEMERANGE_VERSION, true );
		return [ 'form-script' ];
	}
	
	protected function register_controls(){
		// Layouts
		$this->tr_add_layout_controls(3);
		
		// Form
		$this->start_controls_section(
            'form_tab',
            array(
                'label' => esc_html__( 'Form', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT
            )
        );
		$this->add_control(
            'cf7_shortocde',
            array(
                'label' => esc_html__('Select Form', 'themerange'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => get_form_list(),
				'description' => sprintf(
					wp_kses_post(
						__('Go to the <a href="%1$s" target="_blank">Contact Form 7</a> to manage your form or visit plugin <a href="%2$s" target="_blank">Contact Form 7</a>.', 'themerange')
					),
					esc_url( admin_url( 'admin.php?page=wpcf7' ) ),
					esc_url( 'https://wordpress.org/plugins/contact-form-7/' )
				),
            )
        );
        $this->end_controls_section();
		
		// Style Tab
		$this->register_style_background_controls();
	}
	
	/***********************************************
						Style Tab
	***********************************************/
	protected function register_style_background_controls() {
		// Label
		$this->add_form_label_style_controls();

		// Input
		$this->add_form_input_style_controls();
		
		// Select
		$this->add_form_select_style_controls();
		
		// Textarea
		$this->add_form_textarea_style_controls();
		
		// Button
		$this->add_form_button_style_controls();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();

		if($layout == 'layout2')
			$classes = 'comment-form';
		else if($layout == 'layout3')
			$classes = 'default-form';
		else
			$classes = 'contact-form';
	?>
        
		<!-- Default Form -->
		<div class="tr-form <?php echo esc_attr($classes); ?>">
			<div id="contact-form">
				<?php echo do_shortcode('[contact-form-7 id="'.esc_attr($cf7_shortocde).'"]'); ?>
			</div>
		</div>
		<!-- End Default Form -->
        
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Form() );