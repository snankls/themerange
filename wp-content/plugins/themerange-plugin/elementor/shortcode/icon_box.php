<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class TR_Elementor_Widget_Icon_Box extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-icon_box';
    }
	
	public function get_title(){
        return esc_html__( 'TR Icon Box', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		//Layouts
		$this->tr_add_layout_controls(2);
		
		//Icon Box
		$this->start_controls_section(
            'section_icon_box',
            array(
                'label' => esc_html__( 'Icon Box', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT
            )
        );
		
		//Start repeater
		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'themerange'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'themerange'),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'themerange'),
				'type' => Controls_Manager::ICONS,
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__('URL', 'themerange'),
				'type' => Controls_Manager::URL,
				'show_external' => true,
				'dynamic'  => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
			]
		);
		$this->add_control(
			'icon_box',
			[
				'label'       => __( 'Icon Box', 'themerange' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
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
		
		//Title
		$this->start_controls_section(
			'title_style_tab',
			array(
				'label' => esc_html__('Title', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'title_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} .tr-title span',
            )
        );
		
		//Color Tabs
		$this->start_controls_tabs( 'title_achor_colors' );
		$this->start_controls_tab(
			'title_colors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-title span' => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_colors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
			'title_color_hover',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-title span:hover' => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		//Text
		$this->start_controls_section(
			'text_style_tab',
			array(
				'label' => esc_html__('Text', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'text_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => "{{WRAPPER}} .tr-text a",
            )
        );
		
		//Color Tabs
		$this->start_controls_tabs( 'text_achor_colors' );
		$this->start_controls_tab(
			'text_colors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
			'text_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-text a' => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'text_colors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
			'text_color_hover',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tr-text a:hover' => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$link_attr = $this->generate_link_attributes( $link );
		$allowed_html = tr_allowed_html();
	?>
        
		<?php if ($layout == 'layout2') { ?>
        
			<!-- Policy Section - Start
			================================================== -->
			<div class="row clearfix">
				<?php foreach($settings['icon_box'] as $index => $item) : ?>
					<div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".6" data-fade-from="left">
						<div class="tp-about-process-item tp-bg-common-white-2 mb-40">
							<span class="tp-about-process-icon d-inline-block mb-60">
								<svg width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M65.1893 65.9939C65.0859 65.9965 64.983 65.9786 64.8867 65.941C64.7903 65.9035 64.7024 65.8471 64.6281 65.7752L48.3892 50.2744L33.5873 65.749C33.5115 65.8283 33.4203 65.8915 33.3193 65.9346C33.2184 65.9777 33.1097 66 33 66C32.8902 66 32.7815 65.9777 32.6806 65.9346C32.5796 65.8915 32.4885 65.8283 32.4126 65.749L17.6109 50.2744L1.37202 65.7752C1.25687 65.8851 1.112 65.9587 0.955374 65.9871C0.798747 66.0154 0.637257 65.9971 0.490935 65.9344C0.344613 65.8718 0.2199 65.7676 0.132264 65.6347C0.0446288 65.5018 -0.00207207 65.3462 -0.00204467 65.187C-0.00204467 65.187 -0.0015566 31.503 -0.000418596 31.4827C0.012924 31.2784 0.102646 31.0866 0.250918 30.9454L32.4357 0.223476C32.7467 -0.0733807 33.2573 -0.0761447 33.5662 0.225102L65.7513 30.9472C65.8998 31.0892 65.9889 31.2823 66.0008 31.4874C66.0018 31.503 66.0023 65.142 66.0023 65.1872C66.0021 65.6603 65.6038 65.9848 65.1893 65.9939ZM18.7868 49.152L33 64.0113L47.2132 49.152L33 35.5847L18.7868 49.152ZM49.5129 49.0997L64.3764 63.2877V33.5605L49.5129 49.0997ZM1.62352 33.5605V63.2875L16.487 49.0997L1.62352 33.5605ZM33.8128 34.1133L48.3369 47.9771L64.0394 31.5609L33.8128 2.70823V34.1133ZM1.96053 31.5609L17.6631 47.9771L32.1871 34.1133V2.70823L1.96053 31.5609Z" fill="black" />
								</svg>
							</span>
							<h4 class="fs-35 fs-lg-30 tp-text-common-black-3 lh-130-per mb-20">Innovation<br> First.</h4>
							<p class="fs-18 lh-140-per">We embrace cutting-edge technologies and creative strategies to keep you ahead of the competition.</p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<!-- Policy Section - End
			================================================== -->

        <?php } else { ?>
        	
            <!-- Policy Section - Start
            ================================================== -->
            <section class="policy_section">
                <div class="container">
                    <div class="row clearfix">
                    	<?php foreach($settings['icon_box'] as $index => $item) : ?>
                        <div class="col-lg-4">
                            <div class="iconbox_block layout_icon_left">
                                <div class="iconbox_icon tr-icon">
                                	<?php \Elementor\Icons_Manager::render_icon($item['icon']); ?>
                                </div>
                                <div class="iconbox_content">
                                    <h3 class="iconbox_title"><?php echo wp_kses($item['title'], $allowed_html); ?></h3>
                                    <p class="mb-0">
                                        <?php echo wp_kses($item['text'], $allowed_html); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    	<?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- Policy Section - End
            ================================================== -->
        
        <?php } ?>
    
    <?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Icon_Box() );
