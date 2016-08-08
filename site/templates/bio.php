<?php ob_start(); ?>
	<div id="fh5co-page">
		<?php include __DIR__ . '/_nav.php'; ?>

		<header id="fh5co-header" role="banner" class="fh5co-project js-fh5co-waypoint no-border" data-colorbg="#222222" data-next="yes">
			<div class="container">
				<div class="fh5co-text-wrap animate-box">
					<div class="fh5co-intro-text">
						<h1><?php echo $page->title_stylized; ?></h1>
						<h2>Crafted by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a></h2>
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
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 1</span> Bio</h3>
							</div>
							<div class="col-md-9">
								<?php echo $page->project_description; ?>
							</div>
						</div>

						<div class="row row-bottom-padded-sm animate-box">
							<div class="col-md-12">
								<figure class="fh5co-bio-photo">
									<?php 
										$img = $page->image;
										echo "<img src='$img->url' class='img-responsive' alt='$img->description'>";
									?>
								</figure>
							</div>
						</div>


						<div class="row animate-box row-bottom-padded-sm">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 2</span> Experience</h3>
							</div>
							<div class="col-md-9">
								<?php echo $page->project_process; ?>
							</div>
						</div>	
						

						<div class="row animate-box row-bottom-padded-sm">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 3</span> Connect</h3>
							</div>
							<div class="col-md-9">
								<ul class="fh5co-social fh5co-stack">
									<?php 
										foreach(explode("\n", $page->social) as $social) : 
											$parts = explode('|', $social);
											list($url, $icon, $label) = array_map('trim', $parts);
									?>
									<li>
										<a href="<?php echo $url; ?>">
											<i class="icon-<?php echo $icon; ?>"></i> <?php echo $label; ?>
										</a>
									</li>
									<?php endforeach; ?>
									
								</ul>
							</div>
						</div>



						<div class="row animate-box">
							<div class="col-md-3">
								<h3 class="fh5co-section-heading"><span class="fh5co-number">N<sup>o</sup> 4</span> My Location</h3>
							</div>
							<div class="col-md-12">
								<div id="fh5co-map"></div>
							</div>
						</div>

						

					</div>
				</div>
			</div>
		</div>
<?php
$content = ob_get_clean();