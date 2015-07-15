<?php
/**
 * Daily Page Template
 *
 * Template Name: Daily Page
 *
 * @package    Daily
 * @copyright  2015 Daily - guruahn
 * @version    1.0
 */
?>

<?php
get_header();
//Query setup
$query = array(
    'post_type'           => 'post',
    'posts_per_page'      => 100,
    'paged'               => 1,
    'ignore_sticky_posts' => true,
);
$add = 0;$loop = true;
$daily_year = (isset($_GET['y']) ? $_GET['y'] : '');
$daily_month = (isset($_GET['m']) ? $_GET['m'] : '');
$daily_day = (isset($_GET['d']) ? $_GET['d'] : '');

if(empty($daily_year) || empty($daily_month) || empty($daily_day) ){
    //날짜 세팅 안되있을 경우 (홈) 자동으로 최신 포스트의 날짜를 기준으로 한다.
    while($loop){
        $today = date('Y-m-d G:i:s');
        if($add !== 0 ) $today = date('Y-m-d', strtotime($add.' day', strtotime($today)));
        $date = $today;
        $arr_date = date_parse($date);
        $query['date_query'] = array(
            array(
                'year'  => $arr_date['year'],
                'month' => $arr_date['month'],
                'day'   => $arr_date['day'],
            ),
        );
        $blog_posts = new WP_Query( $query );

        if(!$blog_posts->have_posts()){
            $add -= 1;
        }else{
            $loop = false;
        }
    }
}else{
    $arr_date = date_parse($daily_year.'-'.$daily_month.'-'.$daily_day);
    $query['date_query'] = array(
        array(
            'year'  => $arr_date['year'],
            'month' => $arr_date['month'],
            'day'   => $arr_date['day'],
        ),
    );
    $blog_posts = new WP_Query( $query );

}

?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if ( $blog_posts->have_posts() ) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php echo date(get_option('date_format'), strtotime($arr_date['year'].'-'.$arr_date['month'].'-'.$arr_date['day']));?></h1>
                </header>

                <?php
                // Start the loop.

                while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'content', get_post_format() );

                    // End the loop.
                endwhile;


            // If no content, include the "No posts found" template.
            else :
                get_template_part( 'content', 'none' );

            endif;
            daily_print_daily_arrow($arr_date);
            ?>

        </main><!-- .site-main -->
    </section><!-- .content-area -->

<?php get_footer(); ?>