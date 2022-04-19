<header class="header">
    <div class="container">
     <?php if( have_rows('header__slider') ): ?>
         <div class="header__slider">
         <?php while( have_rows('header__slider') ): the_row();
             $image = get_sub_field('header__slider-img');
             ?>
             <div class="header__slider-slide">
                <div class="flex">
                 <div class="header__slider-slide-text">
                    <h2><?php the_sub_field('header__slider-title');?></h2>
                    <?php the_sub_field('header__slider-desc');?>
                    <?php
                    $link = get_sub_field('header__slider-link');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                 </div>
                 <figure class="header__slider-img">
                    <img class="no-lazyload" src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" width="<?php echo $image['width'];?>" height="<?php echo $image['height'];?>" />
                 </figure>
                 </div>
             </div>
         <?php endwhile; ?>
         </div>
     <?php endif; ?>
    </div>
    <figure class="header__img">
        <img src="/wp-content/themes/poradnia/img/header.webp" alt="poradnia laktacyjna Mataja" width="1920" height="902"/>
    </figure>
</header>