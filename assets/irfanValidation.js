$(document).ready(function () {
	$('#form').submit(function (e) {
		e.preventDefault();
		var a = $(this);
		a.find(':submit').attr('disabled',true);
		$.ajax({
			url:a.attr('action'),
			method:'post',
			data:a.serialize(),
			dataType:'json',
			success:function(data) {
				$('input[name=token]').val(data.token);
				if (data.error_msg) {
					a.find(':submit').attr('disabled',false);
					$.each(data.error_msg,function(key,value) {
						if(value){
							$('#'+key).parents('.form-group').addClass('has-error').find('.help-block').html(value);
						}else{
							$('#'+key).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
						}
					})
				}else if (data.false) {
					a.find(':submit').attr('disabled',false);
					$('#false').show(200).html(data.false).delay(2000).hide(200);
				}
				else if (data.redirect) {
					$('#modal-login').show(200).delay(3000).hide(200);
					$('#modal-login-message').html('Admin akan memverifikasi akun anda, harap tunggu');
					setTimeout(function() {
						location.reload();
					}, 2000);
					setTimeout(function() {
						window.location.href = base_url + data.redirect;
					}, 2000);	
				}else if(data.success || data.modalSuccessMessage){
					$('#modal-success').show(200).delay(3000).hide(200);
					$('#modal-success-message').html(data.modalSuccessMessage);
					setTimeout(function() {
						location.reload();
					}, 2000);
				}else{
					alert('kosong');
				}
			}
		})
	});

	$('#form-edit').submit(function (e) {
		e.preventDefault();
		var a = $(this);
		a.find(':submit').attr('disabled',true);
		$.ajax({
			url:a.attr('action'),
			method:'post',
			data:a.serialize(),
			dataType:'json',
			success:function(data) {
				// $(':name[csrf_test_name]').val(data.token)''
				if (data.error_msg) {
					a.find(':submit').attr('disabled',false);
					$.each(data.error_msg,function(key,value) {
						if(value){
							$('#edit-'+key).parents('.form-group').addClass('has-error').find('.help-block').html(value);
						}else{
							$('#edit-'+key).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
						}
					})
				}else if (data.false) {
					a.find(':submit').attr('disabled',false);
					$('#false').show(200).html(data.false).delay(2000).hide(200);
				}else if(data.success || data.modalSuccessMessage){
					$('#modal-success').show(200).delay(3000).hide(200);
					$('#modal-success-message').html(data.modalSuccessMessage);
					setTimeout(function() {
						location.reload();
					}, 2000);
				}else{
					alert('kosong');
				}
			}
		})
	});

	$('#form-upload').submit(function (e) {
		e.preventDefault();
		var a = $(this);
		a.find(':submit').attr('disabled',true);
		$.ajax({
			url:a.attr('action'),
			method:'post',
			data: new FormData(a[0]),
			dataType:'json',
			cache:false,
			contentType:false,
			processData:false,
			success:function(data) {
				// $(':name[csrf_test_name]').val(data.token)''
				if (data.error_msg) {
					a.find(':submit').attr('disabled',false);
					if (data.error_msg.file) {
						$('#file').parents('.form-group').addClass('has-error').find('.help-block').html(data.error_msg.file);
					}
					$.each(data.error_msg,function(key,value) {
						if(value){
							$('#edit-'+key).parents('.form-group').addClass('has-error').find('.help-block').html(value);
						}else{
							$('#edit-'+key).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
						}
					})
				}else if (data.false) {
					a.find(':submit').attr('disabled',false);
					$('#false').show(200).html(data.false).delay(2000).hide(200);
				}else if(data.success){
					setTimeout(function() {
						location.reload();
					}, 2000);
				}else if(data.modalSuccessMessage){
					$('#modal-success').show(200).delay(3000).hide(200);
					$('#modal-success-message').html(data.modalSuccessMessage);
					setTimeout(function() {
						location.reload();
					}, 2000);
				}else{
					alert('kosong');
				}
			}
		})
	});

	$('#form input').on('keyup',function() {
		$(this).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
	})

	$('#form textarea').on('keyup',function() {
		$(this).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
	})

	$('#form select').on('change',function() {
		$(this).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
	})

	$('#form-edit input').on('keyup',function() {
		$(this).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
	})

	$('#form-edit textarea').on('keyup',function() {
		$(this).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
	})

	$('#form-edit select').on('change',function() {
		$(this).parents('.form-group').removeClass('has-error').addClass('has-success').find('.help-block').html('');
	})
});