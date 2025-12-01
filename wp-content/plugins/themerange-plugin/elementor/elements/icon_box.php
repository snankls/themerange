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
			<section class="policy_section bg-light">
				<div class="container">
					<div class="row">

						<?php foreach($settings['icon_box'] as $index => $item) : ?>
						<div class="col-lg-4">
							<div class="iconbox_block">
								<div class="iconbox_icon bg-warning-subtle tr-icon">
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

        <?php } else { ?>
        	
            <!-- Policy Section - Start
            ================================================== -->
            <section class="policy_section">
                <div class="container">
                    <div class="row">
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
