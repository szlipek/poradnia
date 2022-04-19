<section class="columns">
    <div class="container">

        <?php the_field('columns_desc');?>
        <h2 class="text-center"><?php the_field('columns_title');?></h2>
        <div class="columns__row">
            <?php if( have_rows('columns_left') ): ?>
                <div class="columns__row-col">
                <?php while( have_rows('columns_left') ): the_row();
                    $image = get_sub_field('columns_left_icon');
                    ?>
                    <div class="columns__row-col-single">
                        <figure>
                            <img src="<?php echo $image['url'];?>" width="<?php echo $image['width'];?>" height="<?php echo $image['height'];?>" alt="<?php echo $image['alt'];?>" />
                        </figure>
                        <div class="columns__row-col-single-text">
                            <?php the_sub_field('columns_left_desc');?>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <div class="columns__row-col">
                <?php $img = get_field('columns_photo');?>
                <figure class="columns__row-col-img">
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>" width="<?php echo $img['width'];?>" height="<?php echo $img['height'];?>" />
                </figure>
            </div>
            <?php if( have_rows('columns_right') ): ?>
                <div class="columns__row-col">
                <?php while( have_rows('columns_right') ): the_row();
                    $image = get_sub_field('columns_right_icon');
                    ?>
                    <div class="columns__row-col-single">
                        <figure>
                            <img src="<?php echo $image['url'];?>" width="<?php echo $image['width'];?>" height="<?php echo $image['height'];?>" alt="<?php echo $image['alt'];?>" />
                        </figure>
                        <div class="columns__row-col-single-text">
                            <?php the_sub_field('columns_right_desc');?>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        $link = get_field('columns_link');
        if( $link ):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <div class="flex justify-center">
                <a class="btn btn-long" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?><img src="/wp-content/themes/poradnia/img/arrow-right.svg" alt="więcej" width="24" height="24" /></a>
            </div>
        <?php endif; ?>
    </div>
</section>