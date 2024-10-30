<?php



function cgm_map_shortcode( $atts ) { 




    extract( shortcode_atts( array(

        'id' => '1',

    ), $atts ) ); 



   $showmap = get_post($id);

   $cgmid = $showmap->ID;



	$width = get_post_meta($cgmid,'cgm_width',true);

	if($width=="") {

	$width = "100%";

	}

	$height = get_post_meta($cgmid,'cgm_height',true);

	if($height=="") {

	$height = "400px";

	}



	$maptype = get_post_meta($cgmid,'cgm_maptype',true);

	if($maptype=="") {

	$maptype="ROADMAP";

	}



	$lat = get_post_meta($cgmid,'cgm_lat',true);

	$lon = get_post_meta($cgmid,'cgm_lon',true);

	$zoom = get_post_meta($cgmid,'cgm_zoom',true);



	$mapicon = wp_get_attachment_url(get_post_thumbnail_id($cgmid));

	if($mapicon=="") {

	$mapicon =  plugins_url( '/images/mappin.png', dirname(__FILE__) );

	}



	return '<script type="text/javascript">



jQuery(document).ready(function() {



	var latlng = new google.maps.LatLng('.$lat.','.$lon.');



	var options = {



		zoom: '.$zoom.',



		center: latlng,



		mapTypeId: google.maps.MapTypeId.'.$maptype.'



	};



	var map = new google.maps.Map(document.getElementById("cgm_map_div_'.$id.'"), options);







	var image = new google.maps.MarkerImage("'.$mapicon.'",



		new google.maps.Size(60, 60),



		new google.maps.Point(0,0),



		new google.maps.Point(18, 42)



	);







	// Add Marker



	var marker1 = new google.maps.Marker({



		position: new google.maps.LatLng('.$lat.','.$lon.'),



		map: map,



		icon: image



	});







	google.maps.event.addListener(marker1, "click", function() {



		infowindow1.open(map, marker1);



	});







});







</script>







<div id="cgm_map_div_'.$id.'" style="width:'.$width.';height:'.$height.';">&nbsp;</div>';






}



add_shortcode( 'cgm', 'cgm_map_shortcode' );