<section class="ebook1">
    <figure class="ebook1__img">
        <img src="/wp-content/themes/poradnia/img/wave2.svg" alt="poradnia laktacyjna Mataja" width="1924" height="125">
    </figure>
    <div class="container">
        <h2 class="text-center"><?php the_field('ebook_title');?></h2>
        <?php the_field('ebook_desc');?>
        <div class="ebook1__box">
            <?php $img = get_field('ebook_photo');?>
            <?php if($img): ?>
                <figure>
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>" height="<?php echo $img['height'];?>" width="<?php echo $img['width'];?>" />
                </figure>
            <?php endif;?>
            <div class="ebook1__box-text">
                <?php the_field('ebook_desc');?>
                <div class="flex justify-between">
                    <p class="price">
                        CENA: <strong><?php the_field('ebook_price');?></strong>
                    </p>
                    <?php
                    $link = get_field('ebook_link');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?><img src="/wp-content/themes/poradnia/img/plus.svg" width="20" height="20" alt="czytaj więcej"/></a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>