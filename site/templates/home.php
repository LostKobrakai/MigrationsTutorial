<?php ob_start(); ?>
	<div id="fh5co-page">
		<nav id="fh5co-nav" role="navigation">
			<ul>
				<li class="animate-box fh5co-active"><a href="index.html" class="transition">Home</a></li>
				<li class="animate-box"><a href="about.html" class="transition">Bio</a></li>
			</ul>
			<a class="style-toggle js-style-toggle" data-style="default" href="#">
				<span class="fh5co-circle"></span>
			</a>
		</nav>
		
		<header id="fh5co-header" role="banner" class="fh5co-project js-fh5co-waypoint no-border" data-colorbg="#222222" data-next="yes">
			<div class="container">
				<div class="fh5co-text-wrap animate-box">
					<div class="fh5co-intro-text">
						<h1>I&acute;m a 30 Year Old UI/UX Web Designer based <span>in</span> New York City</h1>
						<h2>Crafted by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a></h2>
					</div>
				</div>
			</div>
			<div class="btn-next animate-box fh5co-learn-more">
				<a href="#" class="scroll-btn">
					<span>See my portfolio</span>
					<i class="icon-chevron-down"></i>
				</a>
			</div>
		</header>
		<!-- data-colorbg="#8cc53e"  -->
		<?php foreach($pages->find("template=project, sort=-created, limit=5") as $key => $project) : ?>
		<div class="fh5co-project js-fh5co-waypoint <?php echo $key % 2 == 0 ? '' : 'fh5co-reverse'?>" data-bgcolor="" data-next="yes">
			<div class="container">
				<div class="fh5co-project-inner row">
					<div class="fh5co-imgs col-md-8 animate-box">
						<div class="img-holder-1 animate-box">
							<img src="images/work_1_large.jpg" alt="Free HTML5 Bootstrap Template">
						</div>
						<div class="img-holder-2 animate-box">
							<img src="images/work_1_small.jpg" alt="Free HTML5 Bootstrap Template">
						</div>
					</div>
					<div class="fh5co-text col-md-4 animate-box">
						<h2><?php echo $project->title; ?></h2>
						<p><?php echo $project->summary; ?></p>
						<p><a href="<?php echo $project->url; ?>" class="btn btn-light btn-outline transition">View Project</a></p>
					</div>
				</div>

			</div>
		</div>
		<?php endforeach; ?>
<?php
$content = ob_get_clean();
