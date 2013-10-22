<div class="row main_container">

	<h2 style="text-align: center;">Swag Swag Swag</h2>
	
	<br/>
	
	<h3>Articoli in attesa di approvazione</h3>
	
	<br/>
	<table class="table">
		<tr>
			<th>id</th>
			<th>titolo</th>
			<th>data</th>
			<th>città</th>
			<th></th>
		</tr>
		<?php foreach ($posts as $post) : ?>
			<tr>
				<td><?= $post["id"]; ?></td>
				<td><?= $post["title"]; ?></td>
				<?php 
				$newDate = date("G:i - d/m/Y", strtotime($post["post_date"]));
				?>
				<td><?= $newDate; ?></td>
				<td><?= $post["city"]; ?></td>
				<td><a href="#test-popup" class="show open-popup-link">Visualizza</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<div class="hide">
	<div id="test-popup" class="white-popup">
		<div class="positioner clearfix">
			<div class="popup_cont">
				
			</div>
			<div class="modal_confirm clearfix">
				<button class="approved">Approva</button>
				<button class="refused">Rifiuta</button>
			</div>
		</div>
	</div>
</div>
