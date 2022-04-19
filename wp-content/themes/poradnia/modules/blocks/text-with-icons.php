<section class="text-with-icons">
    <div class="container">
        <h2 class="text-center"><?php the_field('text_title');?></h2>
        <?php the_field('text_desc');?>
         <?php if( have_rows('text_icons') ): ?>
                 <div class="flex">
                 <?php while( have_rows('text_icons') ): the_row();
                     $image = get_sub_field('text_icons-icon');
                     ?>
                     <div class="col">
                        <figure class="text-with-icons-icon">
                            <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" width="<?php echo $image['width'];?>" height="<?php echo $image['height'];?>" />
                        </figure>
                        <p><?php the_sub_field('text_icons-text');?></p>
                     </div>
                 <?php endwhile; ?>
                 </div>
             <?php endif; ?>
             <div class="flex justify-center">
                <?php
                $link = get_field('text_link');
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