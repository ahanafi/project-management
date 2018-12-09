 $(document).ready(function(){
 	/* === */
	$("input[type=search]").attr('placeholder', 'type ere');
	$("input.input-sm").attr({'placeholder':'type ere'});

	$("input[name=username]").on('keyup', function(){
		var inpUsername = $(this).val();
		//console.log(inpUsername);
		if (inpUsername.length != 0 || inpUsername != "") {
			$(".username > .text-danger").hide();
		} else {
			$(".username > .text-danger").show();
		}
	});

	$("input[name=password]").on('keyup', function(){
		var inpPassword = $(this).val();
		//console.log(inpPassword);
		if (inpPassword.length != 0 || inpPassword != "") {
			$(".password > .text-danger").hide();
		} else {
			$(".password > .text-danger").show();
		}
	});

	$("#btn-send").click(function(){
		var id_project = [];
		$("input[type=checkbox]:checked").each(function(){
			id_project.push($(this).val());
		});
		
		if (id_project.length != 0) {
			var actionUrl = base_url('project/send');
			$.ajax({
				method 	: "POST",
				url 	: actionUrl,
				data 	: {
					id : id_project
				},
				success : function(msg){
					if (msg == "success") {
						//alert('Yosh! Data berhasil dikirim!');
						$("#errProject .text-modal").text("Yosh! Data berhasil dikirim!");
						$("#errProject").modal('show');
					} else if(msg == "exists") {
						$("#errProject .text-modal").text("Oops! Data sudah dikirim sebelumnya!");
						$("#errProject").modal('show');
					} else {
						//alert('Oops! Data gagal dikirim!');
						$("#errProject .text-modal").text("Oops! Data gagal dikirim!");
						$("#errProject").modal('show');
					}
				}

			});
		} else {
			$("#errProject").modal('show');
		}
	});

	$("#btn-rvs").click(function(){
		var id_project = [];
		$("input[type=checkbox]:checked").each(function(){
			id_project.push($(this).val());
		});

		if (id_project != 0) {
			var actionUrl = base_url('project/revisi');
			$.ajax({
				method	: "POST",
				url 	: actionUrl,
				data 	: {
					id : id_project
				},
				success : function(psn){
					if (psn == "true") {
						//alert('Yosh! Data berhasil dikirim!');
						$("#errProject .text-modal").text("Yosh! Data berhasil dikirim!");
						$("#errProject").modal('show');
					} else if(psn == "exists") {
						$("#errProject .text-modal").text("Oops! Data sudah dikirim sebelumnya!");
						$("#errProject").modal('show');
					} else {
						//alert('Oops! Data gagal dikirim!');
						$("#errProject .text-modal").text("Oops! Data gagal dikirim!");
						$("#errProject").modal('show');
					}
				}
			});
		} else {
			$("#errProject").modal('show');
		}
	});

	$(".btn-upload").click(function(){
		var id = $(this).attr('data-id');
		var actionUrl = base_url('project/upload/'+id);
		$("#formUpload").modal('show');
		//$("form").attr("action", "http://localhost/appman/;
		$("form").attr("action", actionUrl);
	});

	$(".btn-rmv").click(function(){
		var id = $(this).attr('data-id');
		$("#ConfirmDelete").modal('show');
		var url = base_url('project/delete/'+id);
		//$(".btn-true").attr("href", "http://localhost/appman/project/delete/"+id);
		$(".btn-true").attr("href", url);
	});
});