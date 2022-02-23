<?php
/**
 * The default template for displaying content of ACF Flexible Content Fields
 *
 * Used for ACF Felxible content fiels.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage untitled_group
 * @since Untitled Group 1.0
*/

$fields = get_field_objects();
if (is_array($fields) || is_object($fields)) {
	foreach($fields as $key => $val){
		$fid = $val['ID'];
		$flex_field = $key;
		if ( isset($fid) && $fid!='')
		{
			$sections = array();
			$mydata = get_post_field('post_content',$fid);
			$mydata = unserialize($mydata);
			$newdata = $val['layouts'];
			if (is_array($newdata) || is_object($newdata)) {
				foreach($newdata as $l){
					array_push($sections,$l['name']);
				}
			}
			if ( have_rows( $flex_field ) ) : 
				while ( have_rows( $flex_field ) ) : the_row(); 
					if ( in_array(get_row_layout(),$sections) ) : 
						$filename = get_template_directory()."/template-parts/sections/".get_row_layout().".php";
						if(!file_exists($filename)):
							$myfile = fopen( get_template_directory()."/template-parts/sections/".get_row_layout().".php", "w") or die("Unable to open file!");
							$txt = '<section id="'.get_row_layout().'" style="text-align:center;">Add HTML code Here</section>';
							fwrite($myfile, $txt);
							fclose($myfile);
						endif;								
						get_template_part("/template-parts/sections/".get_row_layout());
					endif;
				endwhile;
			else: 
				get_template_part( 'content', 'none' );
			endif;
		}else{
			get_template_part( 'content', 'none' );
		}
	}
}
?>
