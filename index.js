
$(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
		$(this).toggleClass('active');
	});




	$.ajax({
		type: 'post',
		url: 'process_crud_requests.php',
		data: {id : $('#country').val(),identifier : 'ajax-city'},
		success: function(data) {


			var obj = $.parseJSON(data);

			for (var i = 0; i < obj.length; i++) {
				var id = obj[i]['id'];
				var name = obj[i]['name'];
				$("#city").append(`<option value='${id}'>${name}</li>`);
			}


			
		},
		error: function() {

			
		}

	});

	$('#empTable').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': {
			'url':'ajaxfile.php'
		},
		'columns': [
		{ data: 'full_name' },
		{ data: 'image' },
		{ data: 'gender' },
		{ data: 'city' },
		{ data: 'nationality' },
		{data: "id" , render : function ( data, type, row, meta ) {
			console.log(row); 

			return `
			<a href="edit_students.php?id=${row.id}"> 
			<button class="btn btn-sm btn-info">Edit</button>
			</a>
			
			<button data-id='${row.id}' class="btn btn-sm btn-danger delete-btn">Delete</button>
			
			`;
			
		}},
		],

	});



	$( "#datepicker-11" ).datepicker({
		showWeek:true,
		yearSuffix:"-CE",
		dateFormat: 'yy-mm-dd',
		showAnim: "slide"
	});


	window.onbeforeunload = function () {
		window.scrollTo(0, 0);





	}






	$(document).on('change', '#country', function() {

		
		$.ajax({
			type: 'post',
			url: 'process_crud_requests.php',
			data: {id : $(this).val(),identifier : 'ajax-city'},
			success: function(data) {

				$("#city").empty();
				var obj = $.parseJSON(data);

				for (var i = 0; i < obj.length; i++) {
					var id = obj[i]['id'];
					var name = obj[i]['name'];
					$("#city").append(`<option value='${id}'>${name}</li>`);
				}


				
			},
			error: function() {

				
			}

		});
		
	});


	$(document).on('click', '.delete-btn', function() {

		if (confirm('Are you sure you want to delete the student record')) {
			$.ajax({
				type: 'post',
				url: 'process_crud_requests.php',
				data: {id : $(this).data("id"),identifier : 'ajax-delete-student'},
				success: function(data) {
					location.reload();
				},
				error: function() {

					
				}

			});
		} 
		
		
	});



});

