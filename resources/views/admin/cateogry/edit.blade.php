@extends('layouts.app')

@section('htmlheader_title')
Home
@endsection


@section('header-content')

<h3> Edit Category</h3>

@endsection




@section('main-content')

<form id="frm_update_category" class="form" role="form" method="POST" action="{{ url('/admin/categoery/update') }}">

	{!! csrf_field() !!}
	<input type="hidden" id="id" class="form-control input-sm" name="id" value="{{$category->id}}">


	<div class="row">

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Category Name</label>
				<input type="text" id="name" class="form-control input-sm" name="name" value="{{$category->name}}">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea id="description" class="form-control input-sm"
					name="description">{{$category->description}}</textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Comment</label>
				<textarea id="comment" class="form-control input-sm" name="comment">{{$category->comment}}</textarea>
			</div>
		</div>

	</div>



	<div class="col-md-12">
		<button type="submit" class="btn btn-primary float-right"><i class="fa fa-btn fa-save"></i>UPDATE</button>
		<button type="button" id="btn-cancel" class="btn btn-default float-right"><iclass="fa fa-btn fa-close"></i>CANCEL</button>
	</div>

</form>

@endsection

@section('custom-scripts')
<script>
	$(document).ready(function()
		{
			$.validator.setDefaults({
			ignore: '', // ignore hidden fields
			errorClass: 'validation-error-label',
			successClass: 'validation-valid-label',
			highlight: function(element, errorClass) {
				$(element).removeClass(errorClass);
			},
			unhighlight: function(element, errorClass) {
				$(element).removeClass(errorClass);
			},
			invalidHandler: function(event, validator) {
			$('#over_all_error').show();
			},
			// Different components require proper error label placement
			errorPlacement: function(error, element) {
				// Input with icons and Select2
				if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
					error.appendTo( element.parent() );
				}
				// Input group, styled file input
				else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
					error.appendTo( element.parent().parent() );
				}

				else {
					error.insertAfter(element);
				}
			},
			validClass: "validation-valid-label",
			success: function(label) {
				label.remove();
			}
		});
			
			$('#btn-cancel').on('click', function()
			{
				window.location = '/admin/categoery/get-category';
			});

			$("#frm_update_category").validate({
				submitHandler: function() {
					event.preventDefault();
					$('#frm_update_category').ajaxSubmit(function(response) {

						if(response == true)
						{
							swal.fire({
							title: 'Success',
							text: 'The record successfully updated',
							type: 'success',
							showCancelButton: false,
							confirmButtonText: 'Ok',
							closeOnConfirm: true
							}).then( function()
							{
								window.location = '/admin/categoery/get-category';
							});
						}

						else
						{
							swal.fire({
							title: 'Error',
							text: 'The record is not updated',
							type: 'warning',
							showCancelButton: false,
							confirmButtonText: 'Ok',
							closeOnConfirm: true
							}, function() {
							
							});
						}
						
					});
				},
				rules: {
					name: 'required'  
				},
				messages: {
					name: 'Please verify Name'
				}
        	});

		});
</script>
@endsection