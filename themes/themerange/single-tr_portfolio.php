<?php get_header();
$theme_options = themerange_get_theme_options();

$show_banner = $theme_options['tr_enable_portfolio_banner'];
$background_image = $theme_options['tr_portfolio_background_image']['url'];
$show_single_title = $theme_options['tr_portfolio_title'];
$single_custom_name = !empty($theme_options['tr_portfolio_custom_name']) ? $theme_options['tr_portfolio_custom_name'] : get_the_title();
$single_breadcrumb = $theme_options['tr_enable_portfolio_breadcrumb'];

themerange_single_banner($show_banner, $background_image, $show_single_title, $single_custom_name, $single_breadcrumb);
?>

<?php while (have_posts()) : the_post(); ?>
<!-- Portfolio Details Section - Start
================================================== -->
<section class="portfolio_details_section section_space bg-light">
  <div class="container">
    <div class="details_item_image">
      <?php the_post_thumbnail('full'); ?>
    </div>
    <h2 class="details_item_title"><?php the_title(); ?></h2>
    <div>
    	<?php the_content(); ?>
    </div>
    <hr>
    <ul class="portfolio_details_info_list icon_list unordered_list justify-content-lg-between mb-5">
      <li>
        <span class="icon_list_text">
          <strong class="text-dark text-uppercase">Services:</strong>
          Cloud Migration
        </span>
      </li>
      <li>
        <span class="icon_list_text">
          <strong class="text-dark text-uppercase">Client:</strong>
          Techco
        </span>
      </li>
      <li>
        <span class="icon_list_text">
          <strong class="text-dark text-uppercase">Location:</strong>
          New York,NY,USA
        </span>
      </li>
      <li>
        <span class="icon_list_text">
          <strong class="text-dark text-uppercase">Completed Date:</strong>
          20-12-2024
        </span>
      </li>
    </ul>

    <h3 class="details_item_info_title pt-4">Project Requirement</h3>
    <p>
      In this phase of the Cloud Migration and Integration project, our focus is on executing robust data migration strategies to ensure the seamless transfer of data from on-premises servers to cloud storage solutions. Leveraging advanced techniques and tools,
    </p>
    <div class="row mb-4">
      <div class="col-lg-5">
        <ul class="icon_list unordered_list_block">
          <li>
            <span class="icon_list_icon">
              <img src="assets/images/icons/icon_check_3.svg" alt="Check SVG Icon">
            </span>
            <span class="icon_list_text">
              Comprehensive Assessment Phase
            </span>
          </li>
          <li>
            <span class="icon_list_icon">
              <img src="assets/images/icons/icon_check_3.svg" alt="Check SVG Icon">
            </span>
            <span class="icon_list_text">
              Strategic Migration Plan Development
            </span>
          </li>
          <li>
            <span class="icon_list_icon">
              <img src="assets/images/icons/icon_check_3.svg" alt="Check SVG Icon">
            </span>
            <span class="icon_list_text">
              Robust Data Migration Strategies
            </span>
          </li>
          <li>
            <span class="icon_list_icon">
              <img src="assets/images/icons/icon_check_3.svg" alt="Check SVG Icon">
            </span>
            <span class="icon_list_text">
              Infrastructure Preparation
            </span>
          </li>
        </ul>
      </div>
      <div class="col-lg-5">
        <ul class="icon_list unordered_list_block">
          <li>
            <span class="icon_list_icon">
              <img src="assets/images/icons/icon_check_3.svg" alt="Check SVG Icon">
            </span>
            <span class="icon_list_text">
              Application Migration 
            </span>
          </li>
          <li>
            <span class="icon_list_icon">
              <img src="assets/images/icons/icon_check_3.svg" alt="Check SVG Icon">
            </span>
            <span class="icon_list_text">
              Training and Documentation
            </span>
          </li>
          <li>
            <span class="icon_list_icon">
              <img src="assets/images/icons/icon_check_3.svg" alt="Check SVG Icon">
            </span>
            <span class="icon_list_text">
              Infrastructure Preparation
            </span>
          </li>
          <li>
            <span class="icon_list_icon">
              <img src="assets/images/icons/icon_check_3.svg" alt="Check SVG Icon">
            </span>
            <span class="icon_list_text">
              Post-migration Support
            </span>
          </li>
        </ul>
      </div>
    </div>

    <h3 class="details_item_info_title pt-4">Solution & Result</h3>
    <p>
      The successful execution of robust data migration strategies ensures the seamless transfer of data from on-premises servers to cloud storage solutions. Data integrity, security, and regulatory compliance are prioritized throughout the migration process. Rigorous testing and validation verify the accuracy and completeness of data migration, minimizing downtime and data loss risks.
    </p>
    <p>
      To achieve successful data migration, our solution includes a comprehensive approach that encompasses meticulous planning, advanced techniques, and thorough testing. We leverage industry-leading tools and expertise.
    </p>

    <h3 class="details_item_info_title pt-5 mb-4">Our Similar Projects</h3>
    <div class="row">
      <div class="col-lg-6">
        <div class="portfolio_block portfolio_layout_2">
          <div class="portfolio_image">
            <a class="portfolio_image_wrap bg-light" href="portfolio_details.html">
              <img src="assets/images/portfolio/portfolio_item_image_10.webp" alt="Mobile App Design">
            </a>
          </div>
          <div class="portfolio_content">
            <h3 class="portfolio_title">
              <a href="portfolio_details.html">
                Pioneering Progress Exploring the Evolution and Impact of
              </a>
            </h3>
            <ul class="category_list unordered_list">
              <li><a href="portfolio.html"><i class="fa-solid fa-tags"></i> Web Design</a></li>
              <li><a href="portfolio.html"><i class="fa-solid fa-building"></i> Health</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="portfolio_block portfolio_layout_2">
          <div class="portfolio_image">
            <a class="portfolio_image_wrap bg-light" href="portfolio_details.html">
              <img src="assets/images/portfolio/portfolio_item_image_11.webp" alt="Mobile App Design">
            </a>
          </div>
          <div class="portfolio_content">
            <h3 class="portfolio_title">
              <a href="portfolio_details.html">
                Unlocking Potential Explore Our Comprehensive IT Portfolio
              </a>
            </h3>
            <ul class="category_list unordered_list">
              <li><a href="portfolio.html"><i class="fa-solid fa-tags"></i> Web Design</a></li>
              <li><a href="portfolio.html"><i class="fa-solid fa-building"></i> Industry</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Portfolio Details Section - End
================================================== -->
<?php endwhile; ?>

<?php get_footer(); ?>