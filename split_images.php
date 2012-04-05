<?php

function friendly_split_image( $jpeg_path = false, $width = 100, $height = 100 )
{

	if( $jpeg_path === false )
		return false;
		
	$source 					= @imagecreatefromjpeg( $jpeg_path );
	$source_width 		= imagesx( $source );
	$source_height 		= imagesy( $source );
	
	$upload_dir = wp_upload_dir();
	$upload_path = $upload_dir['path'];
	
	$img_parts = array();
	
	for( $col = 0; $col < $source_width / $width; $col++)
	{
		
		for( $row = 0; $row < $source_height / $height; $row++)
		{
			
			$fn = sprintf( "img%02d_%02d.jpg", $col, $row );
			
			$col_class = $col +1;
			$row_class = $row + 1;
			
			//echo '<img src="'.$fn.'" alt="" class="img-col-'.$col_class.' img-row-'.$row_class.'" />'; 
			array_push($img_parts, $fn);
			
			$im = @imagecreatetruecolor( $width, $height );
			imagecopyresized( $im, $source, 0, 0, $col * $width, $row * $height, $width, $height, $width, $height );
			imagejpeg( $im, $fn );
			imagedestroy( $im );
			
		}
			
	}
	
	return $img_parts;

}/* friendly_split_image() */

$image_bits = friendly_split_image( "image/dummy.jpg", 160, 160 );

//var_dump($image_bits);

echo "<img src='".$image_bits[0]."' alt='' />";
echo "<img src='".$image_bits[4]."' alt='' />";
echo "<img src='".$image_bits[8]."' alt='' />";
echo "<img src='".$image_bits[12]."' alt='' />";

echo "<img src='".$image_bits[1]."' alt='' />";
echo "<img src='".$image_bits[5]."' alt='' />";
echo "<img src='".$image_bits[9]."' alt='' />";
echo "<img src='".$image_bits[13]."' alt='' />";

echo "<img src='".$image_bits[2]."' alt='' />";
echo "<img src='".$image_bits[6]."' alt='' />";
echo "<img src='".$image_bits[10]."' alt='' />";
echo "<img src='".$image_bits[14]."' alt='' />";

echo "<img src='".$image_bits[3]."' alt='' />";
echo "<img src='".$image_bits[7]."' alt='' />";
echo "<img src='".$image_bits[11]."' alt='' />";
echo "<img src='".$image_bits[15]."' alt='' />";

?>