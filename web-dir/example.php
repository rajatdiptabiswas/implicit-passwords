<?php


/* $ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

$data = [
	'q' => 'Pied Piper',
	'location' => 'India',
	'search_engine' => 'google.com',
	'gl' => 'US',
    'hl' => 'en',
    'tbm' => 'isch',
    'num' => '5'
];

curl_setopt($ch, CURLOPT_URL, "https://app.zenserp.com/api/v2/search?" . http_build_query($data));

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	"Content-Type: application/json",
	"apikey: 55929320-0327-11ea-9000-590b3a068a5a",
));

$response = curl_exec($ch);
curl_close($ch);
$json = json_decode($response);
// $array = json_decode(json_encode($json), true);
// var_dump(print_r($array));

$pics = $json->image_results;
echo '<br><hr>';
foreach($pics as $pic) {
    echo '<img src="'.$pic->thumbnail.'">';
    echo '<br><hr>';
} */


$ch = curl_init();
  $api_url = "https://www.googleapis.com/customsearch/v1?";
  $data = [
    'q' => 'Einstein',
    'searchType' => 'image',
    'gl' => 'IN',
    'hl' => 'en',
    'num' => '4',
    'key' => 'AIzaSyAGUtw1zAmHZgkWe1t6N0wA3lAengwEirk',
    'cx' => '007209046880833147745:datbv1bddff',
    'imgSize' => 'medium',
  ];
curl_setopt($ch, CURLOPT_URL, $api_url.http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
$response = curl_exec($ch);
$err = 0;
$json = json_decode($response);
$arr = $json->items;
var_dump($arr[0]->image->thumbnailLink);
curl_close($ch);


   
?>