<?php

function list_pages_from($dir) {
	$ignore = array(
		".","..",
		"_ss_environment.php",
		"index.php",
		".localized", ".DS_Store", "_assets", '.metadata', '.svn', '.git',
		'cache', 'favicon.ico', '.htaccess',
		'components', 'helpers', 'includes', 'tru'
	);

	if ($handle = opendir($dir)) {
		echo "<ul>";
			$fileArray = array();


			while (false !== ($file = readdir($handle))) {

				if(!in_array($file, $ignore)) {
					if(substr($file, '-4') == ".php") {
						$title = rtrim($file, 'php');
						$title = str_replace("-", " ", $title);

						$fileArray[$file] = $title;
					}
				}
			}
			ksort($fileArray);
			$odd = $i = 0;

			foreach($fileArray as $file => $title) {
				$title = str_replace('-', ' ', $title);
				$title = str_replace('_', ' ', $title);
				$class = (($i % 2) == 0) ? "class='odd'" : "class='even'";
				$i++;

				echo "<li $class><a href='$file'>$title</a></li>";
			}

			echo "</ul>";

			closedir($handle);
		}
}
?>
<!doctype html>
<html lang="en">
<head>
	<title>Templates</title>
	<meta name="viewport" content="width=device-width" />

	<style>
		html {
			background: #3b3b3b;
		}
		body {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			font-size: 62.5%;
			color: #f4f4f4;
			width: 52em;
			margin: 6em auto;
		}

		h1 {
			margin: 0;
			font-size: 3.6em;
		}

		h2 {
			margin: 0;
			font-size: 1.8em;
			font-weight: normal;
		}

		ul {
			overflow: hidden;
			margin: 0 0 2em 0;
			padding: 0;
		}

		li {
			width: 10em;
			list-style: none;
			display: block;
			float: left;
			margin: 0 .8em .8em 0;
		}
			li a {
				background: #fff;
				border-radius: .1666em;
				padding: .3333em;
				font-size: 1.2em;
				color: #0066cc;
				width: 95%;
				height: 4.1666em;
				display: block;
			}
				li a:hover,
				li a:focus {
					opacity: 0.9;
				}

		@media only screen and (max-width: 30em) {
			body {
				width: 90%;
			}

			li {
				width: 48%;
				margin-right: 0;
			}

			h3 {
				border-bottom: 1px solid #666;
				padding: 20px;
				cursor: pointer;
				font-size: 18px;
			}

			ul {
				display: none;
			}

			ul.show {
				display: block;
			}

			.odd {
				float: left;
				clear: both;
			}
			.even {
				float: right;
			}
		}
	</style>
</head>

<body>
	<h1>Otago Polytech</h1>
	<h2>HTML Templates</h2>
	<p></p>
	<?php
		list_pages_from(__DIR__ . '/');
	?>

</body>
</html>
