<?php get_header();?>
<pre>
<?php 
$products = [];

if(have_posts())  { while(have_posts()) { the_post();
     $products[] = wc_get_product(get_the_ID());

}}

$data = [];
$data['products'] = format_products($products);


?>
</pre>

<div class="container breadcrumb">
    <?php woocommerce_breadcrumb( ['delimiter' => ' > '] );?>
</div>

<article class="container products-archive">

<nav class="filtros">
<h3 class="filtro-titulo">Categorias</h3>
    <div class="filtro">
      <h3 class="filtro-titulo"></h3>
        <?php 
        wp_nav_menu([
            'menu'=>'categorias-internas',
            'menu_class'=>'filtro-cat',
            'container'=>false,
        ]);
        ?>
    </div>
    
    <div class="filtro">
    
        <?php 
       
        $attribute_taxonomies = wc_get_attribute_taxonomies();
        
        foreach($attribute_taxonomies as $attribute){
            the_widget('WC_Widget_Layered_Nav', [
                'title'=>$attribute->attribute_label,
                'attribute'=>$attribute->attribute_name,
            ]);
          }
        ;?>
    </div>

    <div class="filtro">
        <h3 class="filtro-titulo">Filtrar por preço</h3>
        <form class='filtro-preco'>
           <!--Variaves para incluir no value para nao deixar em branco
           <?php $minprice = (!empty($_GET['min_price']) ? $_GET['min_price'] : '')?> 
           <?php $maxprice = (!empty($_GET['max_price']) ? $_GET['max_price'] : '')?> 
           <-Fim!-->
            <div>
                <label for="min_price">De R$</label>
                <input required type="text" name="min_price" id="min_price" value="<?= $minprice ;?>">
            </div>

            <div>
                <label for="max_price">Até R$</label>
                <input required type="text" name="max_price" id="max_price" value="<?= $maxprice ;?>">
            </div>
<button type="submit">Filtrar</button>
        </form>
    </div>
</nav>


<main>
   <?php if($data['products']) { ?>
    <?php woocommerce_catalog_ordering()?>
        <?php handel_products_list($data['products']);?>
        <?= get_the_posts_pagination();?>
    <?php } else { ?> 
     <p>Nunhum resultado para a sua busca.</p>
    <?php } ?>
</main>

</article>
<?php get_footer();?>