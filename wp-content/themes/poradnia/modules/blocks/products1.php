<section class="products__block products__block-big">
    <div class="container">
        <?php if( have_rows('products') ): ?>

            <?php while( have_rows('products') ): the_row();
                $products_number = get_sub_field('products_number');
                $products_category = get_sub_field('product_tax');
                ?>
                <?php

               $args = array(
                       'post_type' => 'product',
                       'posts_per_page' => $products_number,
                       'post_status' => 'publish',
                       'tax_query' => array(
                                       array(
                                           'taxonomy' => 'product_cat',
                                           'field'    => 'term_id',
                                           'terms'    => $products_category,
                                           ),
                                       ),
                           );

               $query = new WP_Query($args);

                if ( $query->have_posts() ): ?>
                    <div class="products__block-row">
                	<?php
                		while ( $query->have_posts() ) : $query->the_post();
                	 		global $product;

                	 		$icon = get_field('product_icon', get_the_ID());
                	 		?>
                			<div class="products__block-row-single">
                			    <div class="products__block-row-single-title">
                                    <figure>
                                        <img src="<?php echo $icon['url'] ?>" alt="<?php echo $icon['alt'];?>" width="<?php echo $icon['width'];?>" height="<?php echo $icon['height'];?>" />
                                    </figure>
                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                			    </div>
                			    <?php if(get_field('product_desc', get_the_ID()) ):
                                the_field('product_desc', get_the_ID());
                			      else :
                			    the_content();
                			    endif;
                			    ?>
                			    <div class="products__block-row-single-meta">
                                    <div class="price">
                                        <p>Cena:
                                        <strong><?php echo $product->get_price_html();?></strong>
                                        </p>
                                    </div>
                                      <?php if (  $product->is_in_stock() ) {
                                          woocommerce_template_loop_add_to_cart();
                                      } ?>
                                 </div>
                			</div>
                			<?php
                		endwhile; ?>
                	</div>
                	<?php wp_reset_query();
                endif;

                ?>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>