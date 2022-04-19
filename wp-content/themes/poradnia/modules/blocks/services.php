<section class="services">
    <div class="container">
        <h2 class="text-center">
            <?php the_field('services_title');?>
        </h2>
        <?php the_field('services_desc');?>
        <?php if( have_rows('services') ): ?>
            <div class="flex">
            <?php while( have_rows('services') ): the_row();
                $icon = get_sub_field('services_icon');
                $photo = get_sub_field('services_photo');
                ?>
                <div class="col">
                   <div class="services__photo">
                        <figure class="services__photo-img">
                            <img src="<?php echo $photo['url'];?>" alt="<?php echo $photo['alt']?>" width="<?php echo $photo['width']?>" height="<?php echo $photo['height']?>" />
                        </figure>
                        <figure class="services__photo-icon">
                            <img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['alt']?>" width="<?php echo $icon['width']?>" height="<?php echo $icon['height']?>" />
                        </figure>
                   </div>
                   <?php the_sub_field('services_desc1');?>
                   <div class="flex justify-end">
                      <?php
                      $link = get_sub_field('services_link');
                      if( $link ):
                          $link_url = $link['url'];
                          $link_title = $link['title'];
                          $link_target = $link['target'] ? $link['target'] : '_self';
                          ?>
                          <a class="btn btn-two" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?><img src="/wp-content/themes/poradnia/img/arrow-right_pink.svg" alt="więcej" width="24" height="24" /></a>
                      <?php endif; ?>
                   </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
    <figure class="services__img services__img-left">
        <img src="/wp-content/themes/poradnia/img/left.webp" alt="usługi" width="533" height="738" />
    </figure>
    <figure class="services__img services__img-right">
        <img src="/wp-content/themes/poradnia/img/right.webp" alt="usługi" width="288" height="658" />
    </figure>
</section>