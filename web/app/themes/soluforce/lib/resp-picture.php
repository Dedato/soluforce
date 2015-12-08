<?php

//namespace Dedato\SoluForce\RespPicture;

/*
 * Create responsive <picture> element according to given image sizes and breakpoints, with lazyload option
 * Available arameters:
 *
 * 1) $pic_nr: for loops, used in carousels for lazyloading slides except first. default: 0
 * 2) $pic_classes: add extra classes in an array to the <picture> element. default: null
 * 3) $lazy: should the image be lazyloaded, true or false. default: false
 * 4) $img_sizes: the image sizes and their corresponding breakpoints in an array. default: null
 * 5) $img_fb: the fallback image. default: null
 * 6) $img_alt: The alternative text for the image. default: null
 *
**/

function create_resp_picture($pic_nr = 0, $pic_classes = [], $lazy = false, $img_sizes = [], $img_fb = "", $img_alt = "") {
  ob_start(); ?>
  <picture class="img-<?php echo $pic_nr; if ($pic_classes) echo ' ' . implode(' ', $pic_classes); ?>">
		<!--[if IE 9]><video style="display: none;"><![endif]-->
		<?php 
    // Loop through all the image sizes with their matched breakpoints
    foreach( $img_sizes as $img_size ): 
  		$srcset     = $img_size[0];
  		$srcset_2x  = $img_size[1];
  		// Set breakpoint to null if there is none
  		if (isset($img_size[2])) {
    		$breakpoint = $img_size[2];
    	} else {
      	$breakpoint = null;
    	} ?>
  		<source <?php 
  	  if ($lazy && !$pic_nr == 0) {
  		  echo 'data-srcset="'; 
  		} else { 
  			echo 'srcset="'; 
  	  } 
      echo $srcset .' 1x';
      if ($srcset_2x) { 
        echo ', '. $srcset_2x .' 2x"'; 
      } else {
        echo '"';
      } 
      if ($lazy && !$pic_nr == 0) {
        echo ' srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="';
      }      
      if ($breakpoint) echo ' media="(min-width:'. ($breakpoint + 1) .'px)"'; ?> /> 
    <?php endforeach; ?>
		<!--[if IE 9]></video><![endif]-->
		<!--[if gte IE 9]><!-->
		  <img<?php if ($lazy && !$pic_nr == 0) echo ' class="lazyload"'; ?> src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php echo $img_alt; ?>" />
		<!--<![endif]-->
		<?php if ($img_fb) echo '<!--[if lt IE 9]><img src="'. $img_fb .'" alt="'. $img_alt .'" /><![endif]-->'; ?>
	</picture>
  <?php return ob_get_clean();
}


function create_resp_picture_test($pic_nr = 0, $pic_classes = [], $lazy = false, $img_sizes = [], $img_fb = "", $img_alt = "") {
  ob_start(); ?>
  <picture class="img-<?php echo $pic_nr; if ($pic_classes) echo ' ' . implode(' ', $pic_classes); ?>">
		<!--[if IE 9]><video style="display: none;"><![endif]-->
		<?php 
    // Loop through all the image sizes with their matched breakpoints
    foreach( $img_sizes as $img_size ):      
  		$srcset     = $img_size['src1x'];
  		$srcset_2x  = $img_size['src2x'];
  		// Set breakpoint to null if there is none
  		if (isset($img_size['breakpoint'])) {
    		$breakpoint = $img_size['breakpoint'];
    	} else {
      	$breakpoint = null;
    	} ?>
  		<source <?php 
  	  if ($lazy && !$pic_nr == 0) {
  		  echo 'data-srcset="'; 
  		} else { 
  			echo 'srcset="'; 
  	  } 
      echo $srcset .' 1x';
      if ($srcset_2x) { 
        echo ', '. $srcset_2x .' 2x"'; 
      } else {
        echo '"';
      } 
      if ($lazy && !$pic_nr == 0) {
        echo ' srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="';
      }      
      if ($breakpoint) echo ' media="(min-width:'. ($breakpoint + 1) .'px)"'; ?> /> 
    <?php endforeach; ?>
		<!--[if IE 9]></video><![endif]-->
		<!--[if gte IE 9]><!-->
		  <img<?php if ($lazy && !$pic_nr == 0) echo ' class="lazyload"'; ?> src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php echo $img_alt; ?>" />
		<!--<![endif]-->
		<?php if ($img_fb) echo '<!--[if lt IE 9]><img src="'. $img_fb .'" alt="'. $img_alt .'" /><![endif]-->'; ?>
	</picture>
  <?php return ob_get_clean();
}