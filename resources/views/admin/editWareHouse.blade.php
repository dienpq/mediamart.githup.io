@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{asset('assets/admin/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<style >
    .table thead th,
    .table td, .table th {
        vertical-align: middle
    }
    .table th,table td {
        text-align: center;
    }
    .table.dataTable>thead .sorting:before,
    .table.dataTable>thead .sorting:after {
        bottom: 50%;
        transform: translateY(50%);
    }
    .table td:nth-last-child(2)>input {
        display: block;
        margin: auto;
    }
    .table td .btn-box {
        display: flex;
        justify-content: center;
    }
    .table td .btn-box>.btn {
        margin: 0px 0.2rem;
        padding: 0.2rem 0.5rem;
    }
    .table td .img-prd {
        width: 30px;
        height: 30px;
        overflow: hidden;
        display: block;
        margin: auto;
    }
    .table td .img-prd>img {
        width: 30px;
    }

</style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Kho</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="" method="POST">
                                    @csrf
                                    @if (session('msg'))
                                        <div class="title-msg d-none">{{session('msg')}}</div>
                                        <div class="icon-msg d-none">success</div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="title-msg d-none">Vui lòng kiểm tra lại giữ liệu</div>
                                        <div class="icon-msg d-none">error</div>
                                    @endif
                                    <div class="row">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary mb-2">Cập nhật</button>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <input type="text" id="inputName" class="form-control" name="warehouse_name" value="{{old('warehouse_name') ?? $warehouseDetail->name}}" placeholder="Tên kho">
                                                @error('warehouse_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" id="inputName" class="form-control" name="warehouse_address" value="{{old('warehouse_address') ?? $warehouseDetail->address}}" placeholder="Địa chỉ">
                                            @error('warehouse_name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <a href="{{route("admin.warehouse.importWarehouse",['id'=>$warehouseDetail->id])}}" class="btn btn-outline-success">Nhập kho</a>
                                                <a href="{{route("admin.warehouse.exportWarehouse",['id'=>$warehouseDetail->id])}}" class="btn btn-outline-danger ml-1">Xuất kho</a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end">
                                                <a href="{{route("admin.warehouse.statisticalImportWarehouse",['id'=>$warehouseDetail->id, 'date'=>date('d-m-Y')])}}" class="btn btn-outline-primary">Thống kế nhập kho</a>
                                                <a href="{{route("admin.warehouse.statisticalExportWarehouse",['id'=>$warehouseDetail->id, 'date'=>date('d-m-Y')])}}" class="btn btn-outline-warning ml-1">Thống kê xuất kho</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Giá(VNĐ)</th>
                                            <th>Số lượng</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($products[0]))
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$product->code}}</td>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{$product->price}}</td>
                                                    <td>{{$product->amount}}</td>
                                                    <td>
                                                        <div class="btn-box">
                                                            <a href="{{route('admin.warehouse.deleteProductWarehouse',['id'=>$product->id])}}"
                                                            onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">Không có sản phẩm nào</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('js')
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/admin/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "order":[[1,'asc']],
        "columnDefs": [
            {"targets": [0,5], "orderable": false},
            { "visible": true, "targets": 0 }
        ],
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
