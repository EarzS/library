<?php

/*
    This algorithm retrieves the categories from wordpress.

    Used in:
    - nailsbooking plugin, can be improved honestly
 */

$args = array(
    'number'     => false,
    'orderby'    => 'title',
    'order'      => 'ASC',
    'hide_empty' => 0,
    'include'    => 'all'
);
$product_categories = get_terms( 'product_cat', $args );
$count = count($product_categories);
if ( $count > 0 ){
    echo '<ul class="tb-list-group">';
    foreach ( $product_categories as $product_category ) {
        echo '<li class="tb-list-group-item">';
        echo '<a href="'.$url.'/?category='.$product_category->name;
        echo isset($_GET['person']) != false?'&person='.$_GET['person'].'">':'">';
        echo $product_category->name. '</a></li>';
    }
    echo '</ul>';
}
?>