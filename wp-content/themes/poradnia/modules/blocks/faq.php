<section class="faq">
    <div class="container">
        <?php if( have_rows('faq') ): ?>
            <div class="faq__row">
            <?php while( have_rows('faq') ): the_row(); ?>
                <div class="faq__single">
                    <h4><img src="/wp-content/themes/poradnia/img/chevron.svg" alt="więcej/mniej" width="24" height="24" /><?php the_sub_field('faq_title');?></h4>
                    <div class="faq__single-text">
                        <?php the_sub_field('faq_desc');?>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>