<section class="offer">
    <div class="container">
        <div class="offer__single">
            <div class="offer__single-text">
                <h2><?php the_field('off_title');?></h2>
                <?php the_field('off_desc');?>
                <?php
                $link = get_field('off_link');
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <div class="flex justify-start">
                    <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?><img src="/wp-content/themes/poradnia/img/arrow-right.svg" alt="<?php echo esc_html( $link_title ); ?>"></a>
                    </div>
                <?php endif; ?>
                <?php if(get_field('off_price')):?>
                <div class="flex justify-end">
                    <p class="price"><?php the_field('off_price');?></p>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>