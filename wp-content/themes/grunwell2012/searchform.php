<?php
/**
 * Search form
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

/**
 * Generate a salt to use for the search input's ID so we can use <label>'s "for" attribute
 * but still have multiple search forms on one page
 */
$salt = uniqid() + mt_rand();

?>

<form method="get" action="<?php echo home_url( '/' ); ?>" class="search" role="search">
  <fieldset>
    <label for="s-<?php echo $salt; ?>">Search for:</label>
    <input name="s" id="s-<?php echo $salt; ?>" type="text" value="<?php the_search_query(); ?>" placeholder="Search&hellip;" />
    <button type="submit" value="Search">Search</button>
  </fieldset>
</form><!-- // .search -->
