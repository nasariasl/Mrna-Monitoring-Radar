<?php

set_time_limit(0);


class test {
     public function newTest($tst){
          $pings[] = array(
             'bytes' => $pingLineMatches[1][$i][0],
             'host' => $pingLineMatches[2][$i][0],
             'ip' => $pingLineMatches[3][$i][0],
             'icmp_seq' => $pingLineMatches[4][$i][0],
             'ttl' => $pingLineMatches[5][$i][0],
             'time' => $tst,
            );
      return  $pings; 
     }

     private function bigTest(){
          //Big Test Here
     }

     private function smallTest(){
          //Small Test Here
     }

     public function scoreTest(){
          //Scoring code here;
     }
}


// opcache_invalidate(__FILE__, true);
// ini_set('opcache.enable', '0');
//  ini_set('opcache.enable', 0);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

function ping($host, $port, $timeout , $todo) 
{ 
    $done =0;
    while($done<$todo)
    {
      $tB = microtime(true); 
      $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
      if (!$fP) { return "down"; } 
      $tA = microtime(true); 
      return round((($tA - $tB) * 1000), 0)." ms" ."<br>"; 
      $times++;
    }

}

//Echoing it will display the ping if the host is up, if not it'll say "down".
echo ping("www.aparat.com", 80, 10,10);

echo '----';

$pingTarget = "baidu.com";
$pingTarget = "51.38.11.196";
$pingTarget = "www.aparat.com";
$pingTarget = "185.165.118.61";
$pingTarget = "188.209.152.1";
$pingTarget = "185.165.118.61";
$pingTarget = "39.108.255.53";
$pingCount = 1;
//It's very important to escape shell arguments to avoid injection attacks.
$output = shell_exec('ping -i 0.2 -O -c'.escapeshellarg((int)$pingCount).' '.escapeshellarg($pingTarget));
if(empty($output))
{
 echo "An error occured. Most likely an invalid or unreachable domain.";
 //exit(1);
}else {
    echo  $output;
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

var_dump($pingLineMatches);
var_dump($pingStatistics);
echo 'ping==='.$pingLineMatches[0][0];
//----
$servername = "127.0.0.1";
$database = "node1";
$username = "root";
$password = "5fd5ab27";
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
$sql = "INSERT INTO ping_result (time) VALUES ('$ping_avg')";
if (mysqli_query($conn, $sql)) {
     echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

// $pingTarget = "39.108.255.53";
// $pingCount = 1;

// $output2 = shell_exec('mtr -n  -j -c'.escapeshellarg((int)$pingCount).' '.escapeshellarg($pingTarget));

// $json_mtr = json_decode($output2, true);

// $x = end($json_mtr['report']['hubs']);

// var_dump($x);
// var_dump($json_mtr['report']['hubs']);


$fol = new test();
var_dump($fol->newTest('536'));
?>