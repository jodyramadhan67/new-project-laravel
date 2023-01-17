@extends('layouts.admin')
@section('header','Transaction')

@section('css')
<!-- DataTables -->
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
                            <a href="{{ url('transactions/create') }}" class="btn btn-sm btn-primary pull-right">Create New Transaction</a>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="status">
                                <option value="0">Status</option>
                                <option value="1">Sudah Dibeli</option>
                                <option value="2">Belum Dibeli</option>  
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="changeFilter form-control" name="dateSearch">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th class="text-center">Date Start</th>
                                <th class="text-center">Date End</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Watch Total</th>
                                <th class="text-center">Price</th>
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
@endsection

@section('js')
<!-- DataTables  & Plugins -->
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
<script type="text/javascript">
        var actionUrl = '{{ url('transactions') }}';
        var apiUrl = '{{ url('api/transactions') }}';
        var columns = [
                {data: 'DT_RowIndex', class: 'text-center', orderable: true},
                {data: 'date_start', class: 'text-center', orderable: true},
                {data: 'date_end', class: 'text-center', orderable: true},
                {data: 'members.name', class: 'text-center', orderable: true},
                {data: 'watch_total', class: 'text-center', orderable: true},
                {data: 'total_bayar', class: 'text-center', orderable: true},
                {render: function (index, row, data, meta) {
                        return data.status == 2 ? 'Belum Dibeli' : 'Sudah Dibeli'
                }, class: 'text-center', orderable: false },
                {data: 'action', class: 'text-center', orderable: false},
        ];
        var controller = new Vue({
                el: "#controller",
                data: {
                    datas: [],
                    data: {},
                    actionUrl,
                    apiUrl
                },
                mounted: function() {
                    this.datatable();
                },
                methods: {
                    datatable() {
                        const _this = this;
                        _this.table = $('#datatable').DataTable({
                                ajax: {
                                        url: _this.apiUrl,
                                        type: 'GET',
                                },
                                columns: columns,
                                searching: false,
                                autoWidth: false                                          
                        }).on('xhr', function () {
                            _this.datas = _this.table.ajax.json().data;
                        })
                },          
            }
        });
</script>
<script type="text/javascript">
    //filter status
    $('select[name=status]').on('change', function() {
            status = $('select[name=status]').val();
            if (status == 0) {
                controller.table.ajax.url(apiUrl).load();
            } else {
                controller.table.ajax.url(apiUrl + '?status=' + status).load();
            }
        });
    //filter date
    $('input[name=dateSearch]').on('change', () => {
        dateSearch = $('input[name=dateSearch]').val()
        $('select[name=status]').prop('selectedIndex', 0)
        if (dateSearch == 0)
            controller.table.ajax.url(apiUrl).load()
        else
            controller.table.ajax.url(apiUrl + '?date=' + dateSearch).load()
    })
</script>        

@endsection