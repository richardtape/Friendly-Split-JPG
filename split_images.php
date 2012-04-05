<?php

	/**
	 * A function which splits a jpg image into smaller pieces (kind of like a jigsaw) and uploads those images to the
	 * WordPress uploads folder.
	 *
	 * @param $jpeg_path : path to the jpg to split
	 * @param $width : width of the required output images
	 * @param @height : height of the required output images
	 *
	 * @return an array of paths to the image parts created (or false if it all goes horribly wrong)
	 *
	 * @package Friendly Split Image
	 * @author iamfriendly
	 * @version 1.0
	 * @since 1.0
	 */

	function friendly_wp_split_image( $jpeg_path = false, $width = 100, $height = 100 )
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
				
				array_push($img_parts, $fn);
				
				$im = @imagecreatetruecolor( $width, $height );
				imagecopyresized( $im, $source, 0, 0, $col * $width, $row * $height, $width, $height, $width, $height );
				imagejpeg( $im, $fn );
				imagedestroy( $im );
				
			}
				
		}
		
		return $img_parts;
	
	}/* friendly_wp_split_image() */

$image_bits = friendly_wp_split_image( "image/dummy.jpg", 160, 160 );

var_dump($image_bits);

?>