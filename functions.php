<?php

function handle_add_woocommerce_support(){
    add_theme_support('woocommerce');
}

add_action('after_setup_theme','handle_add_woocommerce_support');

function handel_css(){
    wp_register_style('handel-style', get_template_directory_uri() . './style.css',[],'1.0.0',false);
    wp_enqueue_style('handel-style');
}
add_action('wp_enqueue_scripts','handel_css');
//Funnção para remover as classes

function remove_some_body_class($classes) {
    $woo_class = array_search('woocommerce', $classes);
    $woopage_class = array_search('woocommerce-page', $classes);
    $search = in_array('archive', $classes) || in_array('product-template-default', $classes);
    if($woo_class && $woopage_class && $search){
        unset($classes[$woo_class]);
        unset($classes[$woopage_class]);
    }
  return $classes;
  }
  add_filter('body_class', 'remove_some_body_class');

  //end
  include(get_template_directory() . '/inc/product-list.php');

  function remove_notes(){
    return false;
  };
  add_filter('woocommerce_enable_order_notes_field', 'remove_notes');


//fecha função handel

include(get_template_directory() . '/inc/user-custom-menu.php');
include(get_template_directory() . '/inc/checkout-customizado.php');
?>

