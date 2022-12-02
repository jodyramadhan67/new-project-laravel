@extends('layouts.admin')
@section('header', 'Transaction')

@section('css')
    <!-- CSS Datatable -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div id="controller">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                    Create new Transaction
                                </a>
                            </div>
                            <div class="col-md-2">
                                <select class="changeFilter form-control" name="status">
                                    <option value="0">Status</option>
                                    <option value="1">Belum</option>
                                    <option value="2">Sudah</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="changeFilter form-control" name="dateSearch">
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="card-body p-0">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Lending Period</th>
                                        <th class="text-center">Book Total</th>
                                        <th class="text-center">Total Payment</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    <script>
        const apiUrl = '{{ route('api.transactions') }}'
        const columns = [{
                data: 'DT_RowIndex',
                class: 'text-center',
                orderable: true,
            },
            {
                data: 'dateStartFormat',
                class: 'text-center',
                orderable: true,
            },
            {
                data: 'dateEndFormat',
                class: 'text-center',
                orderable: true,
            },
            {
                data: 'members.name',
                class: 'text-center',
                orderable: true,
            },
            {
                data: 'loanPeriod',
                render: (data) => {
                    return data > 1 ? data + ' Days' : data + ' Day';
                },
                class: 'text-center',
                orderable: true
            },
            {
                data: 'totalBook',
                render: (data) => {
                    return data > 1 ? data + ' Books' : data + ' Book';
                },
                class: 'text-center',
                orderable: true,
            },
            {
                data: 'totalPayment',
                render: data => {
                    return 'Rp. ' + controller.numberWithSpaces(data);
                },
                class: 'text-center',
                orderable: true,
            },
            {
                data: 'status',
                render: data => {
                    return data ? 'Sudah dikembalikan' : 'Belum dikembalikan';
                },
                class: 'text-center',
                orderable: true,
            },
            {
                data: 'urlButton',
                class: 'text-center',
                orderable: false
            }
        ]
        const {
            createApp
        } = Vue
        const controller = createApp({
            data() {
                return {
                    datas: [],
                    apiUrl
                }
            },
            mounted() {
                this.dataTables()
            },
            methods: {
                dataTables() {
                    const _this = this
                    _this.table = $('#datatable').DataTable({
                        ajax: {
                            url: this.apiUrl,
                            type: 'GET'
                        },
                        columns,
                        searching: false,
                        autoWidth: false
                    }).on('xhr', () => {
                        this.datas = _this.table.ajax.json().data
                    })
                },
                numberWithSpaces(x) {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                }
            },
        }).mount('#controller')
        // // filter date
        // $('input[name=dateSearch]').on('change', () => {
        //     dateSearch = $('input[name=dateSearch]').val()
        //     $('select[name=status]').prop('selectedIndex', 0)
        //     if (dateSearch == 0)
        //         controller.table.ajax.url(apiUrl).load()
        //     else
        //         controller.table.ajax.url(apiUrl + '?date=' + dateSearch).load()
        // })
        // // filter status
        // $('select[name=status]').on('change', () => {
        //     status = $('select[name=status]').val()
        //     $('input[name=dateSearch]').val('')
        //     if (status == 2) {
        //         controller.table.ajax.url(apiUrl).load()
        //     } else {
        //         controller.table.ajax.url(apiUrl + '?status=' + status).load()
        //     }
        // })
        // filter in the same time
        $('select[name=status], input[name=dateSearch]').on('change', () => {
            status = $('select[name=status]').val()
            dateSearch = $('input[name=dateSearch]').val()
            if (status != 0 && dateSearch != '') {
                controller.table.ajax.url(apiUrl + '?status=' + status + '&date=' + dateSearch).load()
            } else if (status != 0 && dateSearch == '') {
                controller.table.ajax.url(apiUrl + '?status=' + status).load()
            } else if (status == 0 && dateSearch != '') {
                controller.table.ajax.url(apiUrl + '?date=' + dateSearch).load()
            } else {
                controller.table.ajax.url(apiUrl).load()
            }
        })
    </script>

    <!-- CSS Scoped -->
    <style>
        .row {
            margin: 0 auto;
        }
        td a.btn {
            margin: 5px;
        }
    </style>
@endsection