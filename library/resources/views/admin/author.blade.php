@extends('layouts.admin')
@section('header', 'Author')

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
                        <a href="#" class="btn btn-primary" @click="addData">
                            Create new Author
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Author</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form :action="actionUrl" method="POST" @submit="submitForm($event, data.id)">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name" required
                                    :value="data.name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email" required
                                    :value="data.email">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" class="form-control"
                                    placeholder="Enter phone number" required :value="data.phone_number">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter address"
                                    required :value="data.address">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    <!-- /.card -->
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

    <script type="text/javascript">
        const actionUrl = '{{ route('authors.store') }}'
        const apiUrl = '{{ route('api.authors') }}'
        const columns = [{
                data: 'DT_RowIndex',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'name',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'email',
                class: 'text-left',
                orderable: true
            },
            {
                data: 'phone_number',
                class: 'text-center',
                orderable: true
            },
            {
                data: 'address',
                class: 'text-left',
                orderable: true
            },
            {
                data: 'date',
                class: 'text-left',
                orderable: true
            },
            {
                render: (index, row, data, meta) => {
                    return `
                <a onclick="controller.editData(event, ${meta.row})" class="btn btn-warning btn-sm">Edit</a>
                <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">Delete</a>`;
                },
                orderable: false,
                class: 'text-center'
            }
        ]
    </script>

    <script src="{{ asset('js/data.js') }}"></script>

    <!-- Vue JS -->
    {{-- <script>
        const {
            createApp
        } = Vue
        createApp({
            data() {
                return {
                    author: {},
                    actionUrl: '{{ route('authors.store') }}',
                    editStatus: false
                }
            },
            mounted() {
            },
            methods: {
                addData() {
                    this.author = {}
                    this.actionUrl = '{{ route('authors.store') }}'
                    this.editStatus = false
                    $('#modal-default').modal()
                },
                editData(data) {
                    this.author = data
                    this.actionUrl = '{{ route('authors.store') }}/' + this.author.id
                    this.editStatus = true
                    $('#modal-default').modal()
                },
                deleteData(id) {
                    this.actionUrl = '{{ route('authors.store') }}/' + id
                    if (confirm("Are you sure ? ")) {
                        axios.post(this.actionUrl, {
                                _method: 'delete'
                            })
                            .then(response => {
                                location.reload()
                            });
                    }
                }
            }
        }).mount('#controller')
    </script> --}}

    <!-- JQuery DT -->
    {{-- <script">
        $(function() {
            $("#datatable").DataTable()
        });
    </script> --}}

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