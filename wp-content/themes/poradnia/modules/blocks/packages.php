<section class="packages">
    <div class="container">
        <h2 class="text-center"><?php the_field('packages_title');?></h2>
        <?php the_field('package_desc');?>
        <?php
                $products_number = get_field('packages_number');
                $products_category = get_field('packages_tax');
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
                    <div class="packages__row">
                	<?php
                		while ( $query->have_posts() ) : $query->the_post();
                	 		global $product;

                	 		?>
                	 		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>


                			<div class="packages__row-single">
                			    <div class="packages__row-single-title">
                                    <figure>
                                        <img src="<?php  echo $image[0]; ?>" width="<?php echo $image[1];?>" height="<?php echo $image[2];?>" alt="<?php the_title();?>">
                                    </figure>
                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                			    </div>
                			    <?php
                                global $post;
                                $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
                                <div class="packages__row-single-desc">
                			        <?php echo $short_description; ?>
                			    </div>
                			    <div class="packages__row-single-meta">
                                    <div class="price">
                                        <p>Cena:<br/>
                                        <strong><?php echo $product->get_price_html();?></strong>
                                    </div>
                                      <?php if (  $product->is_in_stock() ) {
                                          woocommerce_template_loop_add_to_cart();
                                      } ?>
                                     <a href="<?php the_permalink();?>" class="btn btn-three">Czytaj więcej</a>
                                 </div>
                			</div>
                			<?php
                		endwhile; ?>
                	</div>
                	<?php wp_reset_query();
                endif;

                ?>
            </div>
    </div>
</section>