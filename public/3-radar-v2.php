<?php
//jalali
include ('jdf.php');

   //sql
    include('../sql.php');
    
     // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    
 
     $sql = "SELECT id,ip,title FROM maral_srv_list where yz='1' ORDER BY id ";
    $result = $conn -> query($sql);
    // Associative array
    $srvs= $result -> fetch_all(MYSQLI_ASSOC);
    
    $sql = "SELECT id,url,title FROM urls where yz='1' ORDER BY id ";
    $result = $conn -> query($sql);
    // Associative array
    $row = $result -> fetch_all(MYSQLI_ASSOC);
    
    //print_r($row);
?>

<script type="text/javascript" src="/js/jquery.sparkline.min.js"></script>



<script>

               //$("#box").animate({ scrollTop: $('#box').prop("scrollHeight")}, 1000);

// $(document).ready(function(){

// window.onload = function() {
  
// };

//const intervalid = setInterval(trackerreload(), 30000);

  
 var interval = 15000; 



    //$("#load_btn").click(
        function trackerreload(url){
      // alert(url);
        var url = '3-radar.php';
        //append($('<div>').
        $("#box").load(url, function  (responseTxt, statusTxt, jqXHR){
            
            //var loader = document.getElementById("myspinner");
            //loader.style.display = 'block';
            
            if(statusTxt == "success"){
                //alert("New content loaded successfully!");
                //setTimeout(spindisable, 1000);
              //setTimeout(trackerreload, interval);
               
              document.getElementById('box').scrollIntoView({ behavior: 'smooth', block: 'end' });
            //   window.scrollTo(0, document.getElementById('box').offsetTop);
            //window.history.pushState('page2', 'Title', '/page2.php');
            
            }
            if(statusTxt == "error"){
                //alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                

                
            }
            
             function spindisable()
            {    
                // let's say JavaScript did have a sleep function..
                // sleep for 3 seconds
                loader.style.display = 'none';
            
            }
        });//)append
        
        
        
 

    };//func
    </script>

<style>

 .v_span { text-align: right;
  writing-mode: vertical-rl;
  transform: rotate(180deg); }
  
  .online { background-color: seagreen  !important;}
  .offline { background-color: crimson !important;}

.nowrap {
        white-space:nowrap;
    }

</style>


<div class="table-responsive" style="font-size: 15px;">
     
<?php foreach ($srvs as $srv_element) {
$ip =$srv_element['ip'];
$srv_id =$srv_element['id'];
?>

    
  <table class="table table-dark w-auto small">
    <thead>

      <tr>
        <th scope="col">سرور <?php echo $srv_element['title']; ?></th>
    <?php 
    
        $sql = "SELECT time FROM urls_tracker where srv='$ip' GROUP BY  time ORDER BY id  DESC limit 120";
        $result = $conn -> query($sql);
        // Associative array
        $column = $result -> fetch_all(MYSQLI_ASSOC);
        //print_r($column);
        ?>
        
        <?php foreach ($column as $vkey => $v_element) { ?> <th scope="col" class="th-v"><span class="v_span"><?php echo jdate("H:i",$v_element['time']); ?></span> </th> <?php } ?>
    
      </tr>

    </thead>
    <tbody>
    <?php foreach ($row as $element) {
    
    $url_id = $element['id'];
    $url = $element['url'];
    $sql = "SELECT status FROM urls_tracker where url='$url' AND srv='$ip'  ORDER BY id  DESC limit 120";
    $result = $conn -> query($sql);
    // Associative array
    $column = $result -> fetch_all(MYSQLI_ASSOC);
    
    ?>
      <tr class="bg-primary text-white">
        <th scope="row" class="nowrap"><?php echo $element['title']; ?></th>
        <?php foreach ($column as $spark_element) {  if($spark_element['status'] =='1') { echo '<td class="online">'; }else { echo '<td class="offline">'; } echo '</td>'; } ?>

      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php } ?>
</div>

