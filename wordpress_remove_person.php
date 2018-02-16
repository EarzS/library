<?php

/*
    This algorithm retrieves a GET data with the amount of people and compares
    with the current elements in the cart.

    If there's a item in the cart that belongs to a person that is no longer counted,
    it will be removed from the cart.

    Example:
    - Get variable person is set to 3
    - Adds items to person 3
    - Change get variable to 2
    - Delete all items that belongs to person 3 since he's no longer in the array

    It uses:
    - Remove to cart from Woocomerce
    - Retrieve get data
    - Filtering

    Used in:
    - nailsbooking plugin, can be improved honestly
 */

//  Get cart elements
global $woocommerce;
$items = $woocommerce->cart->get_cart();

$services_cart = array();

foreach($items as $item => $values) {

    $persons = (!isset($_GET['person']))? 1: $_GET['person'];
    $_product =  wc_get_product( $values['data']->get_id());

    // if the cart item person data is bigger that current person
    // selector, remove it from the cart.
    if( ((int) $values['person-number']) > $persons) {
        /*echo 'Eliminado: '. $values['person-number']. " - " .$persons;*/
        $woocommerce->cart->remove_cart_item($item);
        continue;
    }

    // Construct table rows
    $table_string_descriptions =
        '<tr id="product-'.$values['data']->get_id().'" data-product="'.$values['data']->get_id().'"><td>'.$_product->get_title().'</td></tr>';
    $table_string_prices =
        '<tr id="product-'.$values['data']->get_id().'" data-product="'.$values['data']->get_id().'"><td>'.get_post_meta($values['product_id'] , '_price', true).'</td></tr>';
    $table_string_buttons =
        '<tr id="product-'.$values['data']->get_id().'" data-product="'.$values['data']->get_id().'"><td><button class="btn btn-danger" onclick="removeFromCart(this)">Remove</button></td></tr>';

    // Push array elements depending of it's person
    $services_cart['person-'.$values['person-number']]['descriptions'] .= $table_string_descriptions;
    $services_cart['person-'.$values['person-number']]['prices'] .= $table_string_prices;
    $services_cart['person-'.$values['person-number']]['buttons'] .= $table_string_buttons;

    /*$_product =  wc_get_product( $values['data']->get_id());
    echo $values['person-number'];
    echo " - <b>".$_product->get_title().'</b>  <br> Quantity: '.$values['quantity'].'<br>';
    $price = get_post_meta($values['product_id'] , '_price', true);
    echo "  Price: ".$price."<br>";*/
}

/*var_dump($services_cart);*/
?>