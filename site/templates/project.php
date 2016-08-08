<?php ob_start(); ?>
	<div id="fh5co-page">
		<?php include __DIR__ . '/_nav.php'; ?>

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

						<?php if($page->project_images->count) : ?>
						<div class="row animate-box">
							<div class="col-md-12">
								<figure>
									<?php 
										$img = $page->project_images->get('tags=preview_macbook');
										echo "<img src='$img->url' class='img-responsive' alt='$img->description'>";
									?>
								</figure>
							</div>
						</div>
						<?php endif; ?>


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
								
								<?php list($testimony, $author) = explode("\n---\n", $page->testimony, 2); ?>
								<blockquote class="fh5co-testimony">
									<p class="fh5co-quote">&ldquo;<?php echo $testimony; ?>&rdquo;</p>
									<p><cite>&mdash; <?php echo $author; ?></cite></p>
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
								  	<?php
								  		$manual = $page->related_projects;
								  		$limit = 5 - $page->related_projects->count;
								  		$automatic = $pages->find("id!=$page->id, template=project, limit=$limit, sort=random");
								  		foreach($manual->import($automatic) as $related) :
								  			$url = $related->url;
								  			$img = $page->project_images->get('tags=screenshot_desktop');
								  	?>
								    <li>
								      <a href="<?php echo $url; ?>" class="transition">
								      	<img src="<?php echo $img->url; ?>" alt="<?php echo $img->description; ?>" />
								      </a>
								    </li>
								  	<?php endforeach; ?>
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