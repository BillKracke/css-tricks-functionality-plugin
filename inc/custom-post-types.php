<?php
// Add CPT to Search
function bkb_searchAll( $query ) {
    if ( $query->is_search ) { $query->set( 'post_type', array( 'site','plugin', 'theme','person' )); } 
    return $query;
   }
   add_filter( 'the_search_query', 'bkb_searchAll' );