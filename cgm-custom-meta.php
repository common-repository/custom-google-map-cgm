<?php
function cgm_features_func() {
	add_meta_box('cgm_features','Custom Google Map (CGM) Features','cgm_features','cgm_custom_map','normal','high');
}
add_action('admin_init','cgm_features_func');

function cgm_features() {
	global $post;
	$custom = get_post_custom($post->ID);
	$cgm_width = $custom["cgm_width"][0];
	$cgm_height = $custom["cgm_height"][0];
	$cgm_maptype = $custom["cgm_maptype"][0];
	$cgm_lat = $custom["cgm_lat"][0];
	$cgm_lon = $custom["cgm_lon"][0];
	$cgm_zoom = $custom["cgm_zoom"][0];
	$cgm_class = $custom["cgm_class"][0];
	if($cgm_maptype=="ROADMAP") {
	$selectroadmap = " selected";
	} elseif($cgm_maptype=="SATELLITE") {
	$selectsate = " selected";
	} elseif($cgm_maptype=="HYBRID") {
	$selecthybr = " selected";
	} elseif($cgm_maptype=="TERRAIN") {
	$selectterr = " selected";
	}
	$writeit = '<table border="0" width="100%">';
	$writeit .= '<tr>';
	$writeit .= '<td width="300" style="font-weight:bold">'.__('Map Width','cgm').'</td>';
	$writeit .= '<td width="30" style="font-weight:bold;text-align:center">:</td>';
	$writeit .= '<td><input type="text" name="cgm_width" value="'.$cgm_width.'" placeholder="100%"></td>';
	$writeit .= '</tr>';
	$writeit .= '<tr>';
	$writeit .= '<td width="300" style="font-weight:bold">'.__('Map Height','cgm').'</td>';
	$writeit .= '<td width="30" style="font-weight:bold;text-align:center">:</td>';
	$writeit .= '<td><input type="text" name="cgm_height" value="'.$cgm_height.'" placeholder="400px"></td>';
	$writeit .= '</tr>';
	$writeit .= '<tr>';
	$writeit .= '<td width="300" style="font-weight:bold">'.__('Map Type','cgm').'</td>';
	$writeit .= '<td width="30" style="font-weight:bold;text-align:center">:</td>';
	$writeit .= '<td><select name="cgm_maptype">
	<option value="ROADMAP"'.$selectroadmap.'>'.__('Road Map','cgm').'</option>
	<option value="SATELLITE"'.$selectsate.'>'.__('Satellite','cgm').'</option>
	<option value="HYBRID"'.$selecthybr.'>'.__('Hybrid','cgm').'</option>
	<option value="TERRAIN"'.$selectterr.'>'.__('Terrain','cgm').'</option>
	</select>
	</td>';
	$writeit .= '</tr>';
	$writeit .= '<tr>';
	$writeit .= '<td width="300" style="font-weight:bold">'.__('Map Latitude','cgm').'</td>';
	$writeit .= '<td width="30" style="font-weight:bold;text-align:center">:</td>';
	$writeit .= '<td><input type="text" name="cgm_lat" value="'.$cgm_lat.'" placeholder="38.9573415"></td>';
	$writeit .= '</tr>';
	$writeit .= '<tr>';
	$writeit .= '<td width="300" style="font-weight:bold">'.__('Map Longitude','cgm').'</td>';
	$writeit .= '<td width="30" style="font-weight:bold;text-align:center">:</td>';
	$writeit .= '<td><input type="text" name="cgm_lon" value="'.$cgm_lon.'" placeholder="35.240741"></td>';
	$writeit .= '</tr>';
	$writeit .= '<tr>';
	$writeit .= '<td width="300" style="font-weight:bold">'.__('Map Zoom','cgm').'</td>';
	$writeit .= '<td width="30" style="font-weight:bold;text-align:center">:</td>';
	$writeit .= '<td><input type="text" name="cgm_zoom" value="'.$cgm_zoom.'" placeholder="15"></td>';
	$writeit .= '</tr>';
	$writeit .= '<tr>';
	$writeit .= '<td width="300" style="font-weight:bold">'.__('Map Class','cgm').'&nbsp;'.__('Optional','cgm').'</td>';
	$writeit .= '<td width="30" style="font-weight:bold;text-align:center">:</td>';
	$writeit .= '<td><input type="text" name="cgm_class" value="'.$cgm_class.'"></td>';
	$writeit .= '</tr>';
	$writeit .= '<tr>';
	$writeit .= '<td width="300" style="font-weight:bold">'.__('Map Icon','cgm').'</td>';
	$writeit .= '<td width="30" style="font-weight:bold;text-align:center">:</td>';
	$writeit .= '<td>'.__('Select 60x60 featured image for map icon.','cgm').'</td>';
	$writeit .= '</tr>';
	$writeit .= '</table>';
	echo $writeit;
	echo '<div style="height:100px"></div>';
	echo '<h3>Copy Shortcode After Publish The Post</h3>';
	echo '<div style="border:1px solid #0a8a8f;background:#d3fdff;padding:10px">
	[cgm id="'.$post->ID.'"]
	</div>
	';
}

function save_cgm() {
	global $post;
	update_post_meta($post->ID,'cgm_width',$_POST["cgm_width"]);
	update_post_meta($post->ID,'cgm_height',$_POST["cgm_height"]);
	update_post_meta($post->ID,'cgm_maptype',$_POST["cgm_maptype"]);
	update_post_meta($post->ID,'cgm_lat',$_POST["cgm_lat"]);
	update_post_meta($post->ID,'cgm_lon',$_POST["cgm_lon"]);
	update_post_meta($post->ID,'cgm_zoom',$_POST["cgm_zoom"]);
	update_post_meta($post->ID,'cgm_class',$_POST["cgm_class"]);
}
add_action("save_post","save_cgm");

add_filter( 'admin_post_thumbnail_html', 'custom_featured_image_name', 9999, 1 );

function custom_featured_image_name( $content ) {
    return str_replace( 'Set featured image', 'Set map icon 60x60', $content );
}