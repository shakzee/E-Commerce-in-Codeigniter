<?php $air_craft = JR_Main::get_register_var('air_craft'); ?>
<?php //$cities = JR_Main::get_register_var('cities_map'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
if(document.getElementById('last_bc').innerHTML=='Aircraft Gallery Detail')
{
	document.getElementById('last_bc').innerHTML='<?php echo $air_craft->aircraft_make.' '.$air_craft->aircraft_model;  ?>';
}
</script>

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<?php $skzalimg = array(); //shakzee variable for aircraft more pictures.?>
	<aside class="airport_directory_specific_airport">

			<div class="clearfix"></div>

				<h1 class="text-center"> <!--the specific aircraft --> <?php echo $air_craft->aircraft_make.' '.$air_craft->aircraft_model; ?></h1>
  
				<div class="clearfix"></div>

				<h4 class="pull-left text-uppercase color_d1b87f"><?php echo $air_craft->aircraft_make.' '.$air_craft->aircraft_model; ?></h4>

				<a href="javascript:history.back()" class="a_bg_color text-center pull-right heavy_jet_a">Back</a>
				
				<div class="clearfix"></div>

				<h4 class="text-uppercase color_d1b87f">Specs and Performance</h4>
                
				<div class="clearfix"></div>

				<div class="col-md-6 padding_left">
					<figure>
							<?php 
							$aircraft_model = str_replace(' ', '_', $air_craft->aircraft_model);
							$aircraft_make = str_replace(' ', '_', $air_craft->aircraft_make);
							$img_shakzee = $aircraft_make.'_'.$aircraft_model;
						    global $wpdb;
							$dbName = $wpdb->dbname;
							$dbUsername = $wpdb->dbuser;
							$dbPassword = $wpdb->dbpassword;
							$dbHost = $wpdb->dbhost;
						
							$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

							$query_skz = $db->query("SELECT `image_name` FROM `wp_images` WHERE  image_name  LIKE '%".$img_shakzee."%'");

							if($air_craft->aircraft_id > 1078)
							{
								$file_path = site_url().'/wp-content/uploads/image-gallery/'.$air_craft->photo1;
								//$file_path = site_url().'/wp-content/uploads/image-gallery/default.png';
						
							}
						
							elseif($query_skz->num_rows > 0){
								while ($row = $query_skz->fetch_assoc()) {	
									$photo =  $row['image_name'];
									$file_path = 'http://www.jetrequest.com/2JRAircraftPictures/Aircraft%20Pictures/'.$photo;	
								} 
							}
							$timgskz = $db->query("Select aircraft.aircraft_id,aircraft.aircraft_model,aircraft.model_number, 
							tailnumber.tail_numberid,tailnumber.aircraft_id,tail_number, 
							tailnumber_images.filename,tailnumber_images.tail_numberid 
							From tailnumber_images,aircraft,tailnumber 
							where tailnumber.aircraft_id = aircraft.aircraft_id AND 
							tailnumber_images.tail_numberid = tailnumber.tail_numberid AND  aircraft.aircraft_id = '".$air_craft->aircraft_id."' group by aircraft.aircraft_id");//group by aircraft.aircraft_id
							$myquery = $timgskz->fetch_assoc();
							if($timgskz->num_rows > 0)
							{
								$air_model_skz = str_replace(' ', '_', $myquery['aircraft_model']);
								$air_make_skz = str_replace(' ', '_', $myquery['aircraft_make']);
								$imgskz = $myquery['tail_numberid'].'_'.$air_make_skz.'_'.$air_model_skz;
								$file_path = 'http://www.jetrequest.com/2JRAircraftPictures/Aircraft%20Pictures/Tail%20Numbers/'.$myquery['filename'];
									
							}
							else{
								$file_path = site_url().'/wp-content/uploads/image-gallery/default.png'; 
							}
							
							/*else
							{
								$file_path = site_url().'/wp-content/uploads/image-gallery/default.png';
							}*/
						
						?>
                
		                <a href="<?php echo $file_path ?>">
		            		 <img class="border_gray img-responsive" src="<?php echo $file_path ?>"
		           			  alt="Picture-of-<?= $air_craft->photo1 ?>-Aircraft gallery">
		             	</a>
					</figure>

					<div class="clearfix"></div>

					<h5><a href="#morephotos" class="text_decoration_none text">See More Photos</a></h5>
                    <ul class="bombardier_ul">
						<li>Typical Seating Capacity:<span><?php echo isset_filter( $air_craft->typical_passengercapacity, '-' ); ?></span></li>

						<li>Maximum Seat Configuration:	<span><?php echo isset_filter( $air_craft->maximum_passengercapacity, '-' ); ?></span></li>

						<li>Typical Lavatory :	<span><?php echo isset_filter( $air_craft->lavatory, '-' ); ?></span></li>

						<li>Cabin Height (ft):	<span><?php echo isset_filter( $air_craft->cabin_height, '-' ); ?></span></li>

						<li>Cabin Width (ft):<span><?php echo isset_filter( $air_craft->cabin_width, '-' ); ?></span></li>

						<li>Cabin Length (ft):	<span><?php echo isset_filter( $air_craft->cabin_length, '-' ); ?></span></li>

						<li>Cabin Volume (cubic feet):<span><?php echo isset_filter( $air_craft->ac_cabin_volume_cubic_feet, '-' ); ?></span></li>

						<li>Cabin Door Height (ft):<span><?php echo isset_filter( $air_craft->door_height, '-' ); ?></span></li>

						<li>Cabin Door Width (ft):<span><?php echo isset_filter( $air_craft->door_width, '-' ); ?></span></li>

						<li>Baggage Volume- Internal<br>(cubic feet):	<span><?php echo isset_filter( $air_craft->baggage_internal, '-' ); ?></span></li>

						<li>Baggage Volume- External<br>(cubic feet):	<span><?php echo isset_filter( $air_craft->baggage_external, '-' ); ?></span></li>

						<li>Engine Manufacturer:<span><?php echo isset_filter( $air_craft->engine_make, '-' ); ?></span></li>

						<li>Engine Model:<span><?php echo isset_filter( $air_craft->engine_model, '-' ); ?></span></li>

						<li>Number of Engines:<span><?php echo isset_filter( $air_craft->number_ofengines, '-' ); ?></span></li>

					</ul>

				</div>

				<div class="col-md-6">
					<ul class="bombardier_ul_right">
						<li>Model of Aircraft:<span><?php echo $air_craft->aircraft_make; ?></span></li>

						<li>Model:<span><?php echo $air_craft->aircraft_model; ?></span></li>

						<li>Make and Model:<span><?php echo $air_craft->model_number; ?></span></li>

                        <li>Class:<span><?php echo $air_craft->aircraft_class; ?></span></li>

						<li>First Year Delivered:<span><?php echo isset_filter( $air_craft->first_yeardelivered, '-' ); ?></span></li>

						<li>Last Year Produced:<span><?php echo isset_filter( $air_craft->last_yearproduced, '-' ); ?></span></li>

						<li>Approximate Number Built:<span><?php echo isset_filter( $air_craft->number_built, '-' ); ?></span></li>

						<li>Aircraft Height:<span><?php echo isset_filter( $air_craft->aircraft_height, '-' ); ?></span></li>

						<li>Aircraft Length:<span><?php echo isset_filter( $air_craft->aircraft_length, '-' ); ?></span></li>

						<li>Aircraft Wingspan:<span><?php echo isset_filter( $air_craft->aircraft_wingspan, '-' ); ?></span></li>

						<li>Wing Area (sq fit):<span><?php echo isset_filter( $air_craft->wingarea_ordiscarea, '-' ); ?></span></li>

						<li>Range- Seats Full (miles):<span><?php echo isset_filter( $air_craft->ac_range_seats_full_miles, '-' ); ?></span></li>

						<li>Range- Ferry Range (miles):<span><?php echo isset_filter( $air_craft->ferry_rangemi, '-'); ?></span></li>

						<li>Normal Cruise Speed (mph):<span><?php echo isset_filter( $air_craft->cruise_speedmph, '-'); ?></span></li>

						<li>Long Range Cruise Speed (mph) :<span><?php echo isset_filter( $air_craft->long_rangespeedmph, '-'); ?></span></li>

						<li>Maximum Cruise Speed (mph) :<span><?php echo isset_filter( $air_craft->max_speedmph, '-' ); ?></span></li>

						<li>Maximum Takeoff Weight (lb):<span><?php echo isset_filter( $air_craft->max_takeoff_weight_MTOW, '-' ); ?></span></li>

						<li>Maximum Landing Weight (lb):<span><?php echo isset_filter( $air_craft->max_landingweight, '-' ); ?></span></li>

						<li>Basic Operating Weight (lb):<span><?php echo isset_filter( $air_craft->basic_operatingemptyweight, '-' ); ?></span></li>

						<li>Fuel Capacity (gallons) :<span><?php echo isset_filter( $air_craft->fuel_capacity, '-' ); ?></span></li>

						<li>Payload with Full Fuel (lb):<span><?php echo isset_filter( $air_craft->useful_load, '-' ); ?></span></li>

						<li>Maximum Payload (lb):<span><?php echo isset_filter( $air_craft->max_payloadwithfullfuel, '-' ); ?></span></li>

						<li>Service Ceiling (ft):<span><?php echo isset_filter( $air_craft->service_ceiling, '-' ); ?></span></li>

						<li>Rate of Climb (fpm):<span><?php echo isset_filter( $air_craft->rate_of_climb, '-' ); ?></span></li>

						<li>BFL MTOW (ft):<span><?php echo isset_filter( $air_craft->ac_bfl_mtow_ft, '-' ); ?></span></li>

						<li>Take-Off Distance (ft) :<span><?php echo isset_filter( $air_craft->takeoff_distance, '-' ); ?></span></li>

						<li>Landing Distance (ft):<span><?php echo isset_filter( $air_craft->landing_distance, '-' ); ?></span></li>

						<li>Blade Material:<span><?php echo isset_filter( $air_craft->blade_material, '-' ); ?></span></li>

						<li>Rotor Type:<span><?php echo isset_filter( $air_craft->rotor_type, '-' ); ?></span></li>

						<li>Main Rotor Diameter (ft):<span><?php echo isset_filter( $air_craft->main_rotordiameter, '-' ); ?></span></li>

						<li>Disc Area:<span><?php echo isset_filter( $air_craft->ac_disc_area, '-' ); ?></span></li>

						<li>HIGE max gross std day:<span><?php echo isset_filter( $air_craft->HIGEmaxgrossstdday, '-' ); ?></span></li>

						<li>HOGE max gross std day:<span><?php echo isset_filter( $air_craft->HOGEmaxgrossstdday, '-' ); ?></span></li>

					</ul>

				</div>

				<div class="clearfix"></div>

				<h4 class="text-uppercase color_d1b87f"><?php echo $air_craft->model_number; ?> INFORMATION</h4>

                <p><?php echo isset_filter( $air_craft->description, '-' ); ?> </p>

				<h4 class="text-uppercase color_d1b87f">RANGE MAPS <?php echo $air_craft->aircraft_make; ?> <?php echo $air_craft->model_number; ?></h4>

				<h6><span class="black_clr">1. &nbsp;</span>Select a Departure City</h6>
                <?php  $url =  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>
               <?php
						   
				global $wpdb;
				$dbName = $wpdb->dbname;
				$dbUsername = $wpdb->dbuser;
				$dbPassword = $wpdb->dbpassword;
				$dbHost = $wpdb->dbhost;
				//connect with the database
					$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
				$query = $db->query("SELECT `name` FROM `cities_map` ORDER BY `name`");?>
				<select class="select_style" id="country_map"  onchange="city(this.value);">
               			 <option value="New York"> Select Country</option>
	                <?php while ($row = $query->fetch_assoc()) { ?>
	                    <option value="<?= $row['name'];?> ">
	                    	<?= $row['name'];?>
	                    </option>
	                    <?php } ?>
				</select>
                
               <div class="clearfix"></div>
				<!--<h6><span class="black_clr">2. &nbsp;</span>Select a Cruise Speed</h6>
				<form class="cruise_speed">
					<input type="radio" name="radiobtn" ><label>High Speed</label>
					<input type="radio" name="radiobtn" ><label>Long Range</label>
				</form>
                -->
                <?php
					
					$aircraft_model = str_replace(' ', '_', $air_craft->aircraft_model);
					$urlshkzie = "http://www.jetrequest.com/2JRAircraftPictures/Aircraft%20Pictures/";
					 
					if(getimagesize($urlshkzie.$aircraft_model.'_interior.jpg'))
					{
						$skzalimg[] = $urlshkzie.$aircraft_model.'_interior.jpg';
						
					}
					else if(getimagesize($urlshkzie.$aircraft_model.'_Interior.jpg'))
					{
						$skzalimg[] = $urlshkzie.$aircraft_model.'_Interior.jpg';
					}
					else if(getimagesize($urlshkzie.$aircraft_model.'_interior.JPG'))
					{
						$skzalimg[] = $urlshkzie.$aircraft_model.'_interior.JPG';
					}
					else if(getimagesize($urlshkzie.$aircraft_model.'_Interior.JPG'))
					{
						$skzalimg[] = $urlshkzie.$aircraft_model.'_Interior.JPG';
					}
					

					//exterior here
					if(getimagesize($urlshkzie.$aircraft_model.'_exterior.jpg'))
					{
						$skzalimg[] = $urlshkzie.$aircraft_model.'_exterior.jpg';
						
					}
					else if(getimagesize($urlshkzie.$aircraft_model.'_Exterior.jpg'))
					{
						$skzalimg[] = $urlshkzie.$aircraft_model.'_Exterior.jpg';
					}
					else if(getimagesize($urlshkzie.$aircraft_model.'_exterior.JPG'))
					{
						$skzalimg[] = $urlshkzie.$aircraft_model.'_exterior.JPG';
					}
					else if(getimagesize($urlshkzie.$aircraft_model.'_Exterior.JPG'))
					{
						$skzalimg[] = $urlshkzie.$aircraft_model.'_Exterior.JPG';
					}
					
					
					/*for($ski = 1; $ski <= 3; $ski++)
					{
						if(getimagesize($urlshkzie.$aircraft_model.'_interior.jpg'.$ski))
						{
							$skzalimg[] = $urlshkzie.$aircraft_model.'_interior.jpg'.$ski;
							
						}
						else if(getimagesize($urlshkzie.$aircraft_model.'_Interior.jpg'.$ski))
						{
							$skzalimg[] = $urlshkzie.$aircraft_model.'_Interior.jpg'.$ski;
						}
						else if(getimagesize($urlshkzie.$aircraft_model.'_interior.JPG'.$ski))
						{
							$skzalimg[] = $urlshkzie.$aircraft_model.'_interior.JPG'.$ski;
						}
						else if(getimagesize($urlshkzie.$aircraft_model.'_Interior.JPG'.$ski))
						{
							$skzalimg[] = $urlshkzie.$aircraft_model.'_Interior.JPG'.$ski;
						}
						

						//exterior here
						if(getimagesize($urlshkzie.$aircraft_model.'_exterior.jpg'.$ski))
						{
							$skzalimg[] = $urlshkzie.$aircraft_model.'_exterior.jpg'.$ski;
							
						}
						else if(getimagesize($urlshkzie.$aircraft_model.'_Exterior.jpg'.$ski))
						{
							$skzalimg[] = $urlshkzie.$aircraft_model.'_Exterior.jpg'.$ski;
						}
						else if(getimagesize($urlshkzie.$aircraft_model.'_exterior.JPG'.$ski))
						{
							$skzalimg[] = $urlshkzie.$aircraft_model.'_exterior.JPG'.$ski;
						}
						else if(getimagesize($urlshkzie.$aircraft_model.'_Exterior.JPG'.$ski))
						{
							$skzalimg[] = $urlshkzie.$aircraft_model.'_Exterior.JPG'.$ski;
						}
					}*/
					
					//var_dump($skzalimg);
					
				
				?>
                
              <div id="map" style="width: 100%; height: 300px;" ></div>

				<div class="clearfix"></div>

				<div class="clearfix"></div>

                
				<style>
					.term-gallery-images img{
						height: 140px;
						width: 185px;
						margin-left: 27px;
						margin-right: 20px;
						}
	               
	               #owl-demo .item a img{  padding: 1px}
				   #owl-demo .item{
				   color: #FFF;
				   -webkit-border-radius: 3px;
				   -moz-border-radius: 3px;
				   border-radius: 3px;
				   text-align: center;
				   }
				   
				   .customNavigation{
					text-align: center;}
					.customNavigation a{
					-webkit-user-select: none;
					-khtml-user-select: none;
					-moz-user-select: none;
					 -ms-user-select: none;
					 user-select: none;
					 -webkit-tap-highlight-color: rgba(0, 0, 0, 0);}
                </style>
                <?php $urll = site_url().'/wp-content/uploads/image-gallery/'; ?>
                <?php $air_craft_gallery = JR_Main::get_register_var('air_craft_gallery'); 
				
				$aircraft_model = str_replace(' ', '_', $air_craft->aircraft_model);
				$aircraft_make = str_replace(' ', '_', $air_craft->aircraft_make);
				$imgg = $aircraft_make.'_'.$aircraft_model;
				//echo $imgg;
				$query = $db->query("SELECT `image_name` FROM `wp_images` WHERE  image_name  LIKE '%".$imgg."%'");
				
				 $urli = "http://www.jetrequest.com/2JRAircraftPictures/Aircraft%20Pictures/";
				while ($row = $query->fetch_assoc()) { 
				if(getimagesize($urli.$row['image_name']))
				{
					$skzalimg[] = $urli.$row['image_name'];
				}
				/*echo '<div class="item ">
					<a href="'.$urli.$row['image_name'].'">
						<img class="border_gray" src="'.$urli.$row['image_name'].'" title="<?= $img->aircraft_model ?>" width="185" height="150" alt="'.$row['image_name'].'">
					</a> </div>';*/
			 
				} 
				
				foreach($air_craft_gallery as $img): 			
				if( $img->aircraft_model !=  $air_craft->aircraft_model )
				{
					continue;
					if(getimagesize($urll.$img->photo1))
					{
						$skzalimg[] = $urll.$img->photo1;
					}
					if(getimagesize($urll.$img->photo2))
					{
						$skzalimg[] = $urll.$img->photo2;
					}
					if(getimagesize($urll.$img->photo3))
					{
						$skzalimg[] = $urll.$img->photo3;
					}

					
				}
				endforeach; 
				/*if($img->photo1 != '-' || $img->photo2 != '-' || $img->photo3 != '-' || $img->photo1 != '' || $img->photo2 != '' || $img->photo3 != ''){
					continue;
				}*/
			
				?>
				<?php if(!empty($skzalimg) && count($skzalimg) > 0): ?>
					<h4 class="text-uppercase color_d1b87f"><?= $air_craft->aircraft_model ?> Picture</h4>
					<div class="term-gallery-images" id="morephotos">
						<div id="owl-demo2" class="owl-carousel owl-theme">
							<?php for($cshkz = 0; $cshkz < count($skzalimg); $cshkz++): ?>
							<div class="item ">
								<a href="<?php echo $skzalimg[$cshkz]?>">
									<img class="border_gray" src="<?php echo $skzalimg[$cshkz]?>" title="<?= $img->aircraft_model ?>" width="185" height="150" alt="<?= $air_craft->aircraft_model ?> Picture">
								</a> 
							</div>
							<?php endfor; ?>
						</div>
						<div class="customNavigation">
							 <a class="btn prev1 glyphicon glyphicon-backward"></a>
							 <a class="btn next1 glyphicon glyphicon-forward"></a>
						 </div>
					</div>
				<?php endif; ?>
				</div>
                
				
				<div class="clearfix"></div>
				<h4 class="text-uppercase color_d1b87f">Similar Aircraft</h4>
				<div class="clearfix"></div>
				<div id="owl-demo" class="owl-carousel owl-theme">
						<?php foreach($air_craft_gallery as $img):
							 if($img->photo1 == '-' || $img->photo1 == '' || $img->photo2 == '-' || $img->photo2 == '' ||
							 $img->photo3 == '-' || $img->photo3 == '' && $img->aircraft_model !=  $air_craft->aircraft_model )
							{
								continue;
							}							
						?>
                          <div class="item ">
                           <a href="<?= site_url()?>/aircraft-gallery-detail/?id=<?= $img->aircraft_model ?>">
                            <img class="border_gray" src="<?php echo $urll.$img->photo1; ?>" title="<?= $img->aircraft_model ?>" width="185" height="150" alt="">
                            </a>
                            </div>
                            <div class="item">
							   <a href="<?= site_url()?>/aircraft-gallery-detail/?id=<?= $img->aircraft_model ?>">
								<img class="border_gray" src="<?php echo $urll.$img->photo2; ?>" title="<?= $img->aircraft_model ?>"  width="185" height="150" alt="">
								</a>
                             </div>
                             <div class="item">
							   <a href="<?= site_url()?>/aircraft-gallery-detail/?id=<?= $img->aircraft_model ?>">
								<img class="border_gray" src="<?php echo $urll.$img->photo3; ?>"  title="<?= $img->aircraft_model ?>" width="185" height="150" alt="">
								</a>
                             </div>
							
						<?php endforeach; ?>
				
				</div>
                <div class="customNavigation">
                 <a class="btn prev glyphicon glyphicon-backward"></a>
                 <a class="btn next glyphicon glyphicon-forward"></a>
                 </div>
                
  
							
				
               </aside>   

</div>	

<script>
$(document).ready(function() {
	var owl = $("#owl-demo");
	owl.owlCarousel();  // Custom Navigation Events8.  
	$(".next").click(function(){   
	owl.trigger('owl.next'); })
	 $(".prev").click(function(){   
	owl.trigger('owl.prev');
	 })
	});


$(document).ready(function() {
	var owl = $("#owl-demo2");
	owl.owlCarousel();  // Custom Navigation Events8.  
	$(".next1").click(function(){   
	owl.trigger('owl.next'); })
	 $(".prev1").click(function(){   
	owl.trigger('owl.prev');
	 })
	});
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
function city(name)
{
	
	//initMap(name);
	
	
	
}
 $("#country_map").change(function(){
            var geocoder =  new google.maps.Geocoder();
			var address=document.getElementById('country_map').value;
			var lat=0;
			var lon=0;
			//alert(address);
    geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
           // alert("location : " + results[0].geometry.location.lat() + " " +results[0].geometry.location.lng()); 
		   lata=results[0].geometry.location.lat();
		   lona=results[0].geometry.location.lng();
          } else {
            alert("Something got wrong " + status);
          }
		  
      
        });
		
		//  alert (lata+' '+lona);
		var uluru = {lat: lata, lng: lona};
        
var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
		
		 var location = new google.maps.LatLng(lata, lona);
        marker.setPosition(location);
        map.setCenter(location); 
});

</script>


