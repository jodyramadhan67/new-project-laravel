@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css') }}">
@endsection
@section('header', 'Transaction')

@section('content')
    <div id="Tx">
        <div class="row justify-content-around">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Transaction</h3>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <span>{{ session()->get('success') }}</span>
                            <span style="display: inherit">Redirect after 3 seconds...</span>
                            <a class="btn text-white" href="{{ route('transactions.index') }}"
                                style="display: table-row">Back to transactions</a>
                        </div>

                        <script>
                            setTimeout(function() {
                                window.location.href = '{{ route('transactions.index') }}'
                            }, 3000); // 3 second
                        </script>
                    @endif
                    <form action="{{ route('transactions.store') }}" method="POST"
                        onsubmit="return confirm('Save this data ?')">
                        @csrf

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Member</label>
                                <select name="member_id" class="form-control" required>
                                    <option selected hidden>Nothing selected</option>
                                    <option v-for="member in members" :value="member.id">
                                        @{{ member.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Lending Date</label>
                                <div>
                                    <label>Start</label>
                                    <input type="date" class="form-control" name="date_start" required>
                                    <label style="padding-top: 10px;">End</label>
                                    <input type="date" class="form-control" name="date_end" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Books</label>
                                <select class="select2" multiple="multiple" name="books[]" style="width: 100%;"
                                    required>
                                    <option v-for="book in books" :value="book.id">@{{ book.title }}</option>
                                </select>
                            </div>
                            <div class="form-group" hidden>
                                <div class="form-check">
                                    <input type="number" name="status" value="0">
                                    <label class="form-check-label">Belum dikembalikan</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a href="{{ route('transactions.index') }}" type="button" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        const {
            createApp
        } = Vue
        createApp({
            data() {
                return {
                    members: {!! json_encode($members) !!},
                    books: {!! json_encode($books) !!}
                }
            },
            mounted() {},
            methods: {
                handleSubmit() {
                    return confirm('Save this data ?')
                }
            }
        }).mount('#Tx')
    </script>

    <script>
        $(() => {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgb(184, 70, 70);
        }
        .dark-mode .select2-container .select2-search--inline .select2-search__field {
            color: #301515;
        }
    </style>
@endsection