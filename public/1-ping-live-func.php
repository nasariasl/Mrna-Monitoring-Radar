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
$pingCount = 1;
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
 
//This regex will grab each ping line.
$pingLineRegex = "/([0-9]+) bytes from (.+): icmp_seq=([0-9]+) ttl=([0-9]+) time=([0-9\.]+) ms/"; 
//This regex grabs the aggregated results at the bottom.
$pingResultRegex = $re = "/--- (.+) ping statistics ---\\n([0-9]+) packets transmitted, ([0-9]+) received, ([0-9\\.]+)% packet loss, time ([0-9]+)ms\\nrtt min\\/avg\\/max\\/mdev = ([0-9\\.]+)\\/([0-9\\.]+)\\/([0-9\\.]+)\\/([0-9\\.]+) ms/"; 
 
 
preg_match_all($pingLineRegex, $output, $pingLineMatches);
$pings = array();
//Array position 0 contains each matched line entirely. We use this to grab the count.
$pingCount = count($pingLineMatches[0]);
for($i=0;$i<$pingCount;$i++)
{
    
 $pings[] = array(
 'bytes' => $pingLineMatches[1][$i][0],
 'host' => $pingLineMatches[2][$i][0],
 'ip' => $pingLineMatches[3][$i][0],
 'icmp_seq' => $pingLineMatches[4][$i][0],
 'ttl' => $pingLineMatches[5][$i][0],
 'time' => $pingLineMatches[6][$i][0],
 );
 
 $bytes = $pingLineMatches[1][$i][0];
 $host = $pingLineMatches[2][$i][0];
 $ip = $pingLineMatches[3][$i][0];
 $icmp_seq = $pingLineMatches[4][$i][0];
 $ttl = $pingLineMatches[5][$i][0];
 $time = $pingLineMatches[6][$i][0];
 
}
 

 
preg_match_all($pingResultRegex, $output, $pingResultMatches);
$pingStatistics = array(
 'host' => $pingResultMatches[1][0],
 'tx' => $pingResultMatches[2][0],
 'rx' => $pingResultMatches[3][0],
 'loss' => $pingResultMatches[4][0],
 'time' => $pingResultMatches[5][0],
 'min' => $pingResultMatches[6][0],
 'avg' => $pingResultMatches[7][0],
 'max' => $pingResultMatches[8][0],
 'mdev' => $pingResultMatches[9][0],
);
 
$ping_avg = $pingResultMatches[7][0];
$ping_replay = $pingLineMatches[0][0];

// echo 'Ping === '.$ping_replay;

 $return_arr['replay'] = $ping_replay;
  $return_arr['time'] = $ping_avg;

if(strpos($output, "100% packet loss") !== false){
    $return_arr['status'] = 'NOK2';
}
// Encoding array in JSON format
echo json_encode($return_arr);