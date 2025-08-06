<?php
ini_set('display_errors', 0);
set_time_limit(90);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//build array
$return_arr = array();


                    
$pingTarget = "1.1.1.1";
$pingTarget = $_GET['ip'];
$pingCount = 3;
//It's very important to escape shell arguments to avoid injection attacks.
$output = shell_exec('ping -i 0.1 -O -c'.escapeshellarg((int)$pingCount).' '.escapeshellarg($pingTarget));
if(empty($output))
{
 //echo "An error occured. Most likely an invalid or unreachable domain.";
    $return_arr['status'] = 'NOK'; 
    $return_arr['replay'] = 'An error occured. Most likely an invalid or unreachable domain.'; 
        echo json_encode($return_arr);
            exit(1);
}else {
    $return_arr['status'] = 'OK';
}
 

// echo 'Ping === '.$ping_replay;

 $return_arr['replay'] = $output;
  $return_arr['time'] = $ping_avg;

if(strpos($output, "100% packet loss") !== false){
    $return_arr['status'] = 'NOK2';
}
// Encoding array in JSON format
echo json_encode($return_arr);