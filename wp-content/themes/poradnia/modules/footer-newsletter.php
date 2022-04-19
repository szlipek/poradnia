<footer class="footer__newsletter" id="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2><?php the_field('footer_news-title', 'option');?></h2>
                <?php the_field('footer_news-desc', 'option');?>
            </div>
            <div class="col">
                <?php the_field('footer_news-news', 'option');?>
            </div>
        </div>
    </div>
</footer>