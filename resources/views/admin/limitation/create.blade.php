@extends('layouts.app')

@section('htmlheader_title')
Home
@endsection


@section('header-content')

<h3> Create Expenses Limit</h3>

@endsection




@section('main-content')

<form id="frm_create_expenses" class="form" role="form" method="POST" action="{{ url('/admin/expenses/limitation/store') }}">

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
				<label class="control-label"> Amount</label>
				<input type="number" id="amount" class="form-control input-sm" name="amount" >
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">From</label>
				<input type="text" id="from" class="timepicker form-control input-sm" name="from" >
			</div>
		</div>


			<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">To</label>
				<input type="text" id="to" class="timepicker form-control input-sm" name="to" >
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

					if(response.status == true)
					{
						swal.fire({
						title: 'Success',
						text: response.msg,
						type: 'success',
						showCancelButton: false,
						confirmButtonText: 'Ok',
						closeOnConfirm: true
						}).then( function()
						{
							window.location = 'http://sms.local/admin/expenses/limitation';
						});

					}

					else
					{
						swal.fire({
						title: 'Error',
						text:response.msg,
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
				from: 'required',
				to: 'required'

			},
			messages: {
				amount: 'Please verify Amount',
				from: 'Please select the date',
				to: 'Please select the date'
			}
		});

	});
</script>
@endsection