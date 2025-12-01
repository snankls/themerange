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
    <div class="form-group">
        <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search Here', 'themerange'); ?>">
        <button class="fa fa-solid fa-magnifying-glass fa-fw" type="submit"></button>
    </div>
</form>
