@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('custom-css')	
<style>
	.header-button
	{
		margin-bottom: 15px;
	}
</style>
@endsection

@section('header-content')	
<div >
<h3>Expenses</h3>
</div>
<div class="row">
	

</div>
@endsection



@section('main-content')
	<div class="row col-md-12">
		<div class="text-right">
			<button id="add_category" class="btn btn-success header-button" ><i class="fa fa-btn fa-add"></i> ADD EXPENSES</button>
		</div>
	</div>
	
	<table id="cateogry_grid" class="table table-bordered">
		<thead>
			<tr>
				<th>Actions</th>
				<th>Category</th>
				<th>Amount</th>
				<th>Description</th>
				<th>Created At</th>
			</tr>
		</thead>
	</table>
@endsection

@section('custom-scripts')	
	<script>

		function delete_expenses(id)
		{

				swal.fire({
				title: 'Are you sure?',
				text: 'You are going to delete this Expense!',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#dd6b55',
				cancelButtonColor: '#999',
				confirmButtonText: 'Yes!',
				cancelButtonText: 'No',
				closeOnConfirm: false
				}).then( function(isConfirm)
				{	
					console.log(isConfirm);
					if(isConfirm.value == true)
					{
						window.location='/admin/expenses/delete?id='+id;
					}
				});
					
		}

		$(document).ready(function()
		{
			$('#cateogry_grid').DataTable({
				"ajax" : '/admin/expenses/get-expense?type=json',
				'columns': [
					{
						'data': 'id',
						'sortable': false,
						'render': function(data, type, full) {
							var html = '';
							html += '<a href="/admin/expenses/edit?id='+data+'" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
							html += '<a onclick="delete_expenses('+data+')" type="button" class="btn btn-danger btn-xs dt-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
							return html;
						}
					},
					{'data': 'cat_name'},
					{'data': 'amount'},
					{'data': 'comment'},
					{'data': 'generated_at'}
				]
			})

		});

		$('#add_category').on('click', function()
		{
			window.location = '/admin/expenses/create';
		})
	</script>
@endsection