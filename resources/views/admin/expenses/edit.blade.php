@extends('layouts.app')

@section('htmlheader_title')
Home
@endsection


@section('header-content')

<h3> Edit Expense</h3>

@endsection




@section('main-content')

<form id="frm_update_expense" class="form" role="form" method="POST" action="{{ url('/admin/expenses/update') }}">

	{!! csrf_field() !!}
	<input type="hidden" id="id" class="form-control input-sm" name="id" value="{{$expense->id}}">


	<div class="row">

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Expense Category</label>
				<select class="form-control input-sm" name="expense_category" id="expense_category">
					<option value="">Please Select</option>
					@foreach ($categories as $item)
						<option {{($expense->category_id == $item->id ? 'selected' : '')}} value="{{$item->id}}">{{$item->name}}</option>	
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Category Amount</label>
				<input type="number" id="amount" value={{$expense->amount}} class="form-control input-sm" name="amount" >
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Expense Date</label>
				<input type="text" id="expense_date" value="{{$expense->generated_at}}" class="timepicker form-control input-sm" name="expense_date" >
			</div>
		</div>


		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea id="description" class="form-control input-sm" name="description">{{$expense->description}}</textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Comment</label>
				<textarea id="comment" class="form-control input-sm" name="comment">{{$expense->comment}}</textarea>
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
				window.location = '/admin/expenses/get-expense';
			});

			$("#frm_update_expense").validate({
				submitHandler: function() {
					event.preventDefault();
					$('#frm_update_expense').ajaxSubmit(function(response) {

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
								window.location = '/admin/expenses/get-expense';
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