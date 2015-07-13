<?php
/**
 * Daily 404 page template
 *
 * @package    Modern
 * @copyright  2015 Userstorylab - gongjam
 * @version    1.0
 */



get_header();
$arr_date = date_parse(get_query_var( 'year', '' ).'-'.get_query_var( 'monthnum', '' ).'-'.get_query_var( 'day', '' ));

?>
    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <header class="page-header">
                <h1 class="page-title"><?php echo daily_archive_title(null); ?></h1>

            </header>
            <article id="post-4" class="post-4 post type-post status-publish format-standard hentry category-uncategorized">

                <header class="entry-header">
                    <h2 class="entry-title"><?php _e('There are no posts.', 'daily-archive'); ?></h2>	</header><!-- .entry-header -->

                <div class="entry-content">
                    <p><?php _e('Click the navigation at the bottom to move.', 'daily-archive'); ?></p>
                </div><!-- .entry-content -->




            </article>
            <?php daily_print_daily_arrow($arr_date);?>
        </main><!-- .site-main -->

    </section>

<?php

get_footer();

?>