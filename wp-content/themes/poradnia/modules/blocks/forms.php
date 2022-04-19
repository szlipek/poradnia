<section class="forms">
    <div class="container">
        <h2 class="text-center"><?php the_field('form_title');?></h2>
        <?php the_field('form_desc');?>
        <?php if( have_rows('form') ): ?>
            <div class="forms__row">
            <?php while( have_rows('form') ): the_row();
                $img = get_sub_field('form_icon');
                ?>
                <div class="forms__row-single">
                    <figure class="forms__row-single-img">
                        <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>" width="<?php echo $img['width'];?>" height="<?php echo $img['height'];?>" />
                    </figure>
                    <h3><?php the_sub_field('form_title');?></h3>
                    <div class="forms__row-single-text">

                        <?php the_sub_field('form_desc');?>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>