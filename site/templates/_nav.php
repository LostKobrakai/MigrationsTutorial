<?php 
	$links = array();
	$links[] = $pages->get('/');
?>
<nav id="fh5co-nav" role="navigation">
	<ul>
		<?php 
			foreach ($links as $link) :
				$active = $page->id == $link->id
					? 'fh5co-active'
					: ''; 
		?>
		<li class="animate-box <?php echo $active; ?>">
			<a href="<?php echo $link->url; ?>" class="transition"><?php echo $link->title; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
</nav>