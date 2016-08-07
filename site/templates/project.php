<?php ob_start(); ?>
	<div id="fh5co-page">
		<nav id="fh5co-nav" role="navigation">
			<ul>
				<li class="animate-box"><a href="index.html" class="transition">Home</a></li>
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
						<h1><?php echo $page->title_stylized; ?></h1>
					</div>
				</div>
			</div>
			<div class="btn-next animate-box fh5co-learn-more">
				<a href="#" class="scroll-btn">
					<span>See the detail</span>
					<i class="icon-chevron-down"></i>
				</a>
			</div>
		</header>

		<div class="js-fh5co-waypoint fh5co-project-detail" id="fh5co-main" data-colorbg="">
			<div class="container">


				<div class="row">
					<div class="col-md-12">
						
						<div class="row row-bottom-padded-sm animate-box">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 1</span> About Project</h3>
							</div>
							<div class="col-md-9">
								<?php echo $page->project_description; ?>
							</div>
						</div>

						<div class="row animate-box">
							<div class="col-md-12">
								<figure><img src="images/macbook.png" class="img-responsive" alt="Free HTML5 Bootstrap Template"></figure>
							</div>
						</div>


						<div class="row animate-box row-bottom-padded-sm ">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 2</span> The Process</h3>
							</div>
							<div class="col-md-9">
								<?php echo $page->project_process; ?>
							</div>
						</div>	
						

						<div class="row row-bottom-padded-sm animate-box">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 3</span> Roles</h3>
							</div>
							<div class="col-md-9">
								<?php 
									$roles = explode(',', $page->project_roles);
									$roles = array_map('trim', $roles);
									$roles = array_chunk($roles, 5);

									foreach($roles as $group) :
								?>
								<ul class="fh5co-list-style-1 fh5co-inline">
									<?php foreach ($group as $item) : ?>
									<li><?php echo $item; ?></li>
									<?php endforeach; ?>
								</ul>
								<?php endforeach; ?>
							</div>
							
						</div>

						<div class="row row-bottom-padded-sm animate-box">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 4</span> Testimony</h3>
							</div>
							<div class="col-md-9">
								
								<blockquote class="fh5co-testimony">
									<p class="fh5co-quote">&ldquo;Design is the creation of a plan or convention for the construction of an object or a system as in architectural blueprints, engineering drawings, business processes, circuit diagrams and sewing patterns.&rdquo;</p>
									<p><cite>&mdash; Ben Stellar, CEO &amp; Founder</cite></p>
								</blockquote>
							</div>
							
						</div>

						<div class="row animate-box row-bottom-padded-sm">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 5</span> Website</h3>
							</div>
							<div class="col-md-9">
								<p><a href="<?php echo $page->project_url; ?>" target="_blank"><?php echo $page->project_url; ?></a></p>
							</div>
						</div>


						<div class="row animate-box row-bottom-padded-sm">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 6</span> More Projects</h3>
							</div>
							<div class="col-md-9">
								<div class="flexslider">
								  <ul class="slides">
								    <li>
								      <a href="work_1.html" class="transition"><img src="images/work_1_large.jpg" /></a>
								    </li>
								    <li>
								      <a href="work_1.html" class="transition"><img src="images/work_2_large.jpg" /></a>
								    </li>
								    <li>
								      <a href="work_1.html" class="transition"><img src="images/work_3_large.jpg" /></a>
								    </li>
								    <li>
								      <a href="work_1.html" class="transition"><img src="images/work_4_large.jpg" /></a>
								    </li>
								  </ul>
								</div>
							</div>
						</div>


						




					</div>
				</div> 

	

			</div>
		</div>
<?php
$content = ob_get_clean();