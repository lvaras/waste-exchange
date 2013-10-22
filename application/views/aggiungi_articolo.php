
<div class="aggiungi_post_form">
<?php echo form_open('home/inserisci_articolo'); ?>
	<!-- Nome Annuncio -->
	<div class="row">
		<label for="article_name" class="col-md-4">nome annuncio</label>
		<input type="text" id="article_name" name="article_name"  class="col-md-4"/> 
	</div>
	<div class="clear separator"></div>
	
	<!-- Citta -->
	<div class="row">
		<label for="city" class="col-md-4">città</label>
		<input type="text" id="city" name="city" class="col-md-4" /> 
	</div>
	<div class="clear separator"></div>
	
	<!-- E-mail -->
	<div class="row" style="padding-bottom: 10px;">
		<label for="email" class="col-md-4">e-mail</label>
		<input type="text" id="email" name="email" class="col-md-4" /> 
	</div>
	<div class="clear separator"></div>
	
	<!-- Telefono -->
	<div class="row" style="padding-bottom: 10px;">
		<label for="phone" class="col-md-4">phone</label>
		<input type="text" id="email" name="phone" class="col-md-4" /> 
	</div>
	<div class="clear separator"></div>
	
	<!-- Numero Civico -->
	<div class="row">
		<label for="building_number" class="col-md-4">numero civico</label>
		<input type="text" id="building_number" name="building_number" class="col-md-4" /> 
	</div>
	<div class="clear separator"></div>
	
	<!-- Indirizzo -->
	<div class="row">
		<label for="address" class="col-md-4">indirizzo</label>
		<input type="text" id="address" name="address" class="col-md-4" /> 
	</div>
	<div class="clear separator"></div>
	
	<!-- Testo articolo -->
	<div class="row" style="padding-bottom: 10px;">
		<label for="article_text" class="col-md-4">testo Articolo</label>
	</div>
	
	<textarea id="article_text" name="article_text" class="test"></textarea>
	
	<!-- Caricatore di immagini -->
	
	<input type="submit" class="publish_button col-md-12" value="Pubblica" />
	
</form>

<form method="post" class="clearfix" action="" id="upload_file"> 
      <!-- label for="title">Title</label>
      <input type="text" name="title" id="title" value="" /-->
 
      <label for="userfile">Carica immagini</label>
      <input type="file" name="da_file" id="da_file" size="20" />
      <br/>
      <input type="submit" name="submit" id="submit" />
      
      <div id="files"></div>
</form>


</div>