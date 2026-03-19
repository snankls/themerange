<?php
/**
 * Search Form template
 *
 * @author  Noor Tech
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Restricted' );
}
?>

<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="tp-search-form-input">
        <input type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('What are you looking for?', 'themerange'); ?>">
        <span class="tp-search-focus-border"></span>
        <button class="tp-search-form-icon" type="submit">
            <i class="fa-sharp fa-regular fa-magnifying-glass"></i>
        </button>
    </div>
</form>
