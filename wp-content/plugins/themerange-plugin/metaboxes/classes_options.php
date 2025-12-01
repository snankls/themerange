<?php 
$options = array();

$options[] = array(
	'label' => esc_html__('Classes Details', 'themerange'),
	'id' => 'classes-detail-heading',
	'type' => 'heading',
	'desc' => '',
);
$options[] = array(
	'id'         => 'classes_details',
	'type'       => 'repeater',
	'label'      => __( 'Classes Details', 'themerange' ),
	'subtitle'   => __( '', 'themerange' ),
	'desc'       => __( '', 'themerange' ),
);
?>