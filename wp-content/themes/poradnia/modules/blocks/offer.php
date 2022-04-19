<section class="offer">
    <div class="container">
        <div class="offer__single">
            <div class="offer__single-img">
                <?php
                $img = get_field('offer_image');
                $ico = get_field('offer_icon');
                ?>
                <figure class="offer__single-img-big">
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>" width="<?php echo $img['width'];?>" height="<?php echo $img['height'];?>" />
                </figure>
                <figure class="offer__single-img-icon">
                    <img src="<?php echo $ico['url'];?>" alt="<?php echo $ico['alt'];?>" width="<?php echo $ico['width'];?>" height="<?php echo $ico['height'];?>" />
                </figure>
            </div>
            <div class="offer__single-text">
                <h2><?php the_field('offer_title');?></h2>
                <?php the_field('offer_desc');?>
                <?php
                $link = get_field('offer_link');
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <div class="flex justify-start">
                    <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?><img src="/wp-content/themes/poradnia/img/arrow-right.svg" alt="<?php echo esc_html( $link_title ); ?>"></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>