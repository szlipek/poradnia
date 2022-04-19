<section class="single__product">
    <div class="container">
        <div class="single__product-box">
            <?php $icon = get_field('product_icon', get_the_ID()); ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>
            <figure class="single__product-box-img">
                <img src="<?php  echo $image[0]; ?>" width="<?php echo $image[1];?>" height="<?php echo $image[2];?>" alt="<?php the_title();?>">
            </figure>
             <h2 class="single__product-box-title">
                 <figure>
                     <img src="<?php echo $icon['url'] ?>" alt="<?php echo $icon['alt'];?>" width="<?php echo $icon['width'];?>" height="<?php echo $icon['height'];?>" />
                 </figure>
                 <?php the_field('product_title');?>
             </h2>
             <?php the_field('product_desc');?>
             <div class="single__product-box-meta">
             <?php
             $price = get_post_meta( get_the_ID(), '_regular_price', true);
             $sale = get_post_meta( get_the_ID(), '_sale_price', true);
             ?>
                <p>Cena:
                    <?php if($sale): ?>
                    <strong><?php echo wc_price($sale);?></strong> / <s><?php echo wc_price($price);?></s>
                    <?php else: ?>
                    <strong><?php  echo wc_price($price); ?></strong>
                    <?php endif;?>
                </p>
                <?php if(get_field('product_btn')) :?>
                <?php $id =  get_the_ID(); ?>
                <div class="flex jusfify-end">
                    <a href="?add-to-cart=<?php echo $id;?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $id; ?>" data-product_sku="" aria-label="Dodaj <?php the_title()?> do koszyka" rel="nofollow"><?php the_field('product_btn');?></a>
                </div>
                <?php endif;?>
             </div>

        </div>
    </div>
</section>
<?php
/**
 * Related Products
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( is_singular('product') ) {
global $post;
// get categories
$terms = wp_get_post_terms( $post->ID, 'product_cat' );
foreach ( $terms as $term ) $cats_array[] = $term->term_id;
$query_args = array( 'orderby' => 'rand', 'post__not_in' => array( $post->ID ), 'posts_per_page' => 4, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
array(
'taxonomy' => 'product_cat',
'field' => 'id',
'terms' => $cats_array
)));
$r = new WP_Query($query_args);
if ($r->have_posts()) { ?>



    <section class="related">
        <div class="container">
     <h2 class="text-center"><?php the_field('product_related');?></h2>


        <?php woocommerce_product_loop_start(); ?>

            <?php while ($r->have_posts()) : $r->the_post(); global $product; ?>

                 <div class="related__single">
                                <div class="related__single-title">
                                    <figure>
                                        <img src="<?php echo $icon['url'] ?>" alt="<?php echo $icon['alt'];?>" width="<?php echo $icon['width'];?>" height="<?php echo $icon['height'];?>" />
                                    </figure>
                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                </div>
                                <?php the_excerpt();?>
                                <div class="related__single-meta">
                                    <div class="price">
                                        <p>Cena:
                                                           <?php if($sale): ?>
                                                           <strong><?php echo wc_price($sale);?></strong> / <s><?php echo wc_price($price);?></s>
                                                           <?php else: ?>
                                                           <strong><?php  echo wc_price($price); ?></strong>
                                                           <?php endif;?>
                                                       </p>
                                    </div>
                                    <a href="<?php echo $permalink;?>" class="btn btn-three">Czytaj więcej</a>
                                </div>
                            </div>

            <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>
    </div>
    </section>

<?php

wp_reset_query();
}
} ?>

?>