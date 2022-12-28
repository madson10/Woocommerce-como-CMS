<?php
function handel_custom_checkout($fields){
   unset ($fields['billing']['billing_phone']);
    return $fields;
}

add_filter('woocommerce_checkout_fields','handel_custom_checkout');


function show_admin_custom_checkout_presente($order){
    $presente = get_post_meta($order->get_id(), '_billing_presente',true);
    echo '<p><strong>Presente:</strong> '. $presente .'</p>';
};

add_action('woocommerce_admin_order_data_after_shipping_address','show_admin_custom_checkout_presente');
//add campo
function handel_custom_checkout_field($checkout){
    woocommerce_form_field('mensagem_personalizada',[
        'type'=> 'textarea',
        'class'=>['form-row-wide mensagem_personalizada'],
        'label' => 'Mensagem personalizada',
        'placeholder'=>'Escreva uma mensagem para a pessoa que está presenteando.',
        'required'=>true,
    ], $checkout->get_value('mensagem_personalizada'));
};

add_action('woocommerce_after_order_notes','handel_custom_checkout_field');
//valida campo


function handel_custom_checkout_field_process(){
    if(!$_POST['mensagem_personalizada']){
        wc_add_notice('Por favor escreva uma mensagem personalizada','error');
    };
};
add_action('woocommerce_checkout_process','handel_custom_checkout_field_process');

//add banco de dados

function handel_custom_checkout_field_update($order_id){
    if(!empty($_POST['mensagem_personalizada'])){
        update_post_meta($orde_id,'mensagem_personalizada', sanatize_text_field($_POST['mensagem_personalizada']));
    };
};
add_action('woocommerce_checkout_update_order_meta','handel_custom_checkout_field_update');

function show_admin_custom_checkout_mensagem($order){
    $presente = get_post_meta($order->get_id(), '_billing_presente',true);
    echo '<p><strong>Presente:</strong> '. $presente .'</p>';
};

add_action('woocommerce_admin_order_data_after_shipping_address','show_admin_custom_checkout_presente');

?>