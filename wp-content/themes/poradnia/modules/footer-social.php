<footer class="footer__social">
    <figure class="footer__social_img">
        <img src="/wp-content/themes/poradnia/img/wave.svg" alt="poradnia laktacyjna Mataja" width="1924" height="125" />
    </figure>
    <div class="container">
        <h2 class="text-center">
            <?php the_field('footer_title', 'option');?>
        </h2>
        <?php
        if( have_rows('footer_socials', 'option') ):?>
        <div class="footer__social-row">
            <?php
            while( have_rows('footer_socials', 'option') ) : the_row();
                $icon = get_sub_field('footer_socials-icon');
            ?>
               <a href="<?php the_sub_field('footer_social-link');?>" class="footer__social-row-link">
                    <img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['alt'];?>" width="<?php echo $icon['width'];?>" height="<?php echo $icon['height'];?>" />
                    <span>
                        <strong><?php the_sub_field('footer_social-info');?></strong>
                        <?php the_sub_field('footer_social-name');?>
                    </span>
               </a>
            <?php
            endwhile; ?>
            </div>
        <?php endif;
        ?>
    </div>
    <figure class="footer__social-img footer__social-img-left">
        <img src="/wp-content/themes/poradnia/img/a.webp"  alt="Poradnia Laktacyjna Mataja" width="379" height="491"/>
    </figure>
    <figure class="footer__social-img footer__social-img-right">
            <img src="/wp-content/themes/poradnia/img/b.webp"  alt="Poradnia Laktacyjna Mataja" width="118" height="218"/>
        </figure>
</footer>
