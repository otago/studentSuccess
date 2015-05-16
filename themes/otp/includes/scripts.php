<script type='text/javascript' src='./js/thirdparty/jquery.js'></script>
<script type='text/javascript' src='./js/thirdparty/imagesloaded.js'></script>
<script type='text/javascript' src='./js/thirdparty/masonry/packery.js'></script>
<script type='text/javascript' src='./js/thirdparty/chosen/chosen.jquery.min.js'></script>
<script type='text/javascript' src='./js/thirdparty/flexslider/jquery.flexslider-min.js'></script>

<?php
	foreach(scandir(BASE . '/js/app/components/') as $file){
		if(strpos($file, '.js')){
			echo "<script type='text/javascript' src='./js/app/components/{$file}'></script>";
		}
	}
?>
<script type="text/javascript" src="./js/app/app.js"></script>