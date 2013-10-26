<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dev.el - The simple vagrant setup for PHP developers</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Asap:400,400italic|Kavoon' rel='stylesheet' type='text/css'>
        <style type="text/css">
        	<?php //palette
        		function c($i) {
	        		$c = array(
	        			'#3E3F41', //0. base-text (winternight)
	        			'#ECE59A', //1. clean backgrounds (clotted cream)
	        			'#848D82', //2. subtitles (tarmac)
	        			'#2C3B63', //3. title (light navy)
	        			'#250352', //4. decorations (midnight)
	        		);
        			echo $c[$i];
        		}
        	?>
        	.h { background: <?php c(2); ?> !important; }
        	.e { background: <?php c(1); ?> !important; }
        	.v { background: transparent !important; }
        	.center { text-align:center; }
        	.warning { padding: 2em; background: <?php c(1); ?>; text-align: center; font-size: 2em; }
        	p { padding: 0.3em; line-height: 125%; }
        	hr {margin: 1em auto; }
        	table td {padding: 0.5em; max-width: 300px; word-wrap: break-word;}
        	html, html *, body * { margin:0; padding:0; color: <?php c(0); ?>;}
        	body { padding: 1em 0 0 0; border-top: 8px solid <?php c(4); ?>; }
        	header, .content, footer { width:600px; margin:0 auto; font-family: 'Asap', sans-serif; }
        	header * {text-align: center}
        	header h1 { font-family: 'Kavoon', cursive; font-size:4em; color: <?php c(3); ?>; }
        	header h2.pretitle, header h2.subtitle { font-size:1.5em; color: <?php c(2); ?>; }
        	div.content { padding: 1em; }
        	.projects-box { padding:2em 0 0 0; }
        	.projects li { list-style: none ;padding: 1em 2em 1em 32px; background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAY1JREFUeNqkU7tKA0EUPbM76cTCPCQRRIm1RRLEP7DQSkGwsLGwtBWCbcTKQhALY6uVfoKdGjEGtFNICBizWqSQmNc+nTthzeZVaC4c9u7OOWfm3p3LHMfBKMEfDtjQRYVhXjzWhixf2g6euUi2BGYHMQQB8V17r67rqDabqLVa2C4GUanUkX4aUwQlwe5SSC3uXCUdy+oSM1XF58urSIBQNNpnTuuZo9V9btlQbbEDoTeCc1FpUsw+DqyBtG0D0wChr4SqgcDM9EAxneDtBqpiSgMTljBw8VEq4eL0TOZmvYbz4xNohYLMXdiiH6Y8gQVuGToIbpgi1/XON8rNHg4YA2m5aYkTGGJno1OC3z+B9c2N32+Uy5o9HMYUkJYMONXvdc9lcwhHwhIUWlmTiCVinTuiSAPODbtt4G1iKBTA/W0G5XdNvkemwkgsxLs4tmgiabnon89tohuTwmB5Zan/t3k4qspBWv7VwDhdKZ/q+9MMkIa0/LuBfPowef2fQRKzkmejTqOCEeNHgAEA/+Tdm0j14AwAAAAASUVORK5CYII=) left center no-repeat; }
        	footer { margin-top: 1em; padding: 1em; border-top: 1px dotted <?php c(2); ?>; text-align: center; }
        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <header>
        	<hgroup>
        		<h2 class="pretitle">welcome to</h2>
	        	<h1>Dev.el</h1>
	        	<h2 class="subtitle">Dev.el - The simple vagrant setup for PHP developers</h2>
        	</hgroup>
        </header>
       	<div class="content" role="main">
       		<?php if(isset($_GET['i'])): ?>
       			<div class="center"><p><a href="/">Close info</a></p></div>
       			<?php	phpinfo(); ?>
       			<div class="center"><p><a class="center" href="/">Close info</a></p></div>
       		<?php else: ?>
       			<?php 
       				$projects = array_filter(glob('*'), 'is_dir');
       			?>
       			<?php if(empty($projects)) : ?>
       				<div class="warning">
       					<p>You don't have any project!<br/>
       					Start by creating a project folder on your <em>projects</em> directory
       					</p>
       				</div>
       			<?php else: ?>
       				<div class="projects-box">
	       				<h3>Your projects</h3>
	       				<ul class="projects">
	       				<?php foreach($projects as $project): ?>
	       					<li><a href="/<?php echo $project; ?>"><?php echo $project; ?></a></li>
	       				<?php endforeach; ?>
	       				</ul>
       				</div>
       			<?php endif; ?>
       		<?php endif; ?>
       	</div>
       	<footer>
       		<p>&copy; <a href="https://github.com/lmammino">lmammino</a> 2013 | <a href="https://github.com/lmammino/dev.el">fork me on GitHub</a> | <a href="http://dev.el/phpmyadmin">phpMyAdmin</a> | <a href="/?i">phpinfo()</a></p>
       	</footer>
    </body>
</html>