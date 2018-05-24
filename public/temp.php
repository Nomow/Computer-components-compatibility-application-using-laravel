<?php 

include('Allfunctions.php');


// $series = [
// "Core i7",
// "Core i5",
// "Core i3",
// "Celeron ",
// "Pentium Dual-Core",
// "Pentium D",
// "Pentium",
// "FX",
// "A4",
// "A6",
// "A8",
// "A10",
// "Athlon X4",
// "Core 2 Duo",
// "Sempron",
// "Core 2 Quad",
// "Athlon X2",
// "Athlon II X2",
// "Athlon"
// ];

// $real_series= [
//  'FX-Series',
//   'A-Series APU',
// 'Null'
// ];

// $replace_series = [
// "FX",
// "A4",
// "A6",
// "A8",
// "A10"
// ];

/*

// SALIEK PAREIZOS SERIES

// iziet cauri visam arrajam
foreach ($cpu as $key => $value) {

foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc , 'Series') == 0 ){

// iziet cauri arajam ar atributiem, kas ir jamaina   
foreach ($real_series as $real_series_value) {

 // ja sakrit tad
if (strcmp($part_value, $real_series_value) == 0) {
    // iziet cauri velreiz tajam pasham arraja desc
 foreach ($value as $part_desc => $part_value) {
    // atrod Name 
  if ( strcmp($part_desc , 'Name') == 0 ){
    //Iziet cauri 
foreach ($series as $replace_value) {
      if (strpos($part_value, $replace_value) !== false) {


foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc , 'Series') == 0 ){
      $cpu[$key][$part_desc] = $replace_value;
}
}
}
}
}    
}
}
}
}
}

}




// PARMAINA CORES uz 4 6, 8 no dual quadra 6-core 8-core

foreach ($cpu as $key => $value) {

foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc , ' # of Cores') == 0 ){

$cpu[$key][$part_desc] = str_replace('-Core','',str_replace('Dual','2',str_replace('Quad','4',$part_value)));
}
}

}




// SOCKETS

foreach ($cpu as $key => $value) {

foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc , ' CPU Socket Type') == 0 ){
$cpu[$key][$part_desc] = str_replace(' ','',str_replace('Socket ','',str_replace('-','', $part_value)));
}
}

}

//$result = findSameValues('Series', $cpu);



// GHZ frequency

foreach ($cpu as $key => $value) {

foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc ,   ' Operating Frequency') == 0 ){
$cpu[$key][$part_desc] = str_replace(' ','', str_replace('GHz','', strtok($part_value,'(')));
}
}

}


foreach ($cpu as $key => $value) {

foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc ,   'Max Turbo Frequency') == 0 ){
$cpu[$key][$part_desc] = str_replace(' ','', str_replace('GHz','', strtok($part_value,'(')));
}
}

}


foreach ($cpu as $key => $value) {

foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc ,   ' Thermal Design Power') == 0 ){
$cpu[$key][$part_desc] = str_replace('W','',$part_value);
}
}
}


foreach ($cpu as $key => $value) {

foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc ,   ' Manufacturing Tech') == 0 ){
$cpu[$key][$part_desc] = str_replace('nm','',$part_value);
}
}

}

*/
/*
foreach ($cpu as $key => $value) {

foreach ($value as $part_desc => $part_value) {

if ( strcmp($part_desc ,   'Brand') == 0){
if (strcmp($part_value ,   'Intel') == 0 ) {
foreach ($value as $part_desc => $part_value) {

if ( strcmp($part_desc ,   ' # of Cores') == 0 ){
$temp = $part_value;
foreach ($value as $part_desc => $part_value) {
    if ( strcmp($part_desc ,   ' L1 Cache') == 0 ){
$cpu[$key][$part_desc] = $temp . ' x 64'. 'KB' ;
}
 if ( strcmp($part_desc ,   ' L2 Cache') == 0 ){
$cpu[$key][$part_desc] = $temp. ' x 256' . 'KB';
}
if ( strcmp($part_desc ,   ' L3 Cache') == 0 ){
$cpu[$key][$part_desc] = str_replace('shared','',str_replace(' ','',$part_value ));
}
}
}    
}
}
}

}
}
*/

$details = [
'Brand',
   'Series',
   'Model',
   //support cpu
   ' CPU Socket Type',
   'CPU Type',
   // chipset
   ' Chipset',
   //Memory
   'Number of Memory Slots',
   'Memory Standard',
   'Maximum Memory Supported',
  ' Channel Supported',
  // expansion
   'PCI Express 3.0 x16',
   'PCI Express x1',
'PCI Express 2.0 x16',
'PCI Slots',
 'PCI Express x16',
   'PCI Express x4',
'PCI Express x8',
   // storage
  ' SATA 6Gb/s',
   'SATA RAID',
 'M.2',
  'Features',
 'SATA Express',
   'eSATA',
' SATA 3Gb/s',
 ' mSATA',
  // onboard video
' Onboard Video Chipset',
// Lan 
'Max LAN Speed',
//rear panel ports
  
 ' USB 3.0',
 'USB 1.1/2.0',

 // Internal io 
 'Onboard USB',
 'Other Connectors',
 //physical 
 'Form Factor',
'Dimensions (W x L)',
 'Power Pin'];


$product_url = "http://www.newegg.com/Product/ProductList.aspx?Submit=ENE&IsNodeId=1&N=100007625+4814+600138080+600167117+600469846+600474773+600489959+600641738+50001312+50001314+50001315+50001944+600007961+600007963+600007965+600007967+600158776+600370574+600469847+600489958+600641737+600008414+600165296+600166242+600166260+600491552+600551574+600008387+600469841+600483626+600009016+600009017+600009028+600036384+600036385+600036387+600036398+600165298+600008629+600008635+600008639+600054094+600054095+600054096+600054097+600079335+600142899+600026696+600029965+600029967+600029969+600029971+600029973+600036414+600036416+600054621+600054623+600095898+600041408+600041409+600041410+600041411+600076612&Page=";

$path ='div[class=itemText] div[class=wrapper] a';


$partsarray = FindPartUrl(2, $product_url, $path);


$specification = [];
$count = 0;

