<?php $theme_options = themerange_get_theme_options();
$rand_id = '-'.mt_rand(0, 1000);
$placeholder_text = esc_html__('Search...', 'themerange');

$theme_options = themerange_get_theme_options();
?>

<?php if( $theme_options['tr_enable_mobile_search'] ) { ?>

<!-- Search -->
<div class="search-box">
    <form method="post" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="form-group">
            <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr($placeholder_text); ?>">
            <button type="submit"><span class="fas fa-search"></span></button>
        </div>
    </form>
</div>

<?php } else { ?>

<!-- Search -->
<div class="search-box">
    <form  id="searchform<?php echo esc_attr($rand_id); ?>" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="form-group">
            <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr($placeholder_text); ?>">
            <button type="submit"><span class="fas fa-search"></span></button>
        </div>
    </form>
</div>

<?php } ?>