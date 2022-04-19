<section class="ebook">
    <figure class="ebook__img">
        <img src="/wp-content/themes/poradnia/img/wave1.svg" alt="poradnia laktacyjna" width="1920" height="128" />
    </figure>
    <div class="container">
        <h2 class="text-center"><?php the_field('ebook_title');?></h2>
        <?php the_field('ebook_desc');?>
        <div class="ebook__row">
            <?php if( have_rows('ebook_left') ): ?>
                <div class="ebook__row-col">
                <?php while( have_rows('ebook_left') ): the_row();
                    $image = get_sub_field('ebook_left_icon');
                    ?>
                    <div class="ebook__row-col-single">
                        <figure>
                            <img src="<?php echo $image['url'];?>" width="<?php echo $image['width'];?>" height="<?php echo $image['height'];?>" alt="<?php echo $image['alt'];?>" />
                        </figure>
                        <div class="ebook__row-col-single-text">
                            <p><span><?php the_sub_field('ebook_left_title');?></span>
                            <?php the_sub_field('ebook_left_desc');?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <div class="ebook__row-col">
                <?php $img = get_field('ebook_photo');?>
                <figure class="ebook__row-col-img">
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>" width="<?php echo $img['width'];?>" height="<?php echo $img['height'];?>" />
                </figure>
            </div>
            <?php if( have_rows('ebook_right') ): ?>
                <div class="ebook__row-col">
                <?php while( have_rows('ebook_right') ): the_row();
                    $image = get_sub_field('ebook_right_icon');
                    ?>
                    <div class="ebook__row-col-single">
                        <figure>
                            <img src="<?php echo $image['url'];?>" width="<?php echo $image['width'];?>" height="<?php echo $image['height'];?>" alt="<?php echo $image['alt'];?>" />
                        </figure>
                        <div class="ebook__row-col-single-text">
                            <p><span><?php the_sub_field('ebook_right_title');?></span>
                            <?php the_sub_field('ebook_right_desc');?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        $link = get_field('ebook_link');
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