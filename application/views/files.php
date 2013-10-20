  <?php
if (isset($files) && count($files))
{
   ?>
      <ul class="images_uploaded">
         <?php
         foreach ($files as $file)
         {
            ?>
            <div class="file col-md-3">
               <a href="#" class="delete_file_link" data-file_id="<?php echo $file->id?>">Delete</a>
               <img style="width: 100%; height: auto;" src="<?= base_url("uploads/" . $file->file_name ); ?>" />
               <br />
            </div>
            <?php
         }
         ?>
      </ul>
   <?php
}
else
{
   ?>
   <p>No Files Uploaded</p>
   <?php
}
?>