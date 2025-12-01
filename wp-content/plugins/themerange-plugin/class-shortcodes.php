<?php  
class TR_Shortcodes{
	
	function __construct(){
		$this->add_shortcodes();
	}
	
	function add_shortcodes(){
		add_shortcode('tr_current_year', array($this, 'display_current_year'));
		add_shortcode('tr_site_title', array($this, 'display_site_title'));
	}
	
	//Copyrights
	function display_current_year(){
		$tr_current_year = gmdate( 'Y' );
		$tr_current_year = do_shortcode( shortcode_unautop( $tr_current_year ) );
		if ( ! empty( $tr_current_year ) ) {
			return $tr_current_year;
		}
	}
	
	//Site Title
	public function display_site_title() {
		$tr_site_title = get_bloginfo( 'name' );
		if ( ! empty( $tr_site_title ) ) {
			return $tr_site_title;
		}
	}
	
}
new TR_Shortcodes();
?>