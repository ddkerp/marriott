jQuery(document).ready(function(){

	$('#profile').on('submit', function(e) {
		e.preventDefault();
		if($.cookie('CSRFToken') != null){
			var CSRFToken = $.cookie('CSRFToken');
		}
		var formData = new FormData(this);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/profile",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.success.msg);
				console.log(data.data.url);
				if($.cookie('CSRFToken') == null){
					$.cookie('CSRFToken',data.CSRFToken);
				}
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});
	
	$('.bride_groom_image').on('change', function(e) {
		e.preventDefault();
		if($.cookie('CSRFToken') != null){
			var CSRFToken = $.cookie('CSRFToken');
		}
		var file = this.files[0];
		if (file.size > 1024*1024) {
			alert('max upload size is 1024KB')
		}
		//alert(this.name);
		var formData = new FormData(this);
		formData.append(this.name, file);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/uploadimg",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.data.image_path);
				if($.cookie('CSRFToken') == null){
					$.cookie('CSRFToken',data.CSRFToken);
				}
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});
	$('#planurlForm').on('submit', function(e) {
		e.preventDefault();
		var CSRFToken = $.cookie('CSRFToken');
		if(CSRFToken == ""){
			alert('Token is empty');
			return false;
		}
		var formData = new FormData(this);
		//formData.append('CSRFToken', CSRFToken);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/createplanurl",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.success.msg);
				console.log(data.data.url);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});	
	
	$('#templatesForm').on('submit', function(e) {
		e.preventDefault();
		var CSRFToken = $.cookie('CSRFToken');
		if(CSRFToken == ""){
			alert('Token is empty');
			return false;
		}
		var formData = new FormData(this);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/template",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.success.msg);
				console.log(data.data.templates);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});		
	$('#header_image').on('change', function(e) {
		e.preventDefault();
		if($.cookie('CSRFToken') != null){
			var CSRFToken = $.cookie('CSRFToken');
		}
		var file = this.files[0];
		if (file.size > 1024*1024) {
			alert('max upload size is 1024KB')
		}
		//alert(this.name);
		var formData = new FormData(this);
		formData.append(this.name, file);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/headerimage",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.data.header_image);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});	
	$('#headersForm').on('submit', function(e) {
		e.preventDefault();
		var CSRFToken = $.cookie('CSRFToken');
		if(CSRFToken == ""){
			alert('Token is empty');
			return false;
		}
		var formData = new FormData(this);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/headers",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.success.msg);
				console.log(data.data.header_image);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});	
	$('#profile2Form').on('submit', function(e) {
		e.preventDefault();
		var CSRFToken = $.cookie('CSRFToken');
		if(CSRFToken == ""){
			alert('Token is empty');
			return false;
		}
		var formData = new FormData(this);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/bridegroom",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.success.msg);
				console.log(data.data.header_image);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});		
	
	$('.guest_image').on('change', function(e) {
		e.preventDefault();
		if($.cookie('CSRFToken') != null){
			var CSRFToken = $.cookie('CSRFToken');
		}
		var file = this.files[0];
		if (file.size > 1024*1024) {
			alert('max upload size is 1024KB')
		}
		//alert(this.name);
		var formData = new FormData(this);
		formData.append(this.name, file);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/guestimage",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.data.header_image);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});	
	$('.guestForm').on('submit', function(e) {
		e.preventDefault();
		var CSRFToken = $.cookie('CSRFToken');
		if(CSRFToken == ""){
			alert('Token is empty');
			return false;
		}
		var formData = new FormData(this);
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api2/bridegroom",
			type: "POST",
			data:  formData,
			headers: {"CSRFToken":CSRFToken},
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.success.msg);
				console.log(data.data.header_image);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});			
	
	
	
	
	
	
	
	
	
	
	
	
	$('#uploadimg').on('submit', function(e) {
		e.preventDefault();
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api/uploadimg",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
			   
			}           
	   });
	});
	
	$('#formCreatepage').on('submit', function(e) {
		e.preventDefault();
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api/createplanurl",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.status);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});
	
	var files = $('#formGallery :input');
	$(files).on('change', function() {
		var file = this.files[0];
		alert(file.size);
		if (file.size > 1024) {
			alert('max upload size is 1k')
		}
		var myFormData = new FormData();
		myFormData.append('pictureFile', file);

		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api/uploadgallimg",
			type: "POST",
			data:  myFormData,
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
			   $("#formGallery").append("<img width='150' src='api/"+data.data.image_path+"'/>");
			}           
	   });
	});
	$('#formGallery').on('submit', function(e) {
		e.preventDefault();
		jQuery.ajax({
			url: "http://localhost:8080/test/ajax/api/createplanurl",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data.status);
			},
			error: function(e, xhr){
				var error = jQuery.parseJSON (e.responseText);
				console.log(error.errors.message);
			}			
	   });
	});
	

	

			
});
