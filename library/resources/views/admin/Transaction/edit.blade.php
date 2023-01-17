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
    <div id="controller">

        <div class="row justify-content-around">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Transaction</h3>
                    </div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <span>{{ session()->get('success') }}</span>
                            <span style="display: inherit">Redirect after 3 seconds...</span>
                            <a class="btn text-white" href="{{ route('transactions.show', $transaction->id) }}"
                                style="display: table-row">Go to details</a>
                        </div>

                        <script>
                            setTimeout(function() {
                                window.location.href = '{{ route('transactions.show', $transaction->id) }}'
                            }, 3000); // 3 second
                        </script>
                    @endif
                    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST"
                        onsubmit="return confirm('Update this data ?')">
                        @csrf
                        @method('PUT')

                        <div class=" modal-body">
                            <div class="form-group">
                                <label>Member</label>
                                <select name="member_id" class="form-control" required>
                                    <option :value="transaction.member_id" :selected="transaction.member_id">
                                        @{{ transaction.members.name }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Date</label>
                                <div>
                                    <label>Start</label>
                                    <input type="date" class="form-control" name="date_start" required
                                        :value="transaction.date_start">
                                    <label style="padding-top: 10px;">End</label>
                                    <input type="date" class="form-control" name="date_end" required
                                        :value="transaction.date_end">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Books</label>
                                <select class="select2" multiple="multiple" name="books[]" style="width: 100%;"
                                    required>
                                    <option v-for="(book, value) in allBooks" :value="book.id"
                                        :selected="book.id == bookId[value]">
                                        @{{ book.title }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <div class="form-check">
                                    <input type="radio" name="status" class="form-check-input" value="1"
                                        :checked="transaction.status == 1">
                                    <label class="form-check-label">Sudah dikembalikan</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="status" class="form-check-input" value="0"
                                        :checked="transaction.status == 0">
                                    <label class="form-check-label">Belum dikembalikan</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a href="{{ route('transactions.show', $transaction->id) }}" type="button"
                                class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                    transaction: {!! json_encode($transaction) !!},
                    members: {!! json_encode($members) !!},
                    books: {!! json_encode($books) !!},
                    allBooks: [],
                    bookId: {!! json_encode($bookId) !!}
                }
            },
            mounted() {
                this.getAllBooks()
            },
            methods: {
                getAllBooks() {
                    this.allData = this.transaction.books.concat(this.books)
                    this.allBooks = this.allData.reduce((unique, o) => {
                        if (!unique.some(obj => obj.id === o.id)) {
                            unique.push(o);
                        }
                        return unique;
                    }, []);
                }
            }
        }).mount('#controller')
    </script>

    <script>
        $(() => {
            $('.select2').select2()
        })
        $('input[name=status]').on('change', () => {
            let status = $('input[name=status]:checked').val()
            if (status == 1) {
                $('input[type=date]').prop('readonly', true)
                $('.select2').attr('readonly', true)
            } else {
                $('.select2').select2()
                $('input[type=date]').prop('readonly', false)
                $('.select2').attr('readonly', false)
            }
        })
    </script>

    <style>
        .dark-mode .select2-container .select2-search--inline .select2-search__field {
            color: #301515;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgb(184, 70, 70);
        }
        select[readonly].select2-hidden-accessible+.select2-container {
            pointer-events: none;
            touch-action: none;
        }
        select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
            background: #eee;
            box-shadow: none;
        }
        select[readonly].select2-hidden-accessible+.select2-container .select2-selection__arrow,
        select[readonly].select2-hidden-accessible+.select2-container .select2-selection__clear {
            display: none;
        }
    </style>
@endsection