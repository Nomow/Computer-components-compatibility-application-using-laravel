<?php 


include('simple_html_dom.php');

set_time_limit(0);



//finds all part urls
function FindPartUrl($page_count, $product_url, $tag_path){

$arr = array () ;

$counter = 0;

//
for ($i=0; $i <$page_count ; $i++) { 
	$counter++;
$html = file_get_html($product_url . $counter);
$items = $html->find($tag_path);

foreach($items as $element) {

$arr[] = $element->href ;

}
}

return $arr;

}



// Finds all possible descriptions of parts
function FindPartDesc($partsUrl, $tag_path){

$stack = array();


foreach ($partsUrl as $url){

$html = file_get_html($url);
$part_path = $html->find($tag_path);

foreach ($part_path as $items) {

	
if(!in_array($items->children(0)->plaintext, $stack)){

$stack[] = $items->children(0)->plaintext;


}

}
}

return $stack;

}




function findSpecificValue($desc_name, $part_array){

$stack = [];

foreach ($part_array as $key => $value) {

foreach ($value as $part_desc => $part_value) {

if ( strcmp($part_desc , $desc_name) == 0 ){

$stack[] = $part_value;


}
}
}
return $stack;
}


function findSameValues($desc_name, $part_array){

$stack = [];

foreach ($part_array as $key => $value) {

foreach ($value as $part_desc => $part_value) {



if ( strcmp($part_desc , $desc_name) == 0 ){
if(!in_array($part_value, $stack)){

$stack[] = $part_value;

}
}
}
}
return $stack;
} 

function rdump($data){
	echo "<pre>";
var_dump($data);
echo "</pre>";
}

function export($data){

    echo "<pre>";
	var_export($data);
    echo "</pre>";
}

function pr($data)
{
    echo "<pre>";
    print_r($data); // or var_dump($data);
    echo "</pre>";
}

function printArray($data){
	$count = 0;
foreach ($data as $val) {
	$count++;
echo "$count :".$val . '<br>';
}
}


$details = array( 
"Brand",
"Series",
"Name",
"Model",
" CPU Socket Type",
" Core Name",
" # of Cores",
" # of Threads",
" Operating Frequency",
"Max Turbo Frequency",
" L1 Cache",
" L2 Cache",
" L3 Cache",
" Manufacturing Tech",
" Hyper-Threading Support",
"Integrated Graphics",
" Thermal Design Power"

 	);

$series = [
"Core i7",
"Core i5",
"Core i3",
"Celeron ",
"Pentium D",
"Pentium",
"FX",
"A4",
"A6",
"A8",
"A10",
"Athlon X4",
"Core 2 Duo",
"Sempron",
"Core 2 Quad",
"Athlon X2",
"Athlon II X2",
"Athlon"
];



/*
$parturl ='http://www.newegg.com/Product/ProductList.aspx?Submit=ENE&IsNodeId=1&N=100007671+50001028+50001157+4016+4814&Page=';
$path ='div[class=itemCell] div[class=itemText] div[class=wrapper] a';

$partsarray = FindPartUrl(5, $part_url, $tag_path);


$specifiation = [];
$count = 0;

foreach ($partsarray as $value) {
$html = file_get_html($value);
$path = $html->find('div[id=Specs] dl');

$specifiation []= array_fill_keys(
  array( "Brand",
"Series",
"Name",
"Model",
" CPU Socket Type",
" Core Name",
" # of Cores",
" # of Threads",
" Operating Frequency",
"Max Turbo Frequency",
" L1 Cache",
" L2 Cache",
" L3 Cache",
" Manufacturing Tech",
" Hyper-Threading Support",
"Integrated Graphics",
" Thermal Design Power"),
 'Null');

//$html = file_get_html('http://www.newegg.com/Product/Product.aspx?Item=N82E16819113398');



foreach ($path as $items) {
	foreach ($details as $value) {
	

if ( strcmp($items->children(0)->plaintext , $value) == 0 ){
	  $specifiation[$count][$value] = $items->children(0)->next_sibling()->plaintext;
}

}
}
$count++;
	}
export($specifiation);
*/

?>