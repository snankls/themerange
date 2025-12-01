<?php
add_action('redux/page/themerange_theme_options/form/before', 'tr_ads_banner_html_before');
if( !function_exists('tr_ads_banner_html_before') ){
	function tr_ads_banner_html_before(){
		if( isset($_COOKIE['tr_theme_ads_banner_before']) ){
			return;
		}
		//Banner for Themeforest
		$random_array = array(
			'moko' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
			'montro' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
			'themerange' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
			'merit' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
			'themerange' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
		);
		
		$array = array_rand($random_array, 1);
		$random_data = $random_array[$array];
		?>
		<div class="tr-theme-ads-banner">
			<div class="banner-content">
				<a href="#" class="close">x</a>
				<a href="<?php echo esc_url($random_data['tf_url']); ?>" target="_blank">
					<img src="<?php echo wp_kses($random_data['image'], true); ?>" alt="<?php echo esc_attr($array, 'themerange'); ?>" />
				</a>
			</div>
		</div>
		<?php
		if( wp_cache_get('tr_show_ads_theme_banner_script') === false ){
			wp_cache_set('tr_show_ads_theme_banner_script', 1);
			?>
			<style>
				.tr-theme-ads-banner{
					text-align: center;
					margin: 15px 0;
				}
				.tr-theme-ads-banner .banner-content{
					max-width: 800px;
					position: relative;
					display: inline-block;
					line-height: 0;
					transition: transform 0.1s linear;
				}
				.tr-theme-ads-banner .banner-content:hover{
					box-shadow: 0px 0px 8px 1px #e6e6e6;
					transform: translateY(-2px);
				}
				.tr-theme-ads-banner img{
					max-width: 100%;
				}

				.tr-theme-ads-banner .close{
					position: absolute;
					top: -5px;
					right: -5px;
					width: 15px;
					height: 15px;
					background-color: #fff;
					border-radius: 100%;
					text-align: center;
					text-decoration: none;
					line-height: 100%;
					z-index: 9;
					color: #000;
				}
				.tr-theme-ads-banner .close:hover{
					background-color: #000;
					color: #fff;
				}
				
				@media only screen and (max-width: 1400px){
					.tr-theme-ads-banner .banner-content{
						max-width: 600px;
					}
				}

				@media only screen and (max-width: 1024px){
					.tr-theme-ads-banner{
						display: none;
					}
				}
			</style>
			
			<script>
				jQuery(function($){
					$('.tr-theme-ads-banner .close').on('click', function(e){
						e.preventDefault();
						$(this).parents('.tr-theme-ads-banner').fadeOut();
						
						if( typeof $.cookie == 'function' ){
							$.cookie('tr_theme_ads_banner', 0, {expires: 30, path: '/'});
						}
					});
				});
			</script>
			<?php
		}
	}
}

//After
add_action('redux/page/themerange_theme_options/form/after', 'tr_ads_banner_html_after');
if( !function_exists('tr_ads_banner_html_after') ){
	function tr_ads_banner_html_after(){
		if( isset($_COOKIE['tr_theme_ads_banner_after']) ){
			return;
		}
		//Banner for Themeforest
		$random_array = array(
			'moko' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
			'montro' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
			'themerange' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
			'merit' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
			'themerange' => array(
				'tf_url'	=> 'https://1.envato.market/e4dqvQ',
				'image'		=> plugin_dir_url( __FILE__ ) . 'assets/images/ads-banner.jpg',
			),
		);
		
		$array = array_rand($random_array, 1);
		$random_data = $random_array[$array];
		?>
		<div class="tr-theme-ads-banner">
			<div class="banner-content">
				<a href="#" class="close">x</a>
				<a href="<?php echo esc_url($random_data['tf_url']); ?>" target="_blank">
					<img src="<?php echo wp_kses($random_data['image'], true); ?>" alt="<?php echo esc_attr($array, 'themerange'); ?>" />
				</a>
			</div>
		</div>
		<?php
		if( wp_cache_get('tr_show_ads_theme_banner_script') === false ){
			wp_cache_set('tr_show_ads_theme_banner_script', 1);
			?>
			<style>
				.tr-theme-ads-banner{
					text-align: center;
					margin: 15px 0;
				}
				.tr-theme-ads-banner .banner-content{
					max-width: 800px;
					position: relative;
					display: inline-block;
					line-height: 0;
					transition: transform 0.1s linear;
				}
				.tr-theme-ads-banner .banner-content:hover{
					box-shadow: 0px 0px 8px 1px #e6e6e6;
					transform: translateY(-2px);
				}
				.tr-theme-ads-banner img{
					max-width: 100%;
				}

				.tr-theme-ads-banner .close{
					position: absolute;
					top: -5px;
					right: -5px;
					width: 15px;
					height: 15px;
					background-color: #fff;
					border-radius: 100%;
					text-align: center;
					text-decoration: none;
					line-height: 100%;
					z-index: 9;
					color: #000;
				}
				.tr-theme-ads-banner .close:hover{
					background-color: #000;
					color: #fff;
				}
				
				@media only screen and (max-width: 1400px){
					.tr-theme-ads-banner .banner-content{
						max-width: 600px;
					}
				}

				@media only screen and (max-width: 1024px){
					.tr-theme-ads-banner{
						display: none;
					}
				}
			</style>
			
			<script>
				jQuery(function($){
					$('.tr-theme-ads-banner .close').on('click', function(e){
						e.preventDefault();
						$(this).parents('.tr-theme-ads-banner').fadeOut();
						
						if( typeof $.cookie == 'function' ){
							$.cookie('tr_theme_ads_banner', 0, {expires: 30, path: '/'});
						}
					});
				});
			</script>
			<?php
		}
	}
}
