<?php

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

<style>
    

</style>

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

<div class="bd-example">
 
<?php foreach ($srvs as $srv_element) {
$ip =$srv_element['ip'];
$srv_id =$srv_element['id'];
?>
<div class="table-responsive">
    
  <table class="table table-dark">
    <thead>

      <tr>
        <th scope="col">سرور <?php echo $srv_element['title']; ?></th>
        <th scope="col">نمودار آپ داون 1 ساعت اخیر→ </th>
      </tr>

    </thead>
    <tbody>
    <?php foreach ($row as $element) {
    
    $url_id = $element['id'];
    $url = $element['url'];
    $sql = "SELECT status FROM urls_tracker where url='$url' AND srv='$ip'  ORDER BY id  DESC limit 60";
    $result = $conn -> query($sql);
    // Associative array
    $column = $result -> fetch_all(MYSQLI_ASSOC);
    
    ?>
      <tr class="bg-primary text-white">
        <th scope="row"><?php echo $element['title']; ?></th>
        <td><script>
    
    $("#sparkline_<?php echo $srv_id; ?>_<?php echo $url_id; ?>").sparkline([<?php foreach ($column as $spark_element) { echo $spark_element['status'].','; } ?>], {
    type: 'tristate',
    height: '20',
    zeroBarColor: '#3f67a8',
    barWidth: 20,
    zeroAxis: true});
    
    </script> <span id="sparkline_<?php echo $srv_id; ?>_<?php echo $url_id; ?>"></span></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php } ?>
</div>

</div>