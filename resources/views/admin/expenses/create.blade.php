@extends('layouts.app')

@section('htmlheader_title')
Home
@endsection


@section('header-content')

<h3> Create Expenses</h3>

@endsection




@section('main-content')

<form id="frm_create_expenses" class="form" role="form" method="POST" action="{{ url('/admin/expenses/store') }}">

	{!! csrf_field() !!}
	<div class="row">

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Expense Category</label>
				<select class="form-control input-sm" name="expense_category" id="expense_category">
					<option value="">Please Select</option>
					@foreach ($categories as $item)
						<option value="{{$item->id}}">{{$item->name}}</option>	
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Category Amount</label>
				<input type="number" id="amount" class="form-control input-sm" name="amount" >
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Expense Date</label>
				<input type="text" id="expense_date" class="timepicker form-control input-sm" name="expense_date" >
			</div>
		</div>


		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea id="description" class="form-control input-sm" name="description"></textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Comment</label>
				<textarea id="comment" class="form-control input-sm" name="comment"></textarea>
			</div>
		</div>




		<div class="col-md-12">
			<button type="submit" class="btn btn-primary float-right"><i class="fa fa-btn fa-save"></i> CREATE</button>
			<button type="button" id="btn-cancel" class="btn btn-default float-right"><i class="fa fa-btn fa-close"></i>CANCEL</button>
		</div>
	</div>

</form>

@endsection

@section('custom-scripts')
<script>
	$(document).ready(function()
	{
		$('.timepicker').datetimepicker({}); 

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
			window.location = '/admin/expenses/get-expense';
		});

		$("#frm_create_expenses").validate({
			submitHandler: function() {
				event.preventDefault();
				$('#frm_create_expenses').ajaxSubmit(function(response) {

					if(response == true)
					{
						swal.fire({
						title: 'Success',
						text: 'The record successfully created',
						type: 'success',
						showCancelButton: false,
						confirmButtonText: 'Ok',
						closeOnConfirm: true
						}).then( function()
						{
							window.location = '/admin/expenses/get-expense';
						});

						
					}

					else
					{
						swal.fire({
						title: 'Error',
						text: 'The record is not created',
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
				amount: 'required',
				expense_date: 'required',
				expense_category: 'required',
				description: 'required',
				comment: 'required'
			},
			messages: {
				amount: 'Please verify Amount',
				expense_date: 'Please verify date',
				expense_category: 'Please verify category',
				description: 'Please verify description',
				comment: 'Please verify comment'
			}
		});

	});
</script>
@endsection