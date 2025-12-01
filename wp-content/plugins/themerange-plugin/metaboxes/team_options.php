<?php 
$options = array();

$options[] = array(
	'id'		=> 'designation',
	'label'		=> esc_html__('Designation', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'short_description',
	'label'		=> esc_html__('Short Description', 'themerange'),
	'desc'		=> '',
	'type'		=> 'editor',
);

/*//Team Details
$options[] = array(
	'label' => esc_html__('Team Details', 'themerange'),
	'id' => 'team-detail-heading',
	'type' => 'heading',
	'desc' => '',
);
$options[] = array(
	'id'         => 'team_details',
	'type'       => 'repeater',
	'label'      => __( 'Team Details', 'themerange' ),
	'subtitle'   => __( '', 'themerange' ),
	'desc'       => __( '', 'themerange' ),
);*/

//Social Icons
$options[] = array(
	'label' => esc_html__('Social Icons', 'themerange'),
	'id' => 'team-social-icons',
	'type' => 'heading',
	'desc' => '',
);
$options[] = array(
	'id'		=> 'social_title',
	'label'		=> esc_html__('Social Title', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'facebook_link',
	'label'		=> esc_html__('Facebook Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'twitter_link',
	'label'		=> esc_html__('Twitter Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'linkedin_link',
	'label'		=> esc_html__('LinkedIn Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'instagram_link',
	'label'		=> esc_html__('Instagram Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'youtube_link',
	'label'		=> esc_html__('Youtube Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'rss_link',
	'label'		=> esc_html__('RSS Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'dribbble_link',
	'label'		=> esc_html__('Dribbble Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'pinterest_link',
	'label'		=> esc_html__('Pinterest Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'flickr_link',
	'label'		=> esc_html__('Flickr Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'custom_link',
	'label'		=> esc_html__('Custom Link', 'themerange'),
	'desc'		=> '',
	'type'		=> 'text',
);
$options[] = array(
	'id'		=> 'custom_link_icon_class',
	'label'		=> esc_html__('Custom Link Icon Class', 'themerange'),
	'desc'		=> esc_html__('Use FontAwesome Class. Ex: fa-vimeo-square', 'themerange'),
	'type'		=> 'text',
);
?>