@extends('layouts.admin')
@section('header','Transaction')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                  <h3 class="card-title">Detail Transaction</h3>
            </div>
            <div class="card-body">
            @csrf
              <div class="grid-container">
                  <div class="grid-form">
                      <label>Name:</label>
                      <div class="col-sm-12">
                        <input disabled type="text" value="{{ $transaction->members->name }}">         
                      </div>
                  </div><br>
                  <div class="grid-form">
                      <label>Date:</label>
                      <div class="col-sm-12">
                        <input disabled value="{{ convert_date2($transaction->date_start) }} - {{ convert_date2($transaction->date_end ) }}">
                      </div>
                  </div><br>
                  <div class="grid-form">
                      <label>Watch:</label>
                      <td>
                          @foreach($transaction->watches as $watch)
                              <li>
                                {{ $watch->type }}
                              </li>
                          @endforeach
                      </td>
                  </div><br>
                  <div class="grid-form">
                      <label>Status:</label>
                      <div class="col-sm-12">
                        <input disabled class="form-control-plaintext" value="{{ $transaction->status ? 'Belum Dibeli' : 'Sudah Dibeli' }}">
                      </div>
                  </div>
              </div>
              <a href="{{ url('transactions') }}" class="btn btn-sm btn-dark pull-right float-right">Close</a>
            </div>
        </div>
    </div>
</div>
@endsection