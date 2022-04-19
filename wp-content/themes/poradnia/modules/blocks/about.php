<section class="about">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php $img = get_field('about_photo');?>
                <figure>
                    <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>" width="<?php echo $img['width'];?>" height="<?php echo $img['height'];?>" />
                </figure>
            </div>
            <div class="col">
            <?php the_field('about_desc');?>
            </div>
        </div>
    </div>
    <figure class="about__img about__img-left">
        <img src="/wp-content/themes/poradnia/img/left.webp" alt="Danka Kozłowska-Rup" width="533" height="738" />
    </figure>
    <figure class="about__img about__img-right">
        <img src="/wp-content/themes/poradnia/img/right.webp" alt="Danka Kozłowska-Rup" width="288" height="658" />
    </figure>
</section>