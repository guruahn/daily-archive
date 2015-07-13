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
                <h1 class="page-title">Nothing Found</h1>

            </header>
            <article id="post-4" class="post-4 post type-post status-publish format-standard hentry category-uncategorized">

                <header class="entry-header">
                    <h2 class="entry-title">이 날은 포스트가 없습니다.</h2>	</header><!-- .entry-header -->

                <div class="entry-content">
                    <p>네비게이션으로 다른 날로 이동하세요.</p>
                </div><!-- .entry-content -->


                <footer class="entry-footer">
                    <span class="posted-on"><span class="screen-reader-text">작성일자 </span><a href="http://daily.local/2015/07/07/multiple-paragraph-post/" rel="bookmark"><time class="entry-date published" datetime="2015-07-07T12:19:46+00:00">2015년 7월 7일</time><time class="updated" datetime="2015-07-10T12:21:26+00:00">2015년 7월 10일</time></a></span><span class="comments-link"><a href="http://daily.local/2015/07/07/multiple-paragraph-post/#respond">댓글 달기</a></span>		<span class="edit-link"><a class="post-edit-link" href="http://daily.local/wp-admin/post.php?post=4&amp;action=edit">편집</a></span>	</footer><!-- .entry-footer -->

            </article>
            <?php daily_print_daily_arrow($arr_date);?>
        </main><!-- .site-main -->

    </section>

<?php

get_footer();

?>