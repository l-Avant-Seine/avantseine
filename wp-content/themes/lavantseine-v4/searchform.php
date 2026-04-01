<?php 
/* 
 * Searchbar (displayed in header)
 * 
 * @package lavantseine-v3
 */

?>

<form id="searchform" class="searchbar" action="/" method="get">
    <input type="text" name="s" id="search" placeholder="votre recherche" value="<?php the_search_query(); ?>" />
    <input type="submit" alt="Search" class="" value="ok" />
</form>