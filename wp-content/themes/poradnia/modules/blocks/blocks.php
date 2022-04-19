<section class="blocks">
    <div class="container">
        <?php if( have_rows('blocks') ): ?>
            <div class="blocks__row">
            <?php while( have_rows('blocks') ): the_row();
                $image = get_sub_field('blocks_image');
                ?>
                <div class="blocks__row-col">
                    <figure>
                        <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" width="<?php echo $image['width'];?>" height="<?php echo $image['height'];?>" />
                    </figure>
                    <div class="blocks__row-col-text">
                        <h3><?php the_sub_field('blocks_title');?></h3>
                        <?php the_sub_field('blocks_desc');?>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>