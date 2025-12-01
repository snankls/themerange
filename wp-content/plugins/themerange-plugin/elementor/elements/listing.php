<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

class TR_Elementor_Widget_Listing extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-listing';
    }
	
	public function get_title(){
        return esc_html__( 'TR Listing', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		//Layouts
		$this->tr_add_layout_controls(4);
		
		//Icon List
		$this->start_controls_section(
            'section_icon_list',
            array(
                'label' => esc_html__( 'Listing', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT,
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
			'listing',
			[
				'label'       => __( 'Listing', 'themerange' ),
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
		//Layout
		$this->add_layout_style_controls();
		
		//Icon
		$this->add_svg_icon_style_controls(false, '.tr-list svg');
		
		//List
		$this->add_list_style_controls();
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
		?>
        
			<?php if($layout == 'layout2') { ?>

                <ul class="icon_list unordered_list_block">
					<?php foreach($settings['listing'] as $index => $item) : ?>
                    <li>
                        <?php $link_attr = $this->generate_link_attributes( $item['link'] );
						if( $link_attr ): ?>
						<a <?php echo implode(' ', $link_attr); ?>>
						<?php endif; ?>
                            
                            <span class="icon_list_text"><?php echo wp_kses($item['title'], $allowed_html); ?></span>
                            
                        <?php if( $link_attr ): ?>
                        </a>
                        <?php endif; ?>
                    </li>
					<?php endforeach; ?>
                </ul>
        
			<?php } else if($layout == 'layout3') { ?>
            
            	<ul class="tr-layout tr-list footer-contact_list">
                	<?php foreach($settings['listing'] as $index => $item) : ?>
                    <li><?php \Elementor\Icons_Manager::render_icon($item['icon']); ?> <?php echo wp_kses($item['title'], $allowed_html); ?> 
                    
                    
                    <?php $link_attr = $this->generate_link_attributes( $item['link'] );
					if( $link_attr ): ?>
                    <a <?php echo implode(' ', $link_attr); ?>>
                    <?php endif; ?>
					
					<?php echo wp_kses($item['text'], $allowed_html); ?>
                    
                    <?php if( $link_attr ): ?>
                    </a>
                    <?php endif; ?>
                    
                    </li>
                    <?php endforeach; ?>
                </ul>
            
            <?php } else { ?>
            	
                <ul class="icon_list unordered_list_block">
                	<?php foreach($settings['listing'] as $index => $item) : ?>
                    <li>
                        <span class="icon_list_icon">
                        <i class="fa-solid fa-circle fa-fw"></i>
                        </span>
                        
                    	<?php $link_attr = $this->generate_link_attributes( $item['link'] );
						if( $link_attr ): ?>
						<a <?php echo implode(' ', $link_attr); ?>>
						<?php endif; ?>
                        
                        <span class="icon_list_text">
                        	<?php echo wp_kses($item['title'], $allowed_html); ?>
                        </span>
                        
                        <?php if( $link_attr ): ?>
                        </a>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            
            <?php } ?>
        
		<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Listing() );