foreach ($partsarray as $value) {
$html = file_get_html($value);
$path = $html->find('div[id=Specs] dl');

$specifiation []= array_fill_keys(
  array( // model
  'Brand',
   'Series',
   'Model',
   //support cpu
   ' CPU Socket Type',
   'CPU Type',
   // chipset
   ' Chipset',
   //Memory
   'Number of Memory Slots',
   'Memory Standard',
   'Maximum Memory Supported',
  ' Channel Supported',
  // expansion
   'PCI Express 3.0 x16',
   'PCI Express x1',
'PCI Express 2.0 x16',
'PCI Slots',
 'PCI Express x16',
   'PCI Express x4',
'PCI Express x8',
   // storage
  ' SATA 6Gb/s',
   'SATA RAID',
 'M.2',
  'Features',
 'SATA Express',
   'eSATA',
' SATA 3Gb/s',
 ' mSATA',
  // onboard video
' Onboard Video Chipset',
// Lan 
'Max LAN Speed',
//rear panel ports
  
 ' USB 3.0',
 'USB 1.1/2.0',

 // Internal io 
 'Onboard USB',
 'Other Connectors',
 //physical 
 'Form Factor',
'Dimensions (W x L)',
 'Power Pin'
 ),
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


echo '<pre>';
var_export($specifiation);
echo '</pre>';



/*
foreach ($mobo as $key => $value) {

foreach ($value as $part_desc => $part_value) {

// ja part desc sakrit ar series
if ( strcmp($part_desc , ' CPU Socket Type') == 0 ){
$mobo[$key][$part_desc] = str_replace(' ','',str_replace('Socket ','',str_replace('-','', str_replace('Socket H4','', 
    str_replace('Socket H3','', $part_value)))));
}
}

}
*/



// foreach ($mobo as $key => $value) {

// foreach ($value as $part_desc => $part_value) {
// foreach ($replace_detail as $replace) {

// // ja part desc sakrit ar series
// if ( strcmp($part_desc , $replace) == 0 ){
// if ($part_value != 'Null') {
// $mobo[$key][$part_desc] = str_replace(' ', '',substr($part_value ,0, 2));
// }
// }

// }

// }
// }



// $details =[


// 'CPU Type',  
//    'Number of Memory Slots',  
//    'Memory Standard', 
//   ' Channel Supported',
//    'SATA RAID',
//  ' USB 3.0',
//  'USB 1.1/2.0',
//  'Onboard USB',
//  'Other Connectors',

// 'Dimensions (W x L)',
//  'Power Pin'
/*
foreach ($mobo as $key => $value) {

foreach ($value as $part_desc => $part_value) {



if ( strcmp($part_desc , 'Number of Memory Slots') == 0 ){
if ($part_value != 'Null') {
 $mobo[$key]['memory pin'] = substr($part_value, 3); 
$mobo[$key][$part_desc] = substr($part_value ,0, 1);

}

}
}
}
*/


//    'CPU Type',  
//    'Memory Standard', 
//   ' Channel Supported',
//    'SATA RAID',
//  ' USB 3.0',
//  'USB 1.1/2.0',
//  'Onboard USB',
//  'Other Connectors',
// 'Dimensions (W x L)',
//  'Power Pin'

/*
foreach ($mobo as $key => $value) {

foreach ($value as $part_desc => $part_value) {



if ( strcmp($part_desc ,'Memory Standard') == 0 ){
if ($part_value != 'Null') {

$pal = str_replace(' ', '',str_replace('(OC)', '',str_replace('*', '',  str_replace('+', '', str_replace('.', '', $part_value)))));
$mobo[$key][$part_desc] = substr($pal, 0, 4) . " " . substr($pal, 4);
}
$result = findSameValues(   'Memory Standard', $mobo);

}}}
*/
/*
foreach ($mobo as $key => $value) {

foreach ($value as $part_desc => $part_value) {



if ( strcmp($part_desc ,'Memory Standard') == 0 ){
if ($part_value != 'Null') {

$pal = str_replace(' ', '',str_replace('(OC)', '',str_replace('*', '',  str_replace('+', '', str_replace('.', '', $part_value)))));
$mobo[$key][$part_desc] = substr($pal, 0, 4) . " " . substr($pal, 4);
}
}}}
*/
/*
foreach ($mobo as $key => $value) {

foreach ($value as $part_desc => $part_value) {



if ( strcmp($part_desc ,'memory pin') == 0 ){

    if ( strcmp($part_desc ,'memory pin') == 0 ){
if ($part_value != 'Null') {
$mobo[$key][$part_desc] = substr($part_value, 0, 3) . "" . substr($part_value, 3);
}
}
}
}
}
*/

// 'Brand' manufacturer


//     'Series' series 



 //   ' Core Name' => Core
//     ' # of Cores' => core
//     ' # of Threads' core
    //     ' L1 Cache' => '4 x 64KB',//cpu
//     ' L2 Cache' => '4 x 256KB',//cpu
//     ' L3 Cache' => '8MB',//cpu

//     'Name' // cpu
//     'Model' => cpu 
  //    ' Operating Frequency' cpu
//     'Max Turbo Frequency' cpu

//     ' Manufacturing Tech'  // cpu
//     ' Thermal Design Power' => '88', // cpu 
//     ' Hyper-Threading Support' cpu


//     ' CPU Socket Type' socket

//     'Integrated Graphics' => //gpu

// $details =[

//   'Brand',  
//    'Series',  
//    'Model',  
//    ' CPU Socket Type', 
//    'PCI Express 3.0 x16', 
//    'PCI Express x1',  
// 'PCI Express 2.0 x16', 
// 'PCI Slots', 
//  'PCI Express x16', 
//    'PCI Express x4', 
// 'PCI Express x8', 
//  'Form Factor', 
//   ' Chipset',  // viss ir 
//    'Maximum Memory Supported', 
//  'M.2',  
//  'SATA Express', 
//    'eSATA',  
// ' SATA 3Gb/s',  
//  ' mSATA', 
//   ' SATA 6Gb/s', 
// 'Max LAN Speed',   //  viss ir 
//  'Number of Memory Slots',  // ir


//    'CPU Type',  
  
//    'Memory Standard', 
//   ' Channel Supported',
//    'SATA RAID',
//  ' USB 3.0',
//  'USB 1.1/2.0',
//  'Onboard USB',
//  'Other Connectors',

// 'Dimensions (W x L)',
//  'Power Pin'
//   ];
// $replace_detail = [
//  'PCI Express 3.0 x16', 
// 'PCI Express 2.0 x16', 
//  'PCI Express x16', 


// ];
/*
foreach ($mobo as $key => $value) {
$temp = 0;
foreach ($value as $part_desc => $part_value) {

foreach ($replace_detail as $replace_value) {

if ( strcmp($part_desc ,$replace_value) == 0 ){
if ($part_value != 'Null'){
$temp  += $part_value;
  $mobo[$key]['pci_x16_slot'] = $temp;

}

}
}
}
}
*/

//$result = findSameValues( ' Thermal Design Power'  , $cpu);
$details = [

   'Brand',
  'Series',
  'Model',
   'Type',
   'Fan Size',
   'Compatibility',
 ' Bearing Type',
' RPM',
 ' Air Flow',
 'Noise Level',
'Power Connector',
  'Color',
' Heatsink Material',
 'Fan Dimensions',
 'Heatsink Dimensions',
 'Weight',
 'Features',
' LED',
 'Package Contents',
 ' Electrical Outlet Plug Type'

];



// foreach ($partsUrl as $url){

// $html = file_get_html($url);
// $part_path = $html->find($tag_path);

// foreach ($part_path as $items) {

  
// if(!in_array($items->children(0)->plaintext, $stack)){

// $stack[] = $items->children(0)->plaintext;


// }

// }
// }

// $specification = [];
// $count = 0;

// foreach ($partsarray as $value) {
// $html = file_get_html($value);
// $path = $html->find('div[id=Specs] dl');

// $specifiation []= array_fill_keys(
//   array(
//  'Brand',
//     'Series',
//     'Model',
//     'Type',
//     'Fan Size',
//     'Compatibility',
//    ' Bearing Type',
//     ' RPM',
//     ' Air Flow',
//     'Noise Level',
//     'Power Connector',
//     'Color',
//     ' Heatsink Material',
//     'Fan Dimensions',
//    'Heatsink Dimensions',
//     'Weight',
//     'Features',
//     ' LED',
//     'Package Contents',
//     ' Electrical Outlet Plug Type'

//  ),
//  'Null');




// foreach ($path as $items) {
//     foreach ($details as $value) {
    

// if ( strcmp($items->children(0)->plaintext , $value) == 0 ){
//       $specifiation[$count][$value] = $items->children(0)->next_sibling()->plaintext;
// }

// }
// }
// $count++;
//     }



// $product_url = "http://www.newegg.com/Product/ProductList.aspx?Submit=ENE&N=100158094++600014288+600014290+600014297+600136798+600326046+4814+50012120+50001935+50018537+50001315+50001413+50001233+50001924+50001479+50001762+600014249+600014251+600014252+600014256+600014259+600014261+600014263+600107140+600287657+600335684+600371425+600417759+600436851+600455813+600469837+600471998&IsNodeId=1&Page=";
// $desc_path ='div[id=Specs] dl';
// $path ='div[class=itemText] div[class=wrapper] a';



// $url = FindPartUrl(6, $product_url, $path);


// $part_desc = findPartDesc($url, $desc_path);



// echo '<pre>';
// var_export($part_desc);
// echo '</pre>';











// $details = [
//   0 => 'Brand',
//   1 => 'Model',
//   2 => 'Standards',
//   3 => 'Wireless Data Rates',
//   4 => 'Security',
//   5 => 'Interface',
//   6 => 'Frequency Band',
//   7 => 'Channels',
//   8 => 'Modulation',
//   9 => 'Transmitted Power',
//   10 => 'Antenna',
//   11 => 'Color',
//   12 => 'System Requirements',
//   13 => 'Features',
//   14 => 'Dimensions',
//   15 => 'Weight',
//   16 => 'Temperature',
//   17 => 'Humidity',
//   18 => 'Package Contents',
//   19 => 'LEDs',
//   20 => 'Part Number',
//   21 => 'Type',
//   22 => 'Class',
//   23 => 'Electrical Outlet Plug Type',
//   24 => 'Operating Range',

// ];




// $specifiation = [];
// $count = 0;

// foreach ($url as $value) {
// $html = file_get_html($value);
// $path = $html->find('div[id=Specs] dl');

// $specifiation []= array_fill_keys(
//   array( 
//   0 => 'Brand',
//   1 => 'Model',
//   2 => 'Standards',
//   3 => 'Wireless Data Rates',
//   4 => 'Security',
//   5 => 'Interface',
//   6 => 'Frequency Band',
//   7 => 'Channels',
//   8 => 'Modulation',
//   9 => 'Transmitted Power',
//   10 => 'Antenna',
//   11 => 'Color',
//   12 => 'System Requirements',
//   13 => 'Features',
//   14 => 'Dimensions',
//   15 => 'Weight',
//   16 => 'Temperature',
//   17 => 'Humidity',
//   18 => 'Package Contents',
//   19 => 'LEDs',
//   20 => 'Part Number',
//   21 => 'Type',
//   22 => 'Class',
//   23 => 'Electrical Outlet Plug Type',
//   24 => 'Operating Range',
//  ),
//  'Null');



// foreach ($path as $items) {
//     foreach ($details as $value) {
    

// if ( strcmp($items->children(0)->plaintext , $value) == 0 ){
//       $specifiation[$count][$value] = $items->children(0)->next_sibling()->plaintext;
// }

// }
// }
// $count++;
//     }


// echo '<pre>';
// var_export($specifiation);
// echo '</pre>';

// $product_url = "http://www.newegg.com/Product/ProductList.aspx?Submit=ENE&N=100158104++4814+50013328+50001186+50010418+50001762+50012120+50011704+50001467+600013857+600016289+600016290+600013871+600013872+600013873+600339922+600339927+600013858+50001157+600322698+100158104+50013328+50001186+50010418+50001762+50012120+50011704+50001467+50001157+4814+600013857+600016289+600016290+600013872+600013873+600013858+600322698+600013871&IsNodeId=1&Page=";
// $desc_path ='div[id=Specs] dl';
// $path ='div[class=itemText] div[class=wrapper] a';



// $url = FindPartUrl(4, $product_url, $path);




// $details = [
//   0 => 'Brand',
//   1 => 'Model',
//   2 => 'Standards',
//   3 => 'Speed',
//   4 => 'Connectors',
//   5 => 'Interface',
//   6 => 'LEDs',
//   7 => 'Wake On LAN',
//   8 => 'Temperature',
//   9 => 'Humidity',
//   10 => 'Features',
//   11 => 'Weight',
//   12 => 'Electrical Outlet Plug Type',
//   13 => 'BUS',
//   14 => 'Drivers',
//   15 => 'On-board Memory',
//   16 => 'Windows Vista',
//   17 => 'Package Contents',
//   18 => 'Dimensions',
// ];

// $specifiation = [];
// $count = 0;

// foreach ($url as $value) {
// $html = file_get_html($value);
// $path = $html->find('div[id=Specs] dl');

// $specifiation []= array_fill_keys(
//   array( 
//     0 => 'Brand',
//   1 => 'Model',
//   2 => 'Standards',
//   3 => 'Speed',
//   4 => 'Connectors',
//   5 => 'Interface',
//   6 => 'LEDs',
//   7 => 'Wake On LAN',
//   8 => 'Temperature',
//   9 => 'Humidity',
//   10 => 'Features',
//   11 => 'Weight',
//   12 => 'Electrical Outlet Plug Type',
//   13 => 'BUS',
//   14 => 'Drivers',
//   15 => 'On-board Memory',
//   16 => 'Windows Vista',
//   17 => 'Package Contents',
//   18 => 'Dimensions',
//  ),
//  'Null');



// foreach ($path as $items) {
//     foreach ($details as $value) {
    

// if ( strcmp($items->children(0)->plaintext , $value) == 0 ){
//       $specifiation[$count][$value] = $items->children(0)->next_sibling()->plaintext;
// }

// }
// }
// $count++;
//     }


echo '<pre>';
var_export($specifiation);
echo '</pre>';
?>