<?php
/* category inheritance */ 
add_action('template_redirect', 'inherit_cat_template');

function inherit_cat_template() {

    if (is_category()) {

        $catid = get_query_var('cat');
        $catname = get_query_var('category_name');

        if ( file_exists(TEMPLATEPATH . '/category-' . $catname . '.php') ) {
            include( TEMPLATEPATH . '/category-' . $catname . '.php');
            exit;
        }

        $cat = &get_category($catid);

        $parent = $cat->category_parent;

        while ($parent){
            $cat = &get_category($parent);
            if ( file_exists(TEMPLATEPATH . '/category-' . $cat->slug . '.php') ) {
                include (TEMPLATEPATH . '/category-' . $cat->slug . '.php');
                exit;
            }
            $parent = $cat->category_parent;
        }
    }
}

?>