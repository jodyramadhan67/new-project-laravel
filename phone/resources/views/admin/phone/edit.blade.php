@extends('layouts.admin')
@section('header', 'Phone')

@section('content')
<div class="row">   
    	<div class="col-md-6">
        	<div class="card card-primary">
        		<div class="card-header">
            		<h3 class="card-title">Edit Phone</h3>
        		</div>
        
        		<form action="{{ url('phones/'.$phone->id) }}" method="post">
        			@csrf
                    {{ method_field('PUT') }}
                    
            		<div class="card-body">
                  		<div class="form-group">
                          <label>Brand</label>
                    		<input type="text" name="brand" class="form-control" placeholder="Enter brand" required="" value="{{ $phone->brand }}">
                            <label>Type</label>
                    		<input type="text" name="type" class="form-control" placeholder="Enter type" required="" value="{{ $phone->type }}"> 
                            <label>Imei</label>
                    		<input type="text" name="imei" class="form-control" placeholder="Enter imei" required="" value="{{ $phone->imei }}"> 
                            <label>Spec</label>
                    		<input type="text" name="spec" class="form-control" placeholder="Enter spec" required="" value="{{ $phone->spec }}">                
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