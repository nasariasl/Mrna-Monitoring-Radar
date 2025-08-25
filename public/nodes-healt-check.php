<?php
//save
include('../sql.php');

//get node IP From Header -> Not used anymore since 2025/AUG
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}


if (isset($_GET['title']) && !empty($_GET['title'])) {

    if (isset($_GET['title']) && !empty($_GET['title'])) {
        $title = $_GET['title'];
    } else {
        $title = "NAN";
    }

    if (isset($_GET['user']) && !empty($_GET['user'])) {
        $user = $_GET['user'];
    } else {
        $user = "NAN";
    }

// Get ip from Static Value
    if (isset($_GET['node_ip']) && !empty($_GET['node_ip'])) {
        $ip = $_GET['node_ip'];
    } else {
        $ip = "192.168.1.1";
    }
	
    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        //die("Connection failed: " . mysqli_connect_error());
    }
    //echo "Connected successfully";
    $sql = "INSERT IGNORE INTO   maral_srv_list (ip,title,user) VALUES ('$ip','$title','$user') ON DUPLICATE KEY UPDATE 
    title = '$title',
    user = '$user'
    ";

    if (mysqli_query($conn, $sql)) {
        //echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "SELECT url, title FROM urls ORDER BY id";
    $result = $conn->query($sql);

    // Associative array
    $row = $result->fetch_all(MYSQLI_ASSOC);

    //print_r($row);

    foreach ($row as $element) {


    }
    mysqli_close($conn);
}

?>


echo $urls = '<?php echo serialize($row); ?>';
$urls_array = unserialize($urls);

//print_r($test);

foreach ($urls_array as $element) {

if(fsockopen($element['url'],443, $errno, $errstr, 5))
{
//print "I can see port 443";
$result[$element['url']]= '1';
}
else
{
//print "I cannot see port 443";
$result[$element['url']]= '-1';
}

}

//print_r($result);

$post_result=base64_encode(serialize($result));

$FileContents = file_get_contents("https://radar.maus.ir/nodes-healt-check.php?post_result=".$post_result);


$output = ob_get_contents();
$file = 'run_log.txt';
$message = $output . "\n\n";
file_put_contents($file, $message);

<?php

if (isset($_GET['post_result']) && !empty($_GET['post_result'])) {

    $array = unserialize(base64_decode($_GET["post_result"]));

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    $time = time();

    foreach ($array as $key => $element) {

        //echo "Connected successfully";
        $sql = "INSERT IGNORE INTO   urls_tracker (srv,url,status,time) VALUES ('$ip','$key','$element','$time') ";
        $result = $conn->query($sql);
    }

}

?>