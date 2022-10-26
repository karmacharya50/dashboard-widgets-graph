<?php
/*
Plugin Name: Sk Dashboard Widget Graph 
Description: Simple graph display on Dashboard widget
Author: Samir Karmacharya
Version: 0.1.0
*/

define ( 'MY_APP_PLUGIN', trailingslashit( plugins_url( '/', __FILE__ ) ) );

register_activation_hook(__FILE__,'postg_activate');
function postg_activate(){
    include 'include/rank_activation.php';     
}

add_action( 'admin_enqueue_scripts', 'load_scripts' );
function load_scripts() {
    define('RANK_VERSION','0.1.0');
    wp_enqueue_style('wp_rank_graph_style', MY_APP_PLUGIN . '/assets/css/rank_graph.css', [], RANK_VERSION);
    wp_enqueue_script( 'wp_react_rank', MY_APP_PLUGIN . 'build/static/js/main.js', array(), RANK_VERSION, true );
    wp_localize_script('wp_react_rank', 'myapp',array(
        'apiUrl' => home_url('/wp-json')
    ));
}

//Create Rest API
function wl_rankgraph_list(){
    global $table_prefix, $wpdb;
        $table_name = $table_prefix . 'rank_graph_data';
        $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY `id` DESC LIMIT 0, 30"));
        $data = [];
        $i = 0;    
        foreach($results as $graph_data) {
            $data[$i]['id'] = $graph_data->id;
            $data[$i]['Name'] = $graph_data->nanme;
            $data[$i]['UV'] = $graph_data->data_uv;
            $data[$i]['PV'] = $graph_data->data_pv;
            $data[$i]['Value'] = $graph_data->value;           
            $i++;
        }    
        return $data;
    }

add_action( 'rest_api_init', function () {
    register_rest_route('wl/v1', 'rankgraph', [
		'methods' => 'GET',
		'callback' => 'wl_rankgraph_list',
	]);
    
  } );

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function my_app_rank_graph_widgets() {
    wp_add_dashboard_widget(
        'rank_graph_widgets',                          
        esc_html__( 'Rank Graph Widget', 'rankgraph' ),
        'rank_dashboard_widget_render'                    
    ); 
}
add_action( 'wp_dashboard_setup', 'my_app_rank_graph_widgets' );

//react render 
function rank_dashboard_widget_render() {   
    $rest_api_url=site_url()."/wp-json/wl/v1/rankgraph/";
   echo '<div id="rank_graph_root" data-url="'.$rest_api_url.'"></div>';
}

add_action('admin_menu','sk_rank_graph_menu');
function sk_rank_graph_menu(){
    add_menu_page('Rank Graph','Rank Graph',8,'rank-graph-dashboard','sk_rank_graph_file');

}
function sk_rank_graph_file(){
    include 'include/rank_setting.php';  
}

?>
