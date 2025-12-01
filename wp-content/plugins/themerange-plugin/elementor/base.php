<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Modules\DynamicTags\Module as TagsModule;

abstract class TR_Elementor_Widget_Base extends Elementor\Widget_Base{
	public function get_name(){
        return 'tr-base';
    }
	
	public function get_title(){
        return esc_html__( 'ThemeRange Base', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements' );
    }
	
	/* key|value,key|value => return array */
	public function parse_link_custom_attributes( $custom_attributes ){
		if( !$custom_attributes ){
			return array();
		}
		
		$attributes = array();
		
		$custom_attributes = str_replace(' ', '', $custom_attributes);
		
		$custom_attributes = explode(',', $custom_attributes);
		foreach( $custom_attributes as $custom_attribute ){
			$attr = explode('|', $custom_attribute);
			if( count($attr) == 2 ){
				$attributes[] = $attr;
			}
		}
		
		return $attributes;
	}
	
	public function generate_link_attributes( $link ){
		if( !$link ){
			return array();
		}

		$link_attr = array();
		
		if( $link['url'] ){
			$link_attr[] = 'href="' . esc_url($link['url']) . '"';
			$link_attr[] = $link['is_external'] ? 'target="_blank"' : '';
			$link_attr[] = $link['nofollow'] ? 'rel="nofollow"' : '';
			
			if( !empty($link['custom_attributes']) ){
				$link_custom_attributes = $this->parse_link_custom_attributes( $link['custom_attributes'] );
				foreach( $link_custom_attributes as $attr ){
					$link_attr[] = $attr[0] . '="' . esc_attr($attr[1]) . '"';
				}
			}
		}
		
		return $link_attr;
	}
	
	/********************************************************/
	/*						View							*/
	/********************************************************/
	//Layout
	public function tr_add_layout_controls($layout='') {
		$this->start_controls_section(
            'layout_tab',
            array(
                'label' => esc_html__( 'Layout', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT
            )
        );
		$this->add_control(
            'layout',
            array(
                'label' => esc_html__('Layout', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'options' => tr_layout_list($layout),
				'default' => 'layout1'
            )
        );
		$this->end_controls_section();
	}
	
	//Image
	public function tr_add_image_controls($img_text = 'no') {
		$this->start_controls_section(
            'image_tab',
            array(
                'label' => esc_html__( 'Images', 'themerange' ),
            )
        );
        $this->add_control(
            'image',
            array(
                'label' => __( 'Image', 'themerange' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
            )
        );
		if($img_text == 'yes') {
			$this->add_control(
				'image_text',
				array(
					'label' => __( 'Image Text', 'themerange' ),
					'type' => Controls_Manager::TEXTAREA,
				)
			);
		}
        $this->end_controls_section();
	}
	
	//Background Image
	public function tr_add_background_image_controls() {
		$this->start_controls_section(
            'bg_image_tab',
            array(
                'label' => esc_html__( 'Background Images', 'themerange' ),
            )
        );
        $this->add_control(
            'bg_image',
            array(
                'label' => __( 'Background Image', 'themerange' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
            )
        );
        $this->end_controls_section();
	}
	
	//Heading
	public function tr_add_heading_controls($condition = '') {
		if($condition) 
			$condition = array( 'layout' => array($condition) );
		else
			$condition = '';
			
		$this->start_controls_section(
            'headubg_tab',
            array(
                'label' => esc_html__( 'Heading', 'themerange' ),
				'condition' => $condition,
            )
        );
		$this->add_control(
			'subtitle_switcher',
			array(
				'label' => __( 'Enable Sub Title', 'themerange' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'themerange' ),
				'label_off' => __( 'Hide', 'themerange' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
        $this->add_control(
            'subtitle',
            array(
                'label' => __( 'Sub Title', 'themerange' ),
                'type' => Controls_Manager::TEXT,
				'condition' => array( 'subtitle_switcher' => 'yes' ),
				'default' => __( 'Sub Title Here', 'themerange' ),
            )
        );
		$this->add_control(
            'subtitle_animation',
            array(
                'label' => esc_html__('Animation', 'themerange'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'split-in-fade',
                'options' => tr_wow_animate(),
				'condition' => array( 'subtitle_switcher' => 'yes' ),
            )
        );
		$this->add_responsive_control(
			'subtitle_alignment',
			array(
				'label' => esc_html__( 'Alignment', 'themerange' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'themerange' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themerange' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themerange' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themerange' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tr-sub-heading' => 'text-align: {{VALUE}}',
				],
				'condition' => array( 'subtitle_switcher' => 'yes' ),
			)
		);
		
		/*------Highlighted------*/
		$this->add_control(
			'highlighted_subtitle_switcher',
			array(
				'label' => __( 'Enable Highlighted Sub-Title', 'themerange' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'themerange' ),
				'label_off' => __( 'Hide', 'themerange' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			)
		);
		$this->add_control(
            'highlighted_subtitle',
            array(
                'label' => __( 'Highlighted Title', 'themerange' ),
                'type' => Controls_Manager::TEXTAREA,
				'condition' => array( 'highlighted_subtitle_switcher' => 'yes' ),
				'default' => __( 'ThemeRange', 'themerange' ),
            )
        );
		$this->add_responsive_control(
			'highlighted_subtitle_alignments',
			array(
				'label' => esc_html__( 'Alignment', 'themerange' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'themerange' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themerange' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themerange' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themerange' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tr-transparent-heading' => 'text-align: {{VALUE}};',
				],
				'condition' => array( 'highlighted_subtitle_switcher' => 'yes' ),
			)
		);
		
		/*------Title------*/
		$this->add_control(
			'title_switcher',
			array(
				'label' => __( 'Enable Title', 'themerange' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'themerange' ),
				'label_off' => __( 'Hide', 'themerange' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
			)
		);
        $this->add_control(
            'title',
            array(
                'label' => __( 'Title', 'themerange' ),
                'type' => Controls_Manager::TEXTAREA,
				'condition' => array( 'title_switcher' => 'yes' ),
				'default' => __( 'Title Here', 'themerange' ),
            )
        );
		$this->add_control(
            'title_animation',
            array(
                'label' => esc_html__('Animation', 'themerange'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'split-in-fade',
                'options' => tr_wow_animate(),
				'condition' => array( 'title_switcher' => 'yes' ),
            )
        );
		$this->add_responsive_control(
			'title_alignments',
			array(
				'label' => esc_html__( 'Alignment', 'themerange' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'themerange' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themerange' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themerange' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themerange' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tr-heading' => 'text-align: {{VALUE}};',
				],
				'condition' => array( 'title_switcher' => 'yes' ),
			)
		);
        $this->add_control(
            'heading_link',
            array(
                'label' => __( 'Link', 'themerange' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'themerange' ),
                'show_external' => true,
                'dynamic'  => array( 'active' => true ),
				'default' => array( 'url' => '' ),
				'condition' => array( 'title_switcher' => 'yes' ),
            )
        );
		$this->add_control(
			'title_tag',
			array(
				'label' => esc_html__( 'HTML Tag', 'themerange' ),
				'type' => Controls_Manager::SELECT,
				'options' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
					'strong' => 'strong',
				),
				'default' => 'h2',
				'condition' => array( 'title_switcher' => 'yes' ),
			)
		);
        $this->end_controls_section();
	}
	
	//Text
	public function tr_add_text_controls($condition = '') {
				
		if($condition) 
			$condition = array( 'layout' => $condition );
		else
			$condition = '';
		
		$this->start_controls_section(
            'text_tab',
            array(
                'label' => esc_html__( 'Text', 'themerange' ),
				'condition' => $condition,
            )
        );
        $this->add_control(
            'text',
            array(
                'label' => __( 'Text', 'themerange' ),
                'type' => Controls_Manager::WYSIWYG,
            )
        );
        $this->end_controls_section();
	}
	
	//Icon
	public function tr_add_icon_controls($condition = '') {
		
		if($condition) 
			$condition = array( 'layout' => array($condition) );
		else
			$condition = '';
			
		$this->start_controls_section(
            'icon_tab',
            array(
                'label' => esc_html__( 'Icons', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => $condition,
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
            'icon_animation',
            array(
                'label' => esc_html__('Animation', 'themerange'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'split-in-fade',
                'options' => tr_custom_animate(),
            )
        );
		$this->end_controls_section();
	}
	
	//Button
	public function tr_add_button_controls($condition = '') {
		
		if($condition) 
			$condition = array( 'layout' => array($condition) );
		else
			$condition = '';
		
		$this->start_controls_section(
            'button_tab',
            array(
                'label' => esc_html__( 'Button', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => $condition,
            )
        );
		$this->add_control(
            'btn_style',
            array(
                'label' => esc_html__('Style', 'themerange'),
                'type' => Controls_Manager::SELECT2,
                'default' => 'one',
                'options' => tr_button_style(),
            )
        );
		$this->add_control(
            'btn_name',
            array(
                'label' => __( 'Name', 'themerange' ),
                'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'themerange' ),
			)
        );
        $this->add_control(
            'btn_link',
            array(
                'label' => __( 'Link', 'themerange' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'themerange' ),
                'show_external' => true,
                'dynamic'  => array( 'active' => true ),
				'default' => array( 'url' => '' ),
            )
        );
		$this->add_responsive_control(
			'button_alignment',
			array(
				'label' => esc_html__( 'Alignment', 'themerange' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'themerange' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themerange' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themerange' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tr-button' => 'text-align: {{VALUE}}',
				],
			)
		);
        $this->end_controls_section();
	}
	
	//Quote
	public function add_quote_controls() {
		$this->start_controls_section(
            'quote_tab',
            array(
                'label' => esc_html__( 'Quote', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT
            )
        );
		$this->add_control(
            'quote_author',
            array(
                'label' => __( 'Author', 'themerange' ),
                'type' => Controls_Manager::TEXT,
            )
        );
		$this->add_control(
            'quote_text',
            array(
                'label' => __( 'Text', 'themerange' ),
                'type' => Controls_Manager::TEXTAREA,
            )
        );
		$this->end_controls_section();
	}
	
	//Video
	public function add_video_controls() {
		//Video
		$this->start_controls_section(
            'video_section_tab',
            array(
                'label' => esc_html__( 'Video', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );
		$this->add_control(
			'insert_video_url',
			array(
				'label' => esc_html__( 'External URL', 'themerange' ),
				'type' => Controls_Manager::SWITCHER,
			)
		);
		$this->add_control(
			'hosted_url',
			[
				'label' => esc_html__( 'Choose File', 'themerange' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::MEDIA_CATEGORY,
					],
				],
				'media_types' => array('video'),
				'condition' => array('insert_video_url' => ''),
			]
		);
		$this->add_control(
			'external_url',
			[
				'label' => esc_html__( 'URL', 'themerange' ),
				'type' => Controls_Manager::URL,
				'autocomplete' => false,
				'options' => false,
				'label_block' => true,
				'show_label' => false,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'condition' => array('insert_video_url' => 'yes'),
			]
		);
		$this->end_controls_section();
	}
	
	//Query
	public function tr_add_query_controls($number_post = '', $category = 'category', $excerpt = '35') {
		$this->start_controls_section(
            'query_tab',
            array(
                'label' => esc_html__( 'Query', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT
            )
        );
		$this->add_control(
			'excerpt_words',
			array(
				'label' => esc_html__( 'Number of words in excerpt', 'themerange' ),
				'type' => Controls_Manager::NUMBER,
				'default' => $excerpt,
				'min' => '-1',
				'description' => esc_html__( 'Input -1 to show all content', 'themerange' ),
			)
		);
		$this->add_control(
            'limit',
            array(
                'label' => esc_html__( 'Number of Post', 'themerange' ),
                'type' => Controls_Manager::NUMBER,
				'default' => $number_post,
				'min' => 1,
				'step' => 1,
            )
        );
		$this->add_control(
            'orderby',
            array(
                'label' => esc_html__( 'Order By', 'themerange' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date' => esc_html__( 'Date', 'themerange' ),
                    'title' => esc_html__( 'Title', 'themerange' ),
                    'menu_order' => esc_html__( 'Menu Order', 'themerange' ),
                    'rand' => esc_html__( 'Random', 'themerange' ),
                ),
            )
        );
        $this->add_control(
            'order',
            array(
                'label' => esc_html__( 'Order', 'themerange' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => array(
                    'ASC' => esc_html__( 'Ascending', 'themerange' ),
                    'DESC' => esc_html__( 'Descending', 'themerange' ),
                ),
            )
        );
		$this->add_control(
            'categories',
            array(
                'label' => esc_html__( 'Categories', 'themerange' ),
                'type' => Controls_Manager::SELECT2,
                'default' => array(),
                'options' => tr_categories_list($category),
				'multiple' => true,
				'label_block' => true,
            ),
        );
		$this->end_controls_section();
	}
	
	
	/********************************************************/
	/*						Slider							*/
	/********************************************************/
	
	//Slider & Carousel Settings
	public function tr_swiper_addtional_options($loop = '', $autoplay = '', $autoplay_delay = '', $item_show = '', $item_space = '', $item_speed = '', $arrows = '', $dots = '', $condition = '') {
		if($condition) 
			$condition = array( 'layout' => array($condition) );
		else
			$condition = '';
		
		$this->start_controls_section(
            'addtional_options',
            array(
                'label' => esc_html__( 'Addtional Options', 'themerange' ),
                'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => $condition,
            )
        );
		$this->add_control(
            'loop',
            array(
                'label' => esc_html__( 'Loop', 'themerange' ),
                'type' => Controls_Manager::SELECT,
                'default' => $loop,
				'options' => array(
					'false' => esc_html__( 'No', 'themerange' ),
					'true' => esc_html__( 'Yes', 'themerange' ),
				),
            )
        );
		$this->add_control(
            'autoplay',
            array(
                'label' => esc_html__( 'Autoplay', 'themerange' ),
                'type' => Controls_Manager::SELECT,
                'default' => $autoplay,
				'options' => array(
					'false' => esc_html__( 'No', 'themerange' ),
					'true' => esc_html__( 'Yes', 'themerange' ),
				),
            )
        );
		$this->add_control(
            'autoplay_delay',
            array(
                'label' => esc_html__( 'Autoplay Delay', 'themerange' ),
                'type' => Controls_Manager::NUMBER,
                'default' => $autoplay_delay,
				'min' => 5000,
				'step' => 100,
				'condition' => array( 'autoplay' => 'true' ),
            )
        );
		$this->add_responsive_control(
			'item_show',
			array(
				'label' => esc_html__( 'No. of Items', 'themerange' ),
				'type' => Controls_Manager::NUMBER,
				'default' => $item_show,
				'min' => 1,
				'max' => 100,
			)
		);
		$this->add_responsive_control(
			'item_space',
			array(
				'label' => __( 'Item Space', 'themerange' ),
				'type' => Controls_Manager::NUMBER,
				'default' => $item_space,
				'min' => 0,
				'max' => 100,
			)
		);
		$this->add_responsive_control(
			'item_speed',
			array(
				'label' => __( 'Item Speed', 'themerange' ),
				'type' => Controls_Manager::NUMBER,
				'default' => $item_speed,
				'min' => 0,
				'max' => 5000,
				'step' => 100,
			)
		);
		$this->add_control(
			'arrows',
			array(
				'label' => __( 'Arrows', 'themerange' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'themerange' ),
				'label_off' => __( 'Hide', 'themerange' ),
				'return_value' => 'yes',
				'default' => $arrows,
			)
		);
		$this->add_control(
			'dots',
			array(
				'label' => __( 'Dots', 'themerange' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'themerange' ),
				'label_off' => __( 'Hide', 'themerange' ),
				'return_value' => 'yes',
				'default' => $dots,
			)
		);
		$this->end_controls_section();
	}
	
	//Additional Settings
	public function tr_swiper_options_render($loop=true, $autoplay=true, $autoplay_delay=6000, $item_show=1, $item_space=0, $item_speed=500) {
		$loop = ($loop == 1) ? true : false;
		$autoplay = ($autoplay == 1) ? true : false;
		$autoplay_delay = isset($autoplay_delay) ? $autoplay_delay : 6000;
		$item_speed = isset($item_speed) ? $item_speed : 500;
		$changed_atts = array(
			'loop'       		=> $loop,
			'autoplay'      	=> $autoplay,
			'autoplay_delay'	=> $autoplay_delay,
			'item_show'	 		=> $item_show,
			'item_space' 		=> $item_space,
			'item_speed' 		=> $item_speed,
		);
		
		$slider_atts = 'data-swiper-options';
		
		$this->add_render_attribute( 'slider_settings', $slider_atts, wp_json_encode( $changed_atts ) );
	}
	
	
	/********************************************************/
	/*						Style							*/
	/********************************************************/
	
	//Layout Style
	public function add_layout_style_controls($layout_class = ',tr-layout'){
		$this->start_controls_section(
			'layout_style_tab',
			array(
				'label' => esc_html__('Layout Setting', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
            'layout_margin',
            array(
                'label' => __( 'Margin', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $layout_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
            )
        );
		$this->add_responsive_control(
            'layout_padding',
            array(
                'label' => __( 'Pedding', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $layout_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
			)
        );
		$this->end_controls_section();
	}
	
	//Subtitle Style
	public function add_subtitle_style_controls($class = '.tr-sub-heading span'){
		$this->start_controls_section(
			'subtitle_style_tab',
			array(
				'label' => esc_html__('Sub Title', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => array( 'subtitle_switcher' => 'yes' ),
			)
		);
		$this->add_responsive_control(
            'subtitle_layout_margin',
            array(
                'label' => __( 'Margin', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', 'em', '%' ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ),
				'frontend_available' => true,
            )
        );
		$this->add_responsive_control(
            'subtitle_layout_padding',
            array(
                'label' => __( 'Pedding', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', 'em', '%' ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ),
				'frontend_available' => true,
            )
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'subtitle_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} ' . $class,
            )
        );
		
		//Color
		$this->add_control(
			'subtitle_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $class => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
	}
	
	//Highlighted Title Style
	public function add_highlighted_subtitle_style_controls($transparent_class = '.tr-transparent-heading'){
		$this->start_controls_section(
			'highlighted_subtitle_style_tab',
			array(
				'label' => esc_html__('Highlighted Title', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => array( 'highlighted_subtitle_switcher' => 'yes' ),
			)
		);
		$this->add_responsive_control(
            'highlighted_subtitle_layout_margin',
            array(
                'label' => __( 'Margin', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $transparent_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
            )
        );
		$this->add_responsive_control(
            'highlighted_subtitle_layout_padding',
            array(
                'label' => __( 'Pedding', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $transparent_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
            )
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'highlighted_subtitle_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} ' . $transparent_class,
            )
        );
		$this->add_control(
			'highlighted_subtitle_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $transparent_class => '-webkit-text-stroke-color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_section();
	}
	
	//Title Style
	public function add_title_style_controls($heading_class = '.tr-heading', $anchor_color = '.tr-heading a', $anchor_color_hover = '.tr-heading:hover a'){
		$this->start_controls_section(
			'title_style_tab',
			array(
				'label' => esc_html__('Title', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => array( 'title_switcher' => 'yes' ),
			)
		);
		$this->add_responsive_control(
            'title_layout_margin',
            array(
                'label' => __( 'Margin', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $heading_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
            )
        );
		$this->add_responsive_control(
            'title_layout_padding',
            array(
                'label' => __( 'Pedding', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ' . $heading_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
            )
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'title_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} ' . $heading_class,
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
					'{{WRAPPER}} ' . $heading_class => 'color: {{VALUE}}',
					'{{WRAPPER}} ' . $anchor_color => 'color: {{VALUE}}',
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
					'{{WRAPPER}} ' . $anchor_color_hover => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	
	//Text Style
	public function add_text_style_controls($text_class = '.tr-text'){
		$this->start_controls_section(
			'text_style_tab',
			array(
				'label' => esc_html__('Text', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
            'text_layout_margin',
            array(
                'label' => __( 'Margin', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    "{{WRAPPER}} " . $text_class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    "{{WRAPPER}} " . $text_class .' p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'frontend_available' => true,
            )
        );
		$this->add_responsive_control(
            'text_layout_padding',
            array(
                'label' => __( 'Pedding', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    "{{WRAPPER}} " . $text_class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
            )
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'text_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => "{{WRAPPER}} $text_class p, {{WRAPPER}} $text_class",
            )
        );
		$this->add_responsive_control(
			'text_alignment',
			array(
				'label' => esc_html__( 'Alignment', 'themerange' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'themerange' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themerange' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themerange' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themerange' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					"{{WRAPPER}} $text_class p, {{WRAPPER}} $text_class" => 'text-align: {{VALUE}};',
				],
			)
		);
		
		//Color
		$this->add_control(
			'text_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} $text_class p, {{WRAPPER}} $text_class" => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_section();
	}
	
	//Button Style
	public function add_button_style_controls($button_class = '.tr-button a', $button_class_hover = '.tr-button a:hover'){
		$this->start_controls_section(
			'button_style_tab',
			array(
				'label' => esc_html__('Button', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'button_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} '.$button_class,
            )
        );
		
		//Color Tabs
		$this->start_controls_tabs( 'button_colors' );
		$this->start_controls_tab(
			'button_colors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
            'button_color',
            array(
                'label' => __('Color', 'themerange'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$button_class.' .text-one' => 'color: {{VALUE}}',
                ],
            )
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'button_colors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
            'button_color_hover',
            array(
                'label' => __('Color', 'themerange'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$button_class_hover.' .text-two' => 'color: {{VALUE}}',
                ],
            )
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		//Background Color Tabs
		$this->start_controls_tabs( 'button_bgcolors' );
		$this->start_controls_tab(
			'button_bgcolors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
            'button_bgcolor',
            array(
                'label' => __('Background Color', 'themerange'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$button_class => 'background-color: {{VALUE}}',
                ],
            )
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_bgcolors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
            'button_bgcolor_hover',
            array(
                'label' => __('Background Color', 'themerange'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$button_class_hover.':before' => 'background-color: {{VALUE}}',
                ],
            )
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	
	//SVG Icon Style
	public function add_svg_icon_style_controls($condition = '', $icon_class = '.tr-icon svg'){
		if($condition) 
			$condition = array( 'layout' => array($condition) );
		else
			$condition = '';
			
		$this->start_controls_section(
			'svg_icon_style_tab',
			array(
				'label' => esc_html__('Icon', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => $condition,
			)
		);
		$this->add_responsive_control(
			'svg_icon_size',
			[
				'label' => esc_html__( 'Size', 'themerange' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} '.$icon_class => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
			]
		);
		$this->add_responsive_control(
			'svg_icon_gap',
			[
				'label' => esc_html__( 'Gap', 'themerange' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} '.$icon_class => 'margin: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'svg_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'themerange' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} '.$icon_class => 'padding: {{SIZE}}{{UNIT}}',
				],
			]
		);

		//Background Color Tabs
		$this->start_controls_tabs( 'icon_bg_colors' );
		$this->start_controls_tab(
			'svg_icon_bg_colors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
            'svg_icon_bg_color',
            array(
                'label' => __('Background Color', 'themerange'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$icon_class => 'background-color: {{VALUE}}',
                ],
            )
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'svg_icon_bg_colors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
            'svg_icon_bg_color_hover',
            array(
                'label' => __('Background Color', 'themerange'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$icon_class.':hover svg' => 'background-color: {{VALUE}}',
                ],
            )
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		//Color Tabs
		$this->start_controls_tabs( 'icon_colors' );
		$this->start_controls_tab(
			'svg_icon_colors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
            'svg_icon_color',
            array(
                'label' => __('Color', 'themerange'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$icon_class.' path' => 'fill: {{VALUE}}',
                ],
            )
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'svg_icon_colors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
            'svg_icon_color_hover',
            array(
                'label' => __('Color', 'themerange'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} '.$icon_class.':hover path' => 'fill: {{VALUE}}',
                ],
            )
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	
	//List Style
	public function add_list_style_controls($list_class = '.tr-list li', $anchor_class = '.tr-list li a', $anchor_hover_class = '.tr-list li a:hover'){
		$this->start_controls_section(
			'list_style_tab',
			array(
				'label' => esc_html__('List', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
            'list_layout_margin',
            array(
                'label' => __( 'Margin', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tr-layout' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; display: inline-block;',
                ],
				'frontend_available' => true,
            )
        );
		$this->add_responsive_control(
            'list_layout_padding',
            array(
                'label' => __( 'Pedding', 'themerange' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tr-layout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; display: inline-block;',
                ],
				'frontend_available' => true,
            )
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'list_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => "{{WRAPPER}} $list_class, {{WRAPPER}} $anchor_class",
            )
        );
		
		$this->add_responsive_control(
			'list_alignment',
			array(
				'label' => esc_html__( 'Alignment', 'themerange' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'themerange' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'themerange' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'themerange' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'themerange' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					"{{WRAPPER}} $list_class" => 'text-align: {{VALUE}};',
				],
			)
		);
		
		//Color Tabs
		$this->start_controls_tabs( 'list_bgcolors' );
		$this->start_controls_tab(
			'list_colors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
			'list_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} $list_class, {{WRAPPER}} $anchor_class"  => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'list_colors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
			'list_color_hover',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $anchor_hover_class => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	
	//Input Style
	public function add_form_field_style_controls($field_class = 'form input:not([type=submit])'){
		$this->start_controls_section(
			'field_style_tab',
			array(
				'label' => esc_html__('Fields', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'field_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} ' . $field_class,
            )
        );
		$this->add_control(
			'field_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $field_class  => 'color: {{VALUE}}',
				],
			)
		);
		$this->add_control(
			'field_bgcolor',
			array(
				'label' => esc_html__( 'Background Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $field_class  => 'background-color: {{VALUE}}',
				],
			)
		);
		$this->add_control(
			'field_border_width',
			array(
				'label' => esc_html__( 'Border Width', 'themerange' ),
				'type' => Controls_Manager::DIMENSIONS,
				'placeholder' => '',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} ' . $field_class => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			)
		);
		$this->add_control(
			'field_border_color',
			array(
				'label' => esc_html__( 'Border Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $field_class => 'border-color: {{VALUE}};',
				],
			)
		);
		$this->add_control(
			'field_border_radius',
			array(
				'label' => esc_html__( 'Border Radius', 'themerange' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} ' . $field_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
	}
	
	//Form Field Style
	public function add_form_select_style_controls($select_class = 'form select'){
		$this->start_controls_section(
			'select_style_tab',
			array(
				'label' => esc_html__('Select', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'select_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} ' . $select_class,
            )
        );
		$this->add_control(
			'select_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $select_class  => 'color: {{VALUE}}',
				],
			)
		);
		$this->add_control(
			'select_bgcolor',
			array(
				'label' => esc_html__( 'Background Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $select_class  => 'background-color: {{VALUE}}',
				],
			)
		);
		$this->add_control(
			'select_border_width',
			array(
				'label' => esc_html__( 'Border Width', 'themerange' ),
				'type' => Controls_Manager::DIMENSIONS,
				'placeholder' => '',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} ' . $select_class => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			)
		);
		$this->add_control(
			'select_border_color',
			array(
				'label' => esc_html__( 'Border Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $select_class => 'border-color: {{VALUE}};',
				],
			)
		);
		$this->add_control(
			'select_border_radius',
			array(
				'label' => esc_html__( 'Border Radius', 'themerange' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} ' . $select_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
	}
	
	//Form Textarea Style
	public function add_form_textarea_style_controls($textarea_class = 'form textarea'){
		$this->start_controls_section(
			'textarea_style_tab',
			array(
				'label' => esc_html__('Textarea', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'textarea_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} ' . $textarea_class,
            )
        );
		$this->add_control(
			'textarea_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $textarea_class  => 'color: {{VALUE}}',
				],
			)
		);
		$this->add_control(
			'textarea_bgcolor',
			array(
				'label' => esc_html__( 'Background Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $textarea_class  => 'background-color: {{VALUE}}',
				],
			)
		);
		$this->add_control(
			'textarea_border_width',
			array(
				'label' => esc_html__( 'Border Width', 'themerange' ),
				'type' => Controls_Manager::DIMENSIONS,
				'placeholder' => '',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} ' . $textarea_class => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			)
		);
		$this->add_control(
			'textarea_border_color',
			array(
				'label' => esc_html__( 'Border Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $textarea_class => 'border-color: {{VALUE}};',
				],
			)
		);
		$this->add_control(
			'textarea_border_radius',
			array(
				'label' => esc_html__( 'Border Radius', 'themerange' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} ' . $textarea_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
	}
	
	//Form Button Style
	public function add_form_button_style_controls($submit_class = 'input[type=submit]', $submit_hover_class = 'input[type=submit]:hover'){
		$this->start_controls_section(
			'submit_style_tab',
			array(
				'label' => esc_html__('Button', 'themerange'),
				'tab' => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'submit_typography',
                'label' => __('Typography', 'themerange'),
                'selector' => '{{WRAPPER}} ' . $submit_class,
            )
        );
		$this->add_control(
			'submit_border_radius',
			array(
				'label' => esc_html__( 'Border Radius', 'themerange' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} ' . $submit_class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			)
		);
		
		//Color Tabs
		$this->start_controls_tabs( 'submit_colors' );
		$this->start_controls_tab(
			'submit_colors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
			'submit_color',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $submit_class  => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'submit_colors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
			'submit_color_hover',
			array(
				'label' => esc_html__( 'Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $submit_hover_class => 'color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		//Background Color Tabs
		$this->start_controls_tabs( 'submit_bgcolors' );
		$this->start_controls_tab(
			'submit_bgcolors_normal',
			array(
				'label' => esc_html__( 'Normal', 'themerange' ),
			)
		);
		$this->add_control(
			'submit_bgcolor',
			array(
				'label' => esc_html__( 'Background Color', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $submit_class  => 'background-color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'submit_bgcolors_hover',
			array(
				'label' => esc_html__( 'Hover', 'themerange' ),
			)
		);
		$this->add_control(
			'submit_bgcolor_hover',
			array(
				'label' => esc_html__( 'Background Color ', 'themerange' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $submit_hover_class => 'background-color: {{VALUE}}',
				],
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	
}