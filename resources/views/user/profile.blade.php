@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('custom-css')	

@endsection

@section('header-content')	
<h3>Edit Profile</h3>
@endsection



@section('main-content')
<div class="row">
		<!-- left column -->
		<div class="col-md-3">
		  <div class="text-center">
			<img src="/img/user2-160x160.jpg" class="avatar img-circle" alt="avatar">
			<h6>Upload a different photo...</h6>
			
			<input type="file" class="form-control">
		  </div>
		</div>
		
		<!-- edit form column -->
		<div class="col-md-9 personal-info">
		  {{-- <div class="alert alert-info alert-dismissable">
			<a class="panel-close close" data-dismiss="alert">×</a> 
			<i class="fa fa-coffee"></i>
			This is an <strong>.alert</strong>. Use this to show important messages to the user.
		  </div> --}}
		  <h3>Personal info</h3>
		  <form id="frm_create_category" class="form-horizontal"  role="form" method="POST" action="{{ url('/admin/user/update_details') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
			  <label class="col-lg-3 control-label">First name:</label>
			  <div class="col-lg-8">
			  	<input class="form-control" id="first_name" name="first_name" type="text" value="{{($user_detail ? $user_detail->first_name : ''  )}}">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Last name:</label>
			  <div class="col-lg-8">
				<input class="form-control" id="first_name" name="last_name" type="text" value="{{($user_detail ? $user_detail->last_name : ''  )}}">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-lg-3 control-label">Address:</label>
			  <div class="col-lg-8">
				<input class="form-control" id="address" name="address" type="text" value="{{($user_detail ? $user_detail->address : ''  )}}">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-lg-3 control-label">City:</label>
			  <div class="col-lg-3">
				<input class="form-control" id="city" name="city" type="text" value="{{($user_detail ? $user_detail->city : ''  )}}">
			  </div>

				<label class="col-lg-2 control-label">Zip Code:</label>
				<div class="col-lg-3">
				  <input class="form-control" id="zipcode" name="zipcode" type="text" value="{{($user_detail ? $user_detail->zipcode : ''  )}}">
				</div>
			  </div>
			<div class="form-group">
			  <label class="col-md-3 control-label">Phone No:</label>
			  <div class="col-md-8">
				<input class="form-control" id="phone_no" name="phone_no" type="text" value="{{($user_detail ? $user_detail->phone_no : ''  )}}">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-md-3 control-label">Date  Of Birth:</label>
			  <div class="col-md-8">
				<input class="form-control timepicker" id="dob" name="dob" type="text" value="{{($user_detail ? $user_detail->dob : ''  )}}">
			  </div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Salary</label>
				<div class="col-md-8">
				  <input class="form-control" id="salary" name="salary" type="text" value="{{($user_detail ? $user_detail->salary : ''  )}}">
				</div>
			  </div>

			  

			<div class="form-group">
			  <label class="col-md-3 control-label"></label>
			  <div class="col-md-8">
				<input type="submit" class="btn btn-primary" value="Save Changes">
				<span></span>
				<input type="reset" class="btn btn-default" value="Cancel">
			  </div>
			</div>
		  </form>
		</div>
	</div>
@endsection

@section('custom-scripts')	

<script type="text/javascript">

    $('.timepicker').datetimepicker({
		format: 'YYYY-mm-DD'
    }); 

</script>  
	
@endsection