<?php
/*
    This algorithm checks if a item exists in the cart of woocomerce.

    Used in:
    - nailsbooking plugin, can be improved honestly
 */

function product_exist_in_cart($person, $id) {
    global $woocommerce;

    foreach($woocommerce->cart->get_cart() as $key => $val ) {
        $_product = $val['data'];

        if($id == $_product->id &&
            $val['person-number'] == $person ) {
            return true;
        }
    }

    return false;
}