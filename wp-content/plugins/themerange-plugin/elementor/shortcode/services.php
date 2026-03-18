<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class TR_Elementor_Widget_Services extends TR_Elementor_Widget_Base{
	public function get_name(){
        return 'tr-services';
    }
	
	public function get_title(){
        return esc_html__( 'TR Services', 'themerange' );
    }
	
	public function get_categories(){
        return array( 'tr-elements', 'themerange' );
    }
	
	public function get_icon(){
		return 'tr-custom-icon';
	}
	
	protected function register_controls(){
		
	}
	
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract( $settings );
		$allowed_html = tr_allowed_html();
	?>
        
        <!-- tp-service-area-start -->
		<div class="tp-service-area pt-130 pb-115">
			<div class="container">
				<div class="row align-items-end mb-30">
					<div class="col-lg-8 col-md-9">
					<div class="tp-service-wd-title-wrap mb-30">
						<h2 class="tp-about-wd-title tp-text-perspective tp-ff-teko fw-600 lh-1 fs-70 fs-xs-50 text-uppercase mb-15">We Provide Smart<br> Solution.</h2>
						<p class="fs-18 ml-110 tp-text-perspective">Strategists dedicated to creating stunning,<br> functional websites that align with your unique<br> business goals.</p>
					</div>
					</div>
					<div class="col-lg-4 col-md-3">
					<div class="tp-rounded-btn-wrap tp-rounded-btn-wd text-md-end mb-30 tp_fade_anim" data-delay=".4" data-fade-from="top" data-ease="bounce">
						<div class="btn_wrapper d-inline-block">
							<a href="service-1-light.html" class="tp-btn-rounded tp-ff-teko btn-item">
								View All<br> Solutions
								<span class="d-block mt-10">
								<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3791 3.0269C14.6431 2.80336 18.8916 1.42595 21.9998 0C20.5732 3.10763 19.1953 7.35556 18.9723 10.6196L16.8276 6.04382L1.05193 21.82C0.936264 21.9354 0.779526 22.0001 0.616152 22C0.494263 22 0.375118 21.9638 0.273781 21.8961C0.172441 21.8284 0.0934544 21.7321 0.046814 21.6195C0.000171661 21.5069 -0.0120335 21.383 0.0117397 21.2634C0.035511 21.1439 0.0941944 21.034 0.18037 20.9478L15.956 5.17221L11.3791 3.0269Z" fill="currentColor" />
								</svg>
								</span>
								<i class="tp-btn-circle-dot"></i>
							</a>
						</div>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
					<div class="p-relative tp-service-wd">
						<div class="tp-service-wd-item-wrap projects">
							<div class="tp-service-wd-item project" data-index-number="0">
								<div class="row">
								<div class="col-xl-5 col-lg-4 col-md-5">
									<div class="tp-service-wd-item-title d-flex align-items-center mb-20">
										<span class="tp-ff-teko fw-600 fs-35 text-uppercase tp-text-grey-1 mr-80 mb-10">01</span>
										<h3 class="tp-ff-teko fw-600 fs-35 fs-lg-30"><a href="service-details-light.html">Branding Design</a></h3>
									</div>
								</div>
								<div class="col-xl-5 col-lg-5 col-md-7">
									<div class="tp-service-wd-content mb-20">
										<p class="fs-18 lh-28 mb-20">It combines elements like logos, color<br> palettes, typography, & graphic.</p>
										<ul>
											<li>+ Logo Design</li>
											<li>+ Graphics Design</li>
											<li>+ Style Guides</li>
										</ul>
									</div>
								</div>
								<div class="col-xl-2 col-lg-3">
									<div class="tp-header-btn tp-service-wd-btn text-lg-end mb-20">
										<a href="service-details-light.html" class="tp-btn-lg tp-btn-border d-inline-block lh-0 tp-round-26 fs-15 text-uppercase ls-0 tp-btn-switch-animation tp-text-common-black fw-500">
											<span class="d-flex align-items-center justify-content-center">
											<span class="btn-text">View Info</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
										</span> 
										</a>
									</div>
								</div>
								</div>
							</div>
							<div class="tp-service-wd-item project" data-index-number="1">
								<div class="row">
								<div class="col-xl-5 col-lg-4 col-md-5">
									<div class="tp-service-wd-item-title d-flex align-items-center mb-20">
										<span class="tp-ff-teko fw-600 fs-35 text-uppercase tp-text-grey-1 mr-80 mb-10">02</span>
										<h3 class="tp-ff-teko fw-600 fs-35 fs-lg-30"><a href="service-details-light.html">E-commerce Solution</a></h3>
									</div>
								</div>
								<div class="col-xl-5 col-lg-5 col-md-7">
									<div class="tp-service-wd-content mb-20">
										<p class="fs-18 lh-28 mb-20">It combines elements like logos, color<br> palettes, typography, & graphic.</p>
										<ul>
											<li>+ Integration</li>
											<li>+ Payment Gateway</li>
											<li>+ Style Guides</li>
										</ul>
									</div>
								</div>
								<div class="col-xl-2 col-lg-3">
									<div class="tp-header-btn tp-service-wd-btn text-lg-end mb-20">
										<a href="service-details-light.html" class="tp-btn-lg tp-btn-border d-inline-block lh-0 tp-round-26 fs-15 text-uppercase ls-0 tp-btn-switch-animation tp-text-common-black fw-500">
											<span class="d-flex align-items-center justify-content-center">
											<span class="btn-text">View Info</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
										</span> 
										</a>
									</div>
								</div>
								</div>
							</div>
							<div class="tp-service-wd-item project" data-index-number="2">
								<div class="row">
								<div class="col-xl-5 col-lg-4 col-md-5">
									<div class="tp-service-wd-item-title d-flex align-items-center mb-20">
										<span class="tp-ff-teko fw-600 fs-35 text-uppercase tp-text-grey-1 mr-80 mb-10">03</span>
										<h3 class="tp-ff-teko fw-600 fs-35 fs-lg-30"><a href="service-details-light.html">Web Design</a></h3>
									</div>
								</div>
								<div class="col-xl-5 col-lg-5 col-md-7">
									<div class="tp-service-wd-content mb-20">
										<p class="fs-18 lh-28 mb-20">It combines elements like logos, color<br> palettes, typography, & graphic.</p>
										<ul>
											<li>+ UI/UX Design</li>
											<li>+ Typography</li>
											<li>+ Style Guides</li>
										</ul>
									</div>
								</div>
								<div class="col-xl-2 col-lg-3">
									<div class="tp-header-btn tp-service-wd-btn text-lg-end mb-20">
										<a href="service-details-light.html" class="tp-btn-lg tp-btn-border d-inline-block lh-0 tp-round-26 fs-15 text-uppercase ls-0 tp-btn-switch-animation tp-text-common-black fw-500">
											<span class="d-flex align-items-center justify-content-center">
											<span class="btn-text">View Info</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
										</span> 
										</a>
									</div>
								</div>
								</div>
							</div>
							<div class="tp-service-wd-item project" data-index-number="3">
								<div class="row">
								<div class="col-xl-5 col-lg-4 col-md-5">
									<div class="tp-service-wd-item-title d-flex align-items-center mb-20">
										<span class="tp-ff-teko fw-600 fs-35 text-uppercase tp-text-grey-1 mr-80 mb-10">04</span>
										<h3 class="tp-ff-teko fw-600 fs-35 fs-lg-30"><a href="service-details-light.html">Digital Marketing</a></h3>
									</div>
								</div>
								<div class="col-xl-5 col-lg-5 col-md-7">
									<div class="tp-service-wd-content mb-20">
										<p class="fs-18 lh-28 mb-20">It combines elements like logos, color<br> palettes, typography, & graphic.</p>
										<ul>
											<li>+ Affiliate</li>
											<li>+ Email Marketing</li>
											<li>+ Campaign</li>
										</ul>
									</div>
								</div>
								<div class="col-xl-2 col-lg-3">
									<div class="tp-header-btn tp-service-wd-btn text-lg-end mb-20">
										<a href="service-details-light.html" class="tp-btn-lg tp-btn-border d-inline-block lh-0 tp-round-26 fs-15 text-uppercase ls-0 tp-btn-switch-animation tp-text-common-black fw-500">
											<span class="d-flex align-items-center justify-content-center">
											<span class="btn-text">View Info</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
										</span> 
										</a>
									</div>
								</div>
								</div>
							</div>
							<div class="tp-service-wd-item project" data-index-number="4">
								<div class="row">
								<div class="col-xl-5 col-lg-4 col-md-5">
									<div class="tp-service-wd-item-title d-flex align-items-center mb-20">
										<span class="tp-ff-teko fw-600 fs-35 text-uppercase tp-text-grey-1 mr-80 mb-10">05</span>
										<h3 class="tp-ff-teko fw-600 fs-35 fs-lg-30"><a href="service-details-light.html">Web Development</a></h3>
									</div>
								</div>
								<div class="col-xl-5 col-lg-5 col-md-7">
									<div class="tp-service-wd-content mb-20">
										<p class="fs-18 lh-28 mb-20">It combines elements like logos, color<br> palettes, typography, & graphic.</p>
										<ul>
											<li>+ UI/UX Design</li>
											<li>+ Development</li>
											<li>+ Q/A Testing</li>
										</ul>
									</div>
								</div>
								<div class="col-xl-2 col-lg-3">
									<div class="tp-header-btn tp-service-wd-btn text-lg-end mb-20">
										<a href="service-details-light.html" class="tp-btn-lg tp-btn-border d-inline-block lh-0 tp-round-26 fs-15 text-uppercase ls-0 tp-btn-switch-animation tp-text-common-black fw-500">
											<span class="d-flex align-items-center justify-content-center">
											<span class="btn-text">View Info</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
											<span class="btn-icon">
												<svg width="25" height="10" viewBox="0 0 25 10" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M18.675 9.91054L24.72 5.63362C24.806 5.56483 24.8766 5.47086 24.9255 5.36023C24.9744 5.2496 25 5.12579 25 5C25 4.87421 24.9744 4.7504 24.9255 4.63977C24.8766 4.52914 24.806 4.43518 24.72 4.36638L18.675 0.0894619C18.5572 0.0111909 18.4215 -0.0168364 18.2892 0.00979851C18.157 0.0364334 18.0358 0.116215 17.9446 0.236567C17.8535 0.356918 17.7977 0.510993 17.7859 0.674501C17.7742 0.838009 17.8072 1.00165 17.8798 1.13963L19.633 4.26665L0.598757 4.26665C0.439957 4.26665 0.287661 4.34391 0.175371 4.48144C0.0630817 4.61897 0 4.8055 0 5C0 5.1945 0.0630817 5.38103 0.175371 5.51856C0.287661 5.65609 0.439957 5.73335 0.598757 5.73335L19.633 5.73335L17.8798 8.86038C17.8072 8.99835 17.7742 9.16199 17.7859 9.3255C17.7977 9.48901 17.8535 9.64308 17.9446 9.76343C18.0358 9.88378 18.157 9.96357 18.2892 9.9902C18.4215 10.0168 18.5572 9.98881 18.675 9.91054Z" fill="currentColor" />
												</svg>
											</span>
										</span> 
										</a>
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="image-wrapper">
							<div class="image-slider">
							<img src="assets/img/service/wd/bg.jpg" alt="">
							<img src="assets/img/service/wd/bg-2.jpg" alt="">
							<img src="assets/img/service/wd/bg-3.jpg" alt="">
							<img src="assets/img/service/wd/bg-4.jpg" alt="">
							<img src="assets/img/service/wd/bg-5.jpg" alt="">
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<!-- tp-service-area-end -->
        
	<?php
	}
}

$widgets_manager->register( new TR_Elementor_Widget_Services() );