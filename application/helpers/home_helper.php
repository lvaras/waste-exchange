<?php

/**
 * Retrieves first of the images binded to a post
 * @param $string (The string to limit)
 * @return Image Object ( the object containg all the image file data ) 
 */
function get_featured_image ( $post_id )
{
	// Get a reference to the controller object
	$CI = get_instance();
	$CI->load->model('files');
	$images = $CI->files->get_post_images( $post_id );
	return array_shift(array_values($images));
}

/**
 * @param: $string (The string to limit)
 * @param: $words (The number of letters)
 * @example: this func limits the number of words by a given number of characters as input, it not breaks words
 */
function limit_string_by_chars ( $string , $number_of_chars )
{
	$array_string = str_split($string);
	$array_string = array_slice( $array_string , 0 , $number_of_chars);
	for ($counter = sizeof($array_string) - 1 ; $counter >= 0 ; $counter--)
	{
		if(strcmp($array_string[$counter] , " ") == 0 )
		{
			$array_to_return = array_slice($array_string , 0, $counter);
			return implode($array_to_return);
		}
	}
}