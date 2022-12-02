@extends('layouts.admin')
@section('header', 'Phone')

@section('content')
<div class="row">   
    	<div class="col-md-6">
        	<div class="card card-primary">
        		<div class="card-header">
            		<h3 class="card-title">Add New Phone</h3>
        		</div>
        
        		<form action="{{ url('phones') }}" method="post">
        			@csrf
            		<div class="card-body">
                  		<div class="form-group">
                    		<label>Brand</label>
                            <input type="text" name="brand" class="form-control" placeholder="Enter brand" required="">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" placeholder="Enter type" required="">
                            <label>Imei</label>
                            <input type="text" name="imei" class="form-control" placeholder="Enter imei" required="">
                            <label>Spec</label>
                            <input type="text" name="spec" class="form-control" placeholder="Enter spec" required="">                
                  		</div>
            		</div>
       
            		<div class="card-footer">
                		<button type="submit" class="btn btn-primary">Submit</button>
            	</div>
        	</form>
    	</div>
	</div>
</div>
@endsection