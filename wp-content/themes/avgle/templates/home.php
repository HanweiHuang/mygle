<?php
/**
 * Template Name: Home_template
 *
 */

get_header();

$AVGLE_LIST_VIDEOS_API_URL = 'https://api.avgle.com/v1/videos/';
$page = 0;
$limit = '?limit=10';
$response = json_decode(file_get_contents($AVGLE_LIST_VIDEOS_API_URL . $page . $limit), true);
var_dump($response);
if ($response['success']) {
    $videos = $response['response']['videos'];

    //var_dump($videos);

}

include_once(ABSPATH . 'wp-content/themes/avgle/includes/DB.php');

$db = DB::getInstance();
$db2 = DB::getInstance();

if($db===$db2){
    echo "ssssss";
}

?>

	<div id="primary" >
		<div id="content" class="container" role="main">





		</div>	
	</div>


<?php get_footer(); ?>