<footer class="footer__contact" id="kontakt">
    <figure class="footer__contact-img">
        <img src="/wp-content/themes/poradnia/img/footer.webp" alt="Poradnia Laktacyjna" width="1920" height="686"/>
    </figure>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2><?php the_field('footer_left-title', 'option');?></h2>
                <?php the_field('footer_left-desc', 'option');?>
                <?php
                if( have_rows('footer_left-links', 'option') ):?>
                <div class="footer__contact-links">
                    <?php
                    while( have_rows('footer_left-links', 'option') ) : the_row();
                        $icon = get_sub_field('footer_left-links-icon');
                    ?>
                       <div class="footer__contact-links-single">
                        <figure>
                            <img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['alt'];?>" width="<?php echo $icon['width'];?>" height="<?php echo $icon['height'];?>" />
                        </figure>
                        <?php the_sub_field('footer_left-links-desc');?>
                       </div>
                    <?php
                    endwhile; ?>
                    </div>
                <?php endif;
                ?>
                <?php
                if( have_rows('footer_left-socials', 'option') ):?>
                <div class="footer__contact-socials">
                    <?php
                    while( have_rows('footer_left-socials', 'option') ) : the_row();
                        $icon = get_sub_field('footer_left-socials-icon');
                    ?>
                       <a href="<?php the_sub_field('footer_left-socials-link');?>" target="_blank">
                        <figure>
                            <img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['alt'];?>" width="<?php echo $icon['width'];?>" height="<?php echo $icon['height'];?>" />
                        </figure>
                       </a>
                    <?php
                    endwhile; ?>
                    </div>
                <?php endif;
                ?>
            </div>
            <div class="col">
                <?php the_field('footer_form', 'option');?>
            </div>
        </div>
    </div>
</footer>