<script>

               //$("#box").animate({ scrollTop: $('#box').prop("scrollHeight")}, 1000);

// $(document).ready(function(){
function mernajson(){
       
 var interval = 3000; 

        // $("#box").append($('<div>').load("1-ping-live-func.php", function  (responseTxt, statusTxt, jqXHR){
            
        //     var loader = document.getElementById("myspinner");
        //     loader.style.display = 'block';
            
        //     if(statusTxt == "success"){
        //         //alert("New content loaded successfully!");
        //         setTimeout(spindisable, 3000);
        //       setTimeout(reloadChat, interval);
               
        //       document.getElementById('box').scrollIntoView({ behavior: 'smooth', block: 'end' });
        //     //   window.scrollTo(0, document.getElementById('box').offsetTop);
        //     window.history.pushState('page2', 'Title', '/page2.php');
            
        //     }
        //     if(statusTxt == "error"){
        //         //alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                

                
        //     }
            
        //      function spindisable()
        //     {    
        //         // let's say JavaScript did have a sleep function..
        //         // sleep for 3 seconds
        //         loader.style.display = 'none';
            
        //     }
        // }));
        
        var ipbox = document.getElementById("ping-ip-box").value;
        
        
            $.ajax({
                type: "GET",
                url: 'https://radar.maus.ir/1-ping-3time-func.php?ip='+ipbox,
                dataType: "json",
                async:false,
                cache:false,
                error: function() {
                //   $("#box").html("<div class='p-3 mb-2 bg-danger text-white text-center' style='direction: ltr !important;'><p class='error'>Invalid Response.</p></div>");

                },
                success: function(response) {
                    console.log(response);
                    console.log(response.status);
                    if (response.status == 'OK') {
                        $("#box2").append($('<p class="p-3 mb-2 text-center mw-100" style="direction: ltr !important;white-space: pre-line;background-color: #212529;color: #deb887;">').html(response.replay)); 
                        //$('#content1').html(result[0]);
                        document.getElementById('box').scrollIntoView({ behavior: 'smooth', block: 'end' });
                        //$("#box2").html("");
                       // setTimeout(mernajson, interval);
                    }else if (response.status == 'NOK2'){
                        $("#box2").append($('<p class="p-3 mb-2 bg-danger text-white text-center" style="direction: ltr !important;">').html('Request TimeOut')); 
                            // setTimeout(mernajson, interval);

                     } else {
                          $("#box2").append($('<p class="p-3 mb-2 bg-danger text-white text-center" style="direction: ltr !important;">').html(response.replay)); 

                     }
                }
            });

    };//if page loaded
    //var timeout = setInterval(reloadChat, 7000);


// function average(arr) {
//   const min = Math.min(...arr);
//   const max = Math.max(...arr);
//   //filter the input array and exclude min and max values
//   const filterArr = arr.filter(x => x !== min && x !== max);
//   const sum = filterArr.reduce((acc, val) => acc + val, 0);
//   return sum / filterArr.length;
// }
// const arr = [10, 20, 30, 40, 50];
// const avg = average(arr);
// console.log( Math.min(...arr));
// console.log(Math.max(...arr));
// console.log(avg);

// const fruits = ["Banana", "Orange", "Apple", "Mango"];
// fruits.push("Kiwi");

</script>



<div class="container mt-3" id="box2">
  <h1>آزمایش تست پینگ ICMP</h1>


  <div class="input-group mb-3" >
    <input id='ping-ip-box' type="text" class="form-control" style="background-color: burlywood;" placeholder="آدرس آی پی سرور یا دامنه را وارد نمایید...">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button" onclick="mernajson();" >شروع</button>
     </div>
  </div>      <br>
</div>

