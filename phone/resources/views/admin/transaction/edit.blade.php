@extends('layouts.admin')
@section('header','Transaction')

@section('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@role('petugas')
@section('content')
    <div class="row justify-content-center">
       <div class="col-md-6">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Transaction</h3>
              </div>

              <form action="{{ route('transactions.update',$transaction->id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}

              <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">

<!-- Member -->
                          <div class="form-group">
                              <label>Member Name</label>
                              <select name="member_id" class="form-control">
                                  @foreach($members as $member)
                                  <option value="{{ $member->id}}" {{ $member->id == $transaction->member_id ? 'selected' : '' }}>{{ $member->name }}</option>
                                  @endforeach
                              </select>
                          </div>

<!-- Date -->
                          <div class="form-group">
                              <label>Waktu Beli</label>
                              <div>
                                  <label>Date Start</label>
                                  <input type="date" class="form-control" name="date_start" value="{{ $transaction->date_start }}">
                                  <label>Date End</label>
                                  <input type="date" class="form-control" name="date_end" value="{{ $transaction->date_end }}">
                              </div>
                          </div>

<!-- Watch -->
                          <div class="form-group">
                              <label>Watch</label>
                              <select name="watches[]" class="select2 form-control" multiple="multiple" width="50px">
                                  @foreach($watches as $watch)
                                  <option value="{{ $watch->id }}" {{ $transaction->watches()->find($watch->id) ? 'selected' : ''}}>{{ $watch->type }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                              <label>Status</label>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" value="1" {{ $transaction->status == 1 ? 'checked' : '' }}>
                                  <label class="form-check-label">Sudah dibeli</label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" value="0" {{ $transaction->status == 2 ? 'checked' : '' }}>
                                  <label class="form-check-label">Belum dibeli</label>
                              </div>
                          </div>
            

                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

                
@endsection
@endrole

@section('js')
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
</script>
@endsection