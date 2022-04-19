<section class="info">
    <figure class="info__img">
        <img src="/wp-content/themes/poradnia/img/wave2.svg" alt="poradnia laktacyjna Mataja" width="1924" height="125" />
    </figure>
    <div class="container">
        <h2 class="text-center"><?php the_field('info_title');?></h2>
        <?php if( have_rows('info') ): ?>
            <div class="info__row">
            <?php while( have_rows('info') ): the_row();
                $img = get_sub_field('info_image');
                ?>
                <div class="info__row-single">
                    <figure class="info__row-single-img">
                        <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>" width="<?php echo $img['width'];?>" height="<?php echo $img['height'];?>" />
                    </figure>
                    <div class="info__row-single-text">
                        <h3><?php the_sub_field('info_title');?></h3>
                        <?php the_sub_field('info_desc');?>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <div class="flex justify-center">
           <?php
           $link = get_field('info_link');
           if( $link ):
               $link_url = $link['url'];
               $link_title = $link['title'];
               $link_target = $link['target'] ? $link['target'] : '_self';
               ?>
               <a class="btn btn-long" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?><img src="/wp-content/themes/poradnia/img/arrow-right.svg" alt="więcej" width="24" height="24" /></a>
           <?php endif; ?>
        </div>
    </div>
</section>