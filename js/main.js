
(function ($) {

$(function () {
	
	/**
	 * 
	 * */
	$('#upload_file').submit(function(e) {
	      e.preventDefault();
	      $.ajaxFileUpload({
	         url            : da_app.site_url + "/home/upload_file", 
	         secureuri      :false,
	         fileElementId  :'userfile',
	         dataType    : 'JSON',
	         data        : {
	            'title'           : $('#title').val()
	         },
	         success  : function (data, status)
	         {
	            if(data.status != 'error')
	            {
	               $('#files').html('<p>Reloading files...</p>');
	               refresh_files();
	               $('#title').val('');
	            }
	            console.log(data.msg + "  " + data.status + " " + data);
	         }
	      });
	      return false;
	   });
	
	
	$('.delete_file_link').live("click" , function(e) {
	   
	   e.preventDefault();
	   if (confirm('Are you sure you want to delete this file?'))
	   {
	      var link = $(this);
	      $.ajax({
	         url         : da_app.site_url + '/home/delete_file/' + link.attr('data-file_id'),
	         dataType : 'JSON',
	         success     : function (data)
	         {
	            files = $("#files");
	            if (data.status === "success")
	            {
	               link.parents('div.file').fadeOut('fast', function() {
	                  $(this).remove();
	                  if (files.find('div.file').length == 0)
	                  {
	                     files.html('<p>No Files Uploaded</p>');
	                  }
	               });
	            }
	            else
	            {
	               alert(data.msg);
	            }
	         }
	      });
	   }
	});
	
	$('.open-popup-link').magnificPopup({
		  type:'inline',
		  midClick: true 
	});
	
	$('.open-popup-link').click(function () {
		var id = $(this).closest("tr").find("td").first().html();
		$.ajax({
			url:  da_app.site_url + "/posts/single_post/" + id,
			success: function (data) {
				$("#test-popup .popup_cont").html("");
				$("#test-popup .popup_cont").append( $(data).find(".main_container") );
			}
		})
		
	});
	
		   
}); // DOM ready

function refresh_files()
{
   $.get(da_app.site_url + '/home/get_session_id')
   .success(function (id){
	   console.log(id);
	   $.get(da_app.site_url + '/home/files/' + id)
	   .success(function (data){
		   console.log(data);
		   $("#files").append(data);
	   });
   });
}


})(jQuery);
