<section class="text__section">
    <div class="container">
        <?php if(get_field('text_title')):?><h2 class="text-center"><?php the_field('text_title');?></h2>
        <?php endif;?>
        <?php the_field('text_desc');?>
    </div>
</section>