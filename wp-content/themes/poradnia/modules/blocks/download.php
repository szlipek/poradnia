<section class="download">
    <div class="container">
        <?php if( have_rows('download') ): ?>
            <div class="download__row">
            <?php while( have_rows('download') ): the_row();
                $image = get_sub_field('download_img');

                ?>
                <div class="download__row-col">
                    <figure>
                        <span class="top"></span>
                        <span class="bottom"></span>
                        <span class="left"></span>
                        <span class="right"></span>
                        <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" width="<?php echo $image['width'];?>" height="<?php echo $image['height'];?>" />
                    </figure>
                    <div class="flex justify-center">
                        <a href="<?php the_sub_field('dowload_file'); ?>" class="btn btn-three"><?php the_sub_field('download_btn');?><img src="/wp-content/themes/poradnia/img/arrow-right_pink.svg" width="25" height="24" alt="<?php the_sub_field('download_btn');?>" /></a>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</secction>