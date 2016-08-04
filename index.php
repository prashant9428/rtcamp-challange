<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title>welcome to rtcamp challange |prashant pathak</title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/main.css" rel="stylesheet" >
<link href="css/responsive.css" rel="stylesheet" >
    <script src="js/spin.min.js"></script>
   <script src="js/responsiveslides.min.js"></script>
			 <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager: true,
			        nav: true,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
			<!----//End-slider-script---->
                        
<script type="text/javascript">
				$(window).load(function() { 
				$('#status').fadeOut(); 
				$('#preloader').delay(350).fadeOut('slow'); 
				$('body').delay(350).css({'overflow':'visible'});
				})
				//]]>
		</script> 

</head>
    	
  <?php
      include_once('fbconfig.php');
  
                use Facebook\GraphObject;
		use Facebook\GraphSessionInfo;
		use Facebook\Entities\AccessToken;
		use Facebook\HttpClients\FacebookHttpable;
		use Facebook\HttpClients\FacebookCurl;
		use Facebook\HttpClients\FacebookCurlHttpClient;
		use Facebook\FacebookSession;
		use Facebook\FacebookRedirectLoginHelper;
		use Facebook\FacebookRequest;
		use Facebook\FacebookResponse;
		use Facebook\FacebookSDKException;
		use Facebook\FacebookRequestException;
		use Facebook\FacebookAuthorizationException;
  //session create
   $google_session_token = "";
   try{
       if(isset($session)){
           $_SESSION['login_info'] = $session;
           $_SESSION['fb_token']=$session ->getToken();
           
           $user = datafromfacebook("/me" );
           
           $_SESSION['user_id']= $user['id'];
           $_SESSION['username']=$user['name'];
       
			if ( isset( $_SESSION['google_session_token'] ) ) {
				$google_session_token = $_SESSION['google_session_token'];
			}
  
  
  ?>
  <body>
      
      <!-- preloader before the page starts -->
       <div id="preloader">
			<div id="status">&nbsp;</div>
		</div>
     
     <!--user info name and logout details -->
       <div class="header text-center">
			
            <div id="header_con">
				<img class="img-circle"
						src="https://graph.facebook.com/<?php echo $user['id']; ?>/picture"
						style="margin-right: 10px; " alt="" /><br>
                                                <h1><?php echo $user['name']; ?></h1>
			
                            
                 <a href="logout.php"><button class="btn btn-default " type="button" >logout </button>  </a>
      
   
    
            </div>
    </div>
	
     <!-- nave bar -->
       <div class="header-section">
			<!----- start-header---->
			<div id="home" class="header">
				<div class="container">
					<div class="top-header">
						
						<!----start-top-nav---->
						 <nav class="top-nav">
							<ul class="top-nav">
								<li><a href="#" id="download-all-albums">Download All</a></li>
								<li><a href="#" id="download-selected-albums">Download Selected</a></li>
								<li class="page-scroll"><a href="#" id="move_all" class="scroll">Move All</a></li>
								<li class="page-scroll"><a href="#" id="move-selected-albums" class="scroll">Move Selected </a></li>
								
							</ul>
							<a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
						</nav>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
      </div>
       
      <!-- album selected jumbotron box --> 
       <div class="jumbotron" >
   
      
                     <div id="heading1"> 
              
                             <h2 style="size: 100px;"></h1>
              
                     </div>
                              <h2>Album selected :0</h2>
          
        
                     <div  class="design col-md-12">
                               <img src="images/sad-cart.png" height="250px">
   
                    </div>
        
                             
        
    </div>
     
     <!-- Album download report window -->   
     <div class="">
         <span id="loader" ></span>
       <div class="modal fade" id="download-modal" tabindex="-1"
					role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Albums Report</h4>
							</div>
							<div class="modal-body" id="display-response">
								<!-- Response is displayed over here -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default"
									data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
   </div>
         </div>
     
    
          
          
        <div class="row">
            
        </div>
      <?php
		$albums = datafromfacebook( "/me/albums" );
		
		if (! empty ( $albums )) {
			
			foreach ( $albums ['data'] as $album ) {
				$album = ( array ) $album;
				
				$album_photo = datafromfacebook( '/' . $album ['id'] . '/photos?fields=source' );
				if (! empty ( $album_photo )) {
					foreach ( $album_photo ['data'] as $alb ) {
						$alb = ( array ) $alb;
					}
					
					?>
                    <div class="col-sm-4 col-md-4">
						<span> <a href="#"><?php echo $album['name']; ?></a>
						</span>

						<div class='thumbnail'
							style='overflow: hidden; height: 200px; width: 210px; padding-bottom: 1%; '>
							<div
								style='overflow: hidden; height: 200px; width: 210px; padding-bottom: 1%;'>
								<a href="slide.php?ida=<?php echo $album['id']; ?>"> <img
									style='box-shadow: 2px 2px 1.5px 1.5px #9d9d9d; position: relative;'
									src="<?php  echo $alb['source']; ?> " /></a>
							</div>
						</div>
						<div class="input-group" style="">
							<span class="input-group-addon input-sm"> 
                                                            <input
								class="select-album"type="checkbox"
								value="<?php echo $album['id'].','.$album['name'];?>" />
							</span>
							<button rel="<?php echo $album['id'].','.$album['name'];?>"
								class="single-download btn btn-default btn-sm"
								title="Download Album">
								<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
							</button>
							<button type="button" class="move-single-album btn btn-default btn-sm">
								<span class="glyphicon glyphicon glyphicon-share"
									aria-hidden="true">Move</span>
							</button>
						</div>
                        
                 
                        
                        
					</div>
                      <?php
				}
			}
		}
 }else{
     
     ?>
            
          <div id="preloader">
			<div id="status">&nbsp;</div>
	  </div>    

                
       <!-- main page slider and login info -->            
          <div  class="jumbotron1 text-center">
              <br>
                  <br>
                       <br>
               
                  
                      <button class="btn btn-default"  <!-- Slideshow 4 -->
			    <div  id="top" class="callbacks_container">
			      <ul class="rslides" id="slider4">
			        <li>
                                     <img src="images/slide.jpg" width="100%" height="100%" alt="">
			          <div class="caption text-center">
			          	<div class="slide-text-info">
			          		<h1>Introducing <br><br> <span>facebook <br><br>photos</span></h1>
			          		
			          		
			          		<div class="clearfix"> </div>
			          		
			          	</div>
			          </div>
			        </li>
                                <li>
			           <img src="images/slide1.jpg" width="100%" height="100%" alt="">
			          <div class="caption text-center">
			          	<div class="slide-text-info">
			          		<h1>just one <br><br>login to your <br><br><span>Account </span></h1>
			          		
			          		
			          		<div class="clearfix"> </div>
			          		
			          	</div>
			          </div>
			        </li>
			        <li>
			           <img src="images/slide.jpg" width="100%" height="100%" alt="">
			          <div class="caption text-center">
			          	<div class="slide-text-info">
			          		<h1>And click <br><br>on Your<br><br><span> Album</span></h1>
			          		
			          		
			          		<div class="clearfix"> </div>
			          		
			          	</div>
			          </div>
			        </li>
			        <li>
			          <img src="images/slide3.jpg" width="100%" height="100%" alt="">
			          <div class="caption text-center">
			          	<div class="slide-text-info">
			          		<h1>And here <br><br>is your<br><br> <span> Download</span></h1>
			          		
			          		
			          		<div class="clearfix"> </div>
			          		
			          </div>
			        </li>
			        
			      </ul>
			    </div>
			    <div class="clearfix"> </div>         
                            </button>
                    <br>
                        <br>
                     <a href="<?php echo $helper->getLoginUrl (array("user_photos","public_profile"));?>">
                        
                        <button  type="button" class="btn btn-primary" </a>    <h3>Login to Facebook</h3></button></a> 

        </div>
            
            
              
  <?php
   } 
   }catch ( Exception $ex ) {
	echo $ex;
}
  ?>      
        </div>     
        
        
    </body>   
    
    
