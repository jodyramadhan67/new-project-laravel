@extends('layouts.admin')
@section('header', 'Details Transaction')

@section('css')
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: 1fr;
            margin: 20px 10px;
            gap: 20px;
        }
        .grid-form {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            padding-bottom: 10px;
            align-items: center;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-around">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Transaction</h3>
                </div>

                <form>
                    @csrf

                    <div class="grid-container">
                        <div class="grid-form">
                            <label>Member</label>
                            <div class="col-sm-12" style="background-color: rgb(194, 184, 184); border-radius: 4px;">
                                <input disabled type="text" class="form-control-plaintext"
                                    value="{{ $transaction->members->name }}">
                            </div>
                        </div>

                        <div class="grid-form">
                            <label>Date</label>
                            <div class="col-sm-12" style="background-color: rgb(194, 184, 184); border-radius: 4px;">
                                <input disabled class="form-control-plaintext"
                                    value="{{ dateFormatDays($transaction->date_start) }} - {{ dateFormatDays($transaction->date_end) }}">
                            </div>
                        </div>

                        <div class="grid-form">
                            <label>Books</label>
                            <div class="card-body table-responsive p-0" style="height:200px;">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Buku</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->books as $book)
                                            <tr>
                                                <td>{{ $book->title }}</td>
                                                <td>Rp. {{ number_format($book->price, 0, '', '.') }}</td>
                                                <td class="text-center">{{ $book->pivot->qty }}</td>
                                                <td>Rp. {{ number_format($book->price * $book->pivot->qty, 0, '', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="grid-form">
                            <label>Status</label>
                            <div class="col-sm-12" style="background-color: rgb(194, 184, 184); border-radius: 4px;">
                                <input disabled class="form-control-plaintext"
                                    value="{{ $transaction->status ? 'Sudah dikembalikan' : 'Belum dikembalikan' }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        @if ($transaction->status)
                            <a href="{{ route('transactions.index') }}" type="button" class="btn btn-default">Cancel</a>
                        @else
                            <a href="{{ route('transactions.index') }}" type="button" class="btn btn-default">Cancel</a>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" type="button"
                                class="btn btn-primary">Edit</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection