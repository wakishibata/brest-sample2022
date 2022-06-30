
    </main>
    <!--/main end-->

    <footer class="l-footer">
        <small class="l-footer__copyright font-robotslab200">©BREST All Rights Reserved.</small>
    </footer>

    <nav class="l-gnav js-fullscreen">
    	<div class="l-gnav__content">
    		<ul class="l-gnav__menu">
	    		<li class="l-gnav__menu__item js-slidein"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to top page</a></li>
	    	</ul>
	    	<div class="l-gnav__sns">
	    		<a href="https://www.instagram.com/" target="_blank" class="l-gnav__sns__item js-slidein"><img src="<?php echo get_stylesheet_directory_uri() ?>/common/img/ico-instagram-wh.svg" alt="Instagram" /></a>
	    		<!--<a href="#" class="l-gnav__sns__item js-slidein"><img src="<?php echo get_stylesheet_directory_uri() ?>/common/img/ico-facebook-wh.svg" alt="facebook" /></a>-->
	    	</div>
    	</div>
    </nav>

</div>
<?php wp_footer(); ?>
</body>
</html>