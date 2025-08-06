<?php 
// $cmd = "ping -c 15 google.com";

// $descriptorspec = array(
//   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
//   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
//   2 => array("pipe", "w")    // stderr is a pipe that the child will write to
// );
// flush();
// $process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());
// echo "<pre>";
// if (is_resource($process)) {
//     while ($s = fgets($pipes[1])) {
//         print $s;
//         flush();
//     }
// }
// echo "</pre>";

// echo '<pre>';
// passthru($cmd);
// echo '</pre>';

// while (@ ob_end_flush()); // end all output buffers if any

// $proc = popen($cmd, 'r');
// echo '<pre>';
// while (!feof($proc))
// {
//     echo fread($proc, 4096);
//     @ flush();
// }
// echo '</pre>'; */
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ping AJAX</title>
</head>
<body>
    <div>
        Domain/IP Address: <input id="domain" type="text"> 
        <input id="ping" type="button" value="Ping">
    </div>
    <div id="result"></div>
    <script>
        function updateText(domain) {
            var ajax = new XMLHttpRequest();
              ajax.onreadystatechange = function() {
                if (this.readyState == 3) {
                  var old_value = document.getElementById("result").innerHTML; 
                  document.getElementById("result").innerHTML = this.responseText;
                }               
            };          
            var url = 'ajax.php?domain='+domain;
            ajax.open('GET', url,true);
            ajax.send();
        }
        document.getElementById("ping").onclick = function(){
            domain = document.getElementById("domain").value;
            updateText(domain);
        }
    </script>
</body>
</html>
