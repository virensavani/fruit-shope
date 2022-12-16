<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

</div><!-- .col-full -->
</div><!-- #content -->

<?php do_action('storefront_before_footer'); ?>

<footer class="site-footer">
    <div class="site-footer__inner container container--narrow">
        <div class="group">
            <div class="site-footer__col-one">
                <h1 class="school-logo-text school-logo-text--alt-color">
                    <a href="<?php echo site_url(); ?>"><strong><?php bloginfo('name'); ?></strong> </a>
                </h1>
                <p>1105 City Center 2, Science City Road</p>
                <p>, Near CIMS Hospital, 380060</p>
                <p><a class="site-footer__link" href="https://www.karmaleen.com/">www.karmaleen.com</a></p>
            </div>

            <div class="site-footer__col-two-three-group">
                <div class="site-footer__col-two">
                    <h3 class="headline headline--small">Explore</h3>
                    <nav class="nav-list">
                        <?php
						wp_nav_menu(array(
							'theme_location' => 'footerLocationOne'
						));
						?>
                    </nav>
                </div>

                <div class="site-footer__col-three">
                    <h3 class="headline headline--small">Learn</h3>
                    <nav class="nav-list">
                        <?php
						wp_nav_menu(array(
							'theme_location' => 'footerLocationTwo'
						));
						?>
                    </nav>
                </div>
            </div>

            <div class="site-footer__col-four">
                <h3 class="headline headline--small">Connect With Us</h3>
                <nav>
                    <ul class="min-list social-icons-list group">
                        <li>
                            <a href="#" class="social-color-facebook">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="social-color-twitter">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="social-color-youtube">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="social-color-linkedin">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="social-color-instagram">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</footer><!-- #colophon -->

<?php do_action('storefront_after_footer'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>