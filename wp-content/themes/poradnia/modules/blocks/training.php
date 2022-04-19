<section class="training">
    <div class="container">
         <h2 class="text-center"><?php the_field('training_title');?></h2>
        <?php the_field('training_desc');?>
        <?php if( have_rows('training') ): ?>
            <div class="flex">
            <?php while( have_rows('training') ): the_row();
                $ico = get_sub_field('training_icon');
                ?>
                <div class="training__single">
                    <div class="training__single-title">
                        <figure>
                            <img src="<?php echo $ico['url'];?>" alt="<?php echo $ico['alt'];?>" width="<?php echo $ico['width'];?>" height="<?php echo $ico['height'];?>" />
                        </figure>
                        <h4><?php the_sub_field('training_title');?></h4>
                    </div>
                    <div class="training__single-desc">
                        <?php the_sub_field('training_desc');?>
                    </div>
                    <div class="training__single-meta">
                        <p class="price">
                            Cena:
                            <strong><?php the_sub_field('training_price');?></strong>
                        </p>
                        <?php
                        $link = get_sub_field('training_link');
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="btn btn-three" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>