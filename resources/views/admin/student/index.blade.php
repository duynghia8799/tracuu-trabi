@extends('admin.layout.master')
@section('title-page')
	Quản Lý Học Viên
@endsection
@section('content-page')
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Danh sách tất cả các học viên
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a class="m-nav__link m-nav__link--icon" href="{{route('dashboard')}}">
                            <i class="m-nav__link-icon la la-home">
                            </i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a class="m-nav__link" href="{{route('students.index')}}">
                            <span class="m-nav__link-text">
                                Danh sách các học viên
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="flaticon-list-2">
                            </i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Tất cả học viên
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label for="searchByLevel">
                                            Trình độ:
                                        </label>
                                        <select class="form-control m-input m-input--solid" name="searchByLevel" id="searchByLevel">
                                        	<option value="">
                                                All
                                            </option>
											@foreach ($levels as $level)
                                            <option value="{{$level->id}}">
                                                {{$level->level_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" href="{{route('students.create')}}">
                                <span>
                                    <i class="flaticon-add">
                                    </i>
                                    <span>
                                        Thêm mới
                                    </span>
                                </span>
                            </a>
                            <div class="m-separator m-separator--dashed d-xl-none">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row align-items-center">
                        <div class="row">
                            <div class="col-xl-12">
                                <form action="{{route('students.import')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label>Import File Excel</label>
                                    <input type="file" name="import_excel" id="import_excel">
                                    <p class="text-danger">
                                        <!-- Vui lòng chỉ chọn file excel -->
                                    </p>
                                    <button class="btn btn-primary" type="submit">
                                        Upload
                                    </button>
                                    @if ($errors->has('import_excel'))
                                        <p class="text-danger">
                                            {{ $errors->first('import_excel') }}
                                        </p>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="students" style="width:100%">
                    <thead>
                        <tr>
                            <!-- <th>
                                STT
                            </th> -->
                            <th>
                                Họ và tên
                            </th>
                            <th>
                                CMND/Hộ chiếu
                            </th>
                            <th>
                                Ngày sinh
                            </th>
                            <th>
                                Số điện thoại
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Tùy chọn
                            </th>
                        </tr>
                    </thead>
                    
                </table>
                <!--end: Datatable -->
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- end:: Body -->
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.js"></script>
<script>
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	$(document).ready(function(){

		var dataTable = $('#students').DataTable({
		    processing: true,
		    serverSide: true,
		    language: {
		        processing: "<div id='loader'><h4>ĐANG TẢI...</h4></div>"
		    },
		    
		    ajax: {
		        url:'{{route('students.datatables')}}',
		        type: 'GET',
		        data: function (e) {
	          		e.searchByLevel = $('#searchByLevel').val();
	          	}
		    },
		    columns: [
		    	{ data: 'name', name: 'name' },
	        	{ data: 'student_code', name: 'student_code' },
	        	{ data: 'birthday', name: 'birthday' },
	        	{ data: 'phone', name: 'phone' },
	        	{ data: 'email', name: 'email' },
	        	{ data: 'action', name: 'action' }
		    ],

		    drawCallback: function( settings ) {
		        $('#students tbody #deleteStudent').on('click', function () {
			    	var removeUrl = $(this).attr('linkurl');
			        swal({
			            title: 'Nếu bạn xóa, tất cả các dữ liệu liên quan đến điểm số của học viên này trong tất cả các lần thi cũng sẽ bị xóa, bạn có chắc chắn muốn xóa không?',
			            text: "Sau khi xóa bạn sẽ không thể khôi phục lại dữ liệu",
			            type: 'warning',
			            showCancelButton: !0,
			            cancelButtonColor: '#dc3545',
			            confirmButtonText: 'Đồng ý',
			            cancelButtonText: 'Hủy',
			            dangerMode: true
			        }).then((willDelete) => {
			            if (willDelete.value) {

							$.ajax({
	                            url: removeUrl,
	                            type: "POST",
	                            dataType: "JSON",
	                            success: function(resp){
			                        console.log(resp);
			                        setTimeout(function() {
			                        	$('#students').DataTable().ajax.reload();
			                        	swal('Xóa thành công!','','success');
			                        },2000);
			                    }

	                        })

			            }
			        });
			    });
		    }

		});
		$('#searchByLevel').change(function(){
		    dataTable.draw(true);
		});

	});
</script>
@endsection