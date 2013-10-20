<div class="row main_container">
	Questo è un testo di prova dell'header
	<?php foreach ($posts as $post) : ?>
	<div class="col-md-3 clearfix">
		<a href="<?= site_url("posts/single_post/" . $post["id"]); ?>">
			<div class="box_annuncio">
				<?php $featured_image = get_featured_image( $post["id"] ); ?>
				<img src="<?= base_url("uploads/" . $featured_image->file_name ); ?>" alt="<?= $post["title"]; ?>" title="<?= $post["title"]; ?>"/>
				<h5><?= $post["title"]; ?></h5>
				<?= date("d M Y", strtotime($post["post_date"]));?>
				<br/><br/>
				<p><?= limit_string_by_chars($post["text"] , 180); ?> [...] </p>
			</div>
		</a>
	</div>
	<?php endforeach; ?>
</div>