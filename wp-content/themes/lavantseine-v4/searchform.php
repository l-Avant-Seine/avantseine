<?php 
/* 
 * Searchbar (displayed in header)
 * 
 * @package lavantseine-v3
 */

?>

<div class="searchform_outer --nopad --nohover flex --centered">
    <form id="searchform" class="searchbar flex closed" action="/" method="get">
        <input type="text" name="s" id="search" placeholder="votre recherche" value="<?php the_search_query(); ?>" />
        <input type="submit" alt="Search" class="btn" value="ok" />
    </form>

    <button id="searchform_trigger" class="btn">
        <?php get_template_part('Components/svgs/svg', 'loupe'); ?>
    </button>
</div>