<?php

function format_products($products, $img_size = 'medium'){
    $products_final = [];
    foreach($products as $product){
        $products_final[]=[
            'name'=>$product->get_name(),
            'price'=>$product->get_price_html(),
            'link'=>$product->get_permalink(),
            'img'=> wp_get_attachment_image_src($product->get_image_id(),$img_size)[0],
        ];
    }
    return $products_final;
}

function handel_custom_images(){
    add_image_size('slide',1000,800,['center','top'],true);
    update_option('medium_crop', 1);
}
add_action('after_setup_theme','handel_custom_images');

function handel_loop_shop_per_page(){
    return 6;
}
add_filter('loop_shop_per_page','handel_loop_shop_per_page');


add_filter('woocommerce_enable_order_notes_filde', '__return_false');


function handel_products_list($products){
?>
    <ul class='products-list'>
         <?php foreach($products as $product) { ?>
            <li class="product-item">
             <a href="<?= $product['link']?>">
                <div class="product-info">
                    <img src="<?= $product['img']?>" alt="<?= $product['name']?>">
                    <h2><?= $product['name']?> - <span><?= $product['price']?></span></h2>
                </div>
                <div class="product-overlay">
                    <span class="btn-link">Ver mais</span>
                </div>
            </a>
            </li>
         <?php }?>
        </ul>
<?php
}