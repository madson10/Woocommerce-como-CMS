<?php
function handel_custom_menu($menu_links){
    $menu_links = array_slice($menu_links, 0, 5, true)
    + ['certificados' => 'Certificados']
    + array_slice($menu_links, 5, null, true);
    return $menu_links;
};

add_filter('woocommerce_account_menu_items','handel_custom_menu');

function handel_add_endpoint(){
    add_rewrite_endpoint('certificados', EP_PAGES);
};
add_action('init','handel_add_endpoint');


function handel_certificados(){
 
      echo '<H2>Esses são os seus certificados</H2>';
      echo '<p>Esses são os seus certificados</p>';
};

add_action('woocommerce_account_certificados_endpoint','handel_certificados')



?>