</html>
<script type="text/javascript">

$( document ).ready(function() {
				var opts = {
				  lines: 13 // The number of lines to draw
, length: 56 // The length of each line
, width: 22 // The line thickness
, radius: 42 // The radius of the inner circle
, scale: 1 // Scales overall size of the spinner
, corners: 1 // Corner roundness (0..1)
, color: '#000' // #rgb or #rrggbb or array of colors
, opacity: 0.25 // Opacity of the lines
, rotate: 0 // The rotation offset
, direction: 1 // 1: clockwise, -1: counterclockwise
, speed: 1 // Rounds per second
, trail: 60 // Afterglow percentage
, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
, zIndex: 2e9 // The z-index (defaults to 2000000000)
, className: 'spinner' // The CSS class to assign to the spinner
, top: '70%' // Top position relative to parent
, left: '50%' // Left position relative to parent
, shadow: false // Whether to render a shadow
, hwaccel: false // Whether to use hardware acceleration
, position: 'absolute' // Element positioning Element positioning // Left position relative to parent
				};
				var target = document.getElementById('loader');

					
	function append_download_link(url) {
           var spinner = new Spinner(opts).spin(target);
					$.ajax({
						url:url,
						success:function(result){
                                                        
							$("#display-response").html(result);
                                                        spinner.stop();
							$("#download-modal").modal({
								show: true
							});
						}
					});
				}
    
	$("#download-all-albums").on("click", function() {
        append_download_link("download_album.php?zip=1&all_albums=all_albums");

	});
//single download
    				$(".single-download").on("click", function() {
        
					var rel = $(this).attr("rel");
					var album = rel.split(",");

					append_download_link("download_album.php?zip=1&single_album="+album[0]+","+album[1]);
				});

  //giffy and selective function  
     var count=0;
     
   $(function(){
       $("#heading1 h2").html("select your albums  and downlaod and make my giffy smile  ;-)").fadeOut(10000);
     
   });
       
      
    
    $('input[type="checkbox').click(function() {
       
        
        if ($(this).is(':checked') ) {
           count++;
           
           $("p").text(count);
           
         $(".design").html("<img src='images/smile-cart.jpg' height='250px';>");    
     
            
            
        }
       if(!$(this).is(':checked')){
            count--;
            
           $(".design").html("<img src='images/sad-cart.png 'height='250px';>");
          
        }
        function display(){
            $("h2").html("Album Selected :" +count);
            
           
        }
        
        display();
         
    });
    
    
    
    //get selected data/lib
    
    function get_all_selected_albums() {
        
					var selected_albums;
					var i = 0;
					$(".select-album").each(function () {
						if ($(this).is(":checked")) {
							if (!selected_albums) {
								selected_albums = $(this).val();
							} else {
								selected_albums = selected_albums + "/" + $(this).val();
							}
						}
					});
					return selected_albums;
				}
//selected data
    $("#download-selected-albums").on("click", function() {
        
					var selected_albums = get_all_selected_albums();
					append_download_link("download_album.php?zip=1&selected_albums="+selected_albums);
				});
                                
                                function getParameterByName(name) {
					name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
					var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
						results = regex.exec(location.search);
					return results === null ? "null" : decodeURIComponent(results[1].replace(/\+/g, " "));
				}

				function display_message( response ) {
					if ( response == 1 ) {
						$("#display-response").html('<div class="alert alert-success" role="alert">Album(s) is successfully moved to Picasa</div>');
						$("#download-modal").modal({
							show: true
						});
					} else if ( response == 0 ) {
						console.log(response);
						$("#display-response").html('<div class="alert alert-danger" role="alert">Due to some reasons album(s) is not moves to Picasa</div>');
						$("#download-modal").modal({
							show: true
						});
					}
				}

				get_params();

				function get_params() {
					var response = getParameterByName('response');
					display_message(response);
				}
				

				var google_session_token = '<?php echo $google_session_token;?>';

				function move_to_picasa(param1, param2) {
					if (google_session_token) {
						var spinner = new Spinner(opts).spin(target);

						$.ajax({
							url:"download_album.php?ajax=1&"+param1+"="+param2,
							success:function(result){
								spinner.stop();
								display_message(result);
							}
						});
					} else {
						window.location.href = "libs/google_login.php?"+param1+"="+param2;
					}
				}

				$(".move-single-album").on("click", function() {
					var single_album = $(this).attr("rel");
					move_to_picasa("single_album", single_album);
				});

				$("#move-selected-albums").on("click", function() {
					var selected_albums = get_all_selected_albums();
					move_to_picasa("selected_albums", selected_albums);
				});

				$("#move_all").on("click", function() {
					move_to_picasa("all_albums", "all_albums");
				});
                 
	});			
                                                          
</script>
