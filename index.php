<?php
//echo phpinfo();
//exit;
use simplehtmldom_1_5\simple_html_dom;
use function simplehtmldom_1_5\str_get_html;

require_once 'vendor/autoload.php';
$db = new Db(
    "127.0.0.1",
    "3306",
    "first",
    "root",
    ""
);
require_once 'phpQuery/phpQuery/phpQuery.php';
require_once 'curl/curl.php';
require_once 'Simple/simple/simple_html_dom.php';
header('Content-type: text/html; charset=utf-8');

function print_arr($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
}
function get_content($curl) {
    $ch = curl_init($curl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

$curl = new Curl();
$query = '';
$response = $curl->get('https://www.coupons.com/store-loyalty-card-coupons/' . $query);
//С помощью DOM выкачиваем код
//var_dump($response->body);
$dom = get_content($response);
$doc= phpQuery::newDocument($response->body);
//////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
$products = $doc->find('.store-pod');
foreach($products as $product) {
    $pq = pq($products);
    $pq ->find('.store-cp-savings')->remove();
    $text = $pq->find('.store-browse')->html();
    $url = $pq->attr('href');
    }

    echo $text;
    echo '<hr>';
    echo $url;
    echo '<hr>';

//    $urls = preg_match_all('|<a href="(.*?)">|uis', $response, $result);
//    $urls = $pq->find('.other-stores .store-pod')->html('$urls');
//    for($i=0; $i<$urls; $i++){
//     echo $result[1][$i].'<hr>';
//    }



?>


