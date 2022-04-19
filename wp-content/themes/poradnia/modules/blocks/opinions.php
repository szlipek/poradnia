<section class="opinions">
    <div class="container">
        <h2 class="text-center"><?php the_field('opinion_title');?></h2>
        <?php the_field('opinion_desc');?>
        <?php if( have_rows('opinion') ): ?>
                    <div class="opinions__slider">
                    <?php while( have_rows('opinion') ): the_row();
                        ?>
                        <div class="opinions__slider-slide">
                            <div class="opinions__slider-slide-opinion">
                                <?php the_sub_field('opinion_desc');?>
                            </div>
                            <p><strong><?php the_sub_field('opinion_name');?></strong></p>
                        </div>
                    <?php endwhile; ?>
                    </div>
                <?php endif; ?>
    </div>
    <figure class="opinions__img opinions__img-left">
        <img src="/wp-content/themes/poradnia/img/baby.webp" alt="Poradnia laktacyjna Mataja" width="960" height="402"/>
    </figure>
    <figure class="opinions__img opinions__img-right">
        <img src="/wp-content/themes/poradnia/img/love.webp" alt="Poradnia laktacyjna Mataja" width="1001" height="290"/>
    </figure>
</section>