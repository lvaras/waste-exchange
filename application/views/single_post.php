
<br/><br/>

<h2><?= $post->title; ?></h2>

<br/>

<h3><?= $post->post_date; ?></h3>

<br/>

<p><?= $post->text; ?></p>

<br/>
<br/>

<?php foreach ($images as $image) : ?>
	<img class="col-md-3" style="margin-bottom: 20px;" src="<?= base_url("uploads/" . $image->file_name ); ?>" />
<?php endforeach; ?>