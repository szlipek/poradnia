<section class="columns columns__two">
    <div class="container">
        <div class="columns__row">
            <div class="col">
            <h2><?php the_field('col_title');?></h2>
            <?php the_field('col_desc');?>
        </div>
        <div class="col">
            <?php $img = get_field('col_img'); ?>
            <figure>
                <img src="<?php echo $img['url'];?>" alt="<?php echo $img['alt'];?>" width="<?php echo $img['width'];?>" height="<?php echo $img['height'];?>" />
            </figure>
        </div>
    </div>
</section>