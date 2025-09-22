<?php include(public_path() . '/front_header.php'); ?>

  <body>
        <!-- Navigation-->
        <nav  class="navbar navbar-expand-lg navbar-dark" style="background-color: #051103;">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href=""> پنجره خدمات مانیتورینگ تحت وب</a>
                <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>-->
                <!--<div class="collapse navbar-collapse" id="navbarSupportedContent">-->
                <!--    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">-->
                <!--        <li class="nav-item"><a class="nav-link active" aria-current="page" href="">صفحه اصلی</a></li>-->
                <!--        <li class="nav-item"><a class="nav-link" href="#!">درباره ما</a></li>-->
                <!--        <li class="nav-item dropdown">-->
                <!--            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">T1</a>-->
                <!--            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">-->
                <!--                <li><a class="dropdown-item" href="#!">All</a></li>-->
                <!--                <li><hr class="dropdown-divider" /></li>-->
                <!--                <li><a class="dropdown-item" href="#!">A1</a></li>-->
                <!--                <li><a class="dropdown-item" href="#!">A2</a></li>-->
                <!--            </ul>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</div>-->
            </div>
        </nav>
        <!-- Header-->
        <!--<header class="py-5 mena-header">-->
        <!--    <div class="container px-4 px-lg-5 my-5" >-->
        <!--        <div class="text-center text-white">-->
        <!--            <h1 class="display-4 fw-bolder">ناخدا صفر و یک</h1>-->
        <!--            <p class="lead fw-normal text-white-50 mb-0">سرویس مانیتورینگ و تست صفحات</p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</header>-->
        <!-- Section-->
        <section class="py-5 mrna-section">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="mernabody">
                    

                    <div class="col mb-5" onclick="mernaloadbody('1-ping-list.php');">
                        <div class="card">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo BASE_URL ; ?>assets/Ping.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">آزمایش پینگ</h5>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col mb-5" onclick="mernaload('2-mrt.php');">
                        <div class="card">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo BASE_URL ; ?>assets/MRT.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">آزمایش Trace Route</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="col mb-5" onclick="mernaload('3-radar.php');">-->
                    <!--    <div class="card">-->
                            <!-- Product image-->
                    <!--        <img class="card-img-top" src="{{ URL::asset('assets/Tracker.png') }}" alt="..." />-->
                            <!-- Product details-->
                    <!--        <div class="card-body p-4">-->
                    <!--            <div class="text-center">-->
                                    <!-- Product name-->
                    <!--                <h5 class="fw-bolder">Tracker</h5>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <div class="col mb-5" id="tracker_v" onclick="mernaload_loop_click('3-radar-v2.php','tracker_v');">
                        <div class="card">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo BASE_URL ; ?>assets/Tracker.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Tracker-V2</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
<script>

               //$("#box").animate({ scrollTop: $('#box').prop("scrollHeight")}, 1000);

// $(document).ready(function(){



    //$("#load_btn").click(
        function mernaload_loop_click(url,click_id){
      // alert(url);

        //append($('<div>').
        $("#box").load(url, function  (responseTxt, statusTxt, jqXHR){
            
            //var loader = document.getElementById("myspinner");
            //loader.style.display = 'block';
            
            if(statusTxt == "success"){
                //alert("New content loaded successfully!");
               // setTimeout(spindisable, 1000);
                console.log(url);
            //   setTimeout(mernaload_loop(url), 150000);
             
             //get loop id
             clr_t = setTimeout(function() { document.getElementById(click_id).click(); }, 5000);
               
              ////document.getElementById('box').scrollIntoView({ behavior: 'smooth', block: 'end' });
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


    //$("#load_btn").click(
        function mernaload(url){
      // alert(url);
      
      //Clear loop
                clearTimeout(clr_t);
                
        //append($('<div>').
        $("#box").load(url, function  (responseTxt, statusTxt, jqXHR){
            
            var loader = document.getElementById("myspinner");
            loader.style.display = 'block';
            
            if(statusTxt == "success"){
                //alert("New content loaded successfully!");
                setTimeout(spindisable, 1000);
              //setTimeout(reloadChat, interval);
               
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
    
    
    function mernaloadbody(url){
      // alert(url);
      
      //Clear loop
                clearTimeout(clr_t);

        //append($('<div>').
        $("#mernabody").load(url, function  (responseTxt, statusTxt, jqXHR){
            
            var loader = document.getElementById("myspinner");
            loader.style.display = 'block';
            
            if(statusTxt == "success"){
                //alert("New content loaded successfully!");
                setTimeout(spindisable, 1000);
              //setTimeout(reloadChat, interval);
               
              document.getElementById('mernabody').scrollIntoView({ behavior: 'smooth', block: 'end' });
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
    
jQuery(window).on("load", function () {
    


 // $("#box").animate({ scrollTop: $('#box').prop("scrollHeight")}, 1000);

// var objDiv = document.getElementById("box");
// objDiv.scrollTop = objDiv.scrollHeight;

 //$("#box").animate({ scrollTop: $('#box').prop("scrollHeight")}, 1000);
 
   
    //var timeout = setInterval(reloadChat, 7000);
});
</script>


    <div id="box"> </div>
    
<?php include(public_path() . '/front_footer.php'); ?>