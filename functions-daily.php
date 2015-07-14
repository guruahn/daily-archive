<?php
/**
 * Daily WordPress Plugin Functions
 *
 * @package    Daily
 * @author     Gongjam
 * @license    GPL-2.0+
 * @link       http://www.gongjam.com
 * @copyright  2015 Gongjam
 *
 * @since    1.0
 * @version  1.4.2
 *
 * @link  http://www.gongjam.com
 *
 */


function daily_page_template( $page_template )
{
    if ( is_page( 'daily-index' )  ) {
        $new_template = locate_template( array( plugin_dir_path( __FILE__ ) . '/template-daily-index.php' ) );
        if ( '' != $new_template ) {
            return $new_template ;
        }
    }
    return $page_template;
}

function daily_init(){
    load_plugin_textdomain( 'daily-archive', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

}

function daily_add_page(){

    $the_page_title = 'Daily index';
    $the_page_name = 'daily-index';

    $page = get_page_by_path($the_page_name);
    if ( !$page ) {

        // Create post object
        $_p = array();
        $_p['post_title'] = $the_page_title;
        $_p['post_content'] = "This text may be overridden by the plugin. You shouldn't edit it.";
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = get_option('default_ping_status');
        $_p['post_category'] = array(1); // the default 'Uncatrgorised'
        //$_p['page_template'] = 'Daily Page Template';

        // Insert the post into the database
        $the_page_id = wp_insert_post( $_p );

    }
}

function daily_print_daily_arrow($arr_date){

    if(is_object($arr_date)) {
        if( !$arr_date->is_archive ) return;
        $arr_date = date_parse($arr_date->query_vars['year'].'-'.$arr_date->query_vars['monthnum'].'-'.$arr_date->query_vars['day']);
    }
    $str_date = $arr_date['year'].'-'.$arr_date['month'].'-'.$arr_date['day'];
    $prev_daily = date_parse(date('Y/m/d', strtotime('-1 day', strtotime($str_date))));
    $next_daily = date_parse(date('Y/m/d', strtotime('+1 day', strtotime($str_date))));
    $url_prev = home_url().'?year='.$prev_daily['year'].'&monthnum='.$prev_daily['month'].'&day='.$prev_daily['day'].'&is_daily=1';
    $url_next = home_url().'?year='.$next_daily['year'].'&monthnum='.$next_daily['month'].'&day='.$next_daily['day'].'&is_daily=1';
    ?>

    <nav class="navigation post-navigation" role="navigation">
        <h2 class="screen-reader-text">_e('Daily Navigation', 'daily-archive')</h2>
        <div class="nav-links">
            <div class="nav-previous">
                <a href="<?php echo $url_prev; ?>" rel="prev"><span class="meta-nav" aria-hidden="true"><?php _e('Previous day', 'daily-archive'); ?></span> <span class="screen-reader-text"><?php _e('Previous day', 'daily-archive') ?>:</span> <span class="post-title"><?php echo date(get_option('date_format'), strtotime($prev_daily['year'].'/'.$prev_daily['month'].'/'.$prev_daily['day']));?></span>
                </a>
            </div>
            <?php
            if( $next_daily != date_parse(date('Y/m/d', strtotime('+1 day', strtotime(date('Y/m/d'))))) ){;
                ?>
                <div class="nav-next">
                    <a href="<?php echo $url_next; ?>" rel="next"><span class="meta-nav" aria-hidden="true"><?php _e('Next day', 'daily-archive') ?></span> <span class="screen-reader-text"><?php _e('Next day', 'daily-archive') ?>:</span> <span class="post-title"><?php echo date(get_option('date_format'), strtotime($next_daily['year'].'/'.$next_daily['month'].'/'.$next_daily['day']));?></span>
                    </a>
                </div>
            <?php }?>
        </div>
    </nav>
<?php
}

function daily_404($template_404){
    $template_404 = plugin_dir_path( __FILE__ ) . '/daily-not-found.php';
    return $template_404;
}

function daily_archive_title($title=null){

    $title = date(get_option('date_format'), strtotime(get_query_var('year').'-'.get_query_var('monthnum').'-'.get_query_var('day')));

    return $title;
}


function daily_custom_archive_page($args){

    $is_daily = false;
    if(isset($_GET['is_daily']) && $_GET['is_daily']) $is_daily = true;
    if(is_archive() && $is_daily){

        //일별로 보여주고 전날/다음날 버튼 출력
        $arr_date = date_parse(get_query_var( 'year', '' ).'-'.get_query_var( 'monthnum', '' ).'-'.get_query_var( 'day', '' ));
        $date_query = array(
            array(
                'year'  => $arr_date['year'],
                'month' => $arr_date['month'],
                'day'   => $arr_date['day'],
            ),
        );
        set_query_var( 'date_query', $date_query );
        add_action('loop_end','daily_print_daily_arrow');
        add_filter('get_the_archive_title', 'daily_archive_title');
        if($args->post_count == 0) add_filter('404_template','daily_404');
    }
}





?>