@extends('admin.layout.master')
@section('title-page')
	Quản Lý Các Trình Độ Thi
@endsection
@section('content-page')
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Danh sách tất cả các trình độ thi
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
                        <a class="m-nav__link" href="{{route('levels.index')}}">
                            <span class="m-nav__link-text">
                                Danh sách các trình độ thi
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
                            Tất cả các trình độ thi
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                            <a class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air" href="{{route('levels.create')}}">
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
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="levels" style="width:100%">
                    <thead>
                        <tr>
                            <th>
                                ID trình độ
                            </th>
                            <th>
                                Tên trình độ
                            </th>
                            <th>
                                Mô tả ngắn
                            </th>
                            <th>
                                Tùy chọn
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($levels as $level)
                            <tr>
                                <td>
                                    {{$level -> id}}
                                </td>
                                <td>
                                    <span style="text-transform: uppercase;">
                                        {{$level -> level_name}}
                                    </span>
                                </td>
                                <td>
                                    {{$level -> description}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <span aria-expanded="false" aria-haspopup="true" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton">
                                            <i class="flaticon-folder">
                                            </i>
                                        </span>
                                        <div aria-labelledby="dropdownMenuButton" class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -125px, 0px);" x-placement="top-start">
                                            <a class="dropdown-item" href="{{route('levels.edit',$level->id)}}">
                                                <i class="la la-edit text-success">
                                                </i>
                                                Chỉnh sửa thông tin
                                            </a>
                                            <a class="btn-remove dropdown-item" href="javascript:;" linkurl="{{route('levels.delete',$level->id)}}">
                                                <i class="la la-trash text-danger">
                                                </i>
                                                Xóa
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
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
<script>
    $('.btn-remove').on('click', function(){
        var removeUrl = $(this).attr('linkurl');
        swal({
            title: 'Bạn có chắc chắn muốn xóa trình độ này không?',
            text: "Khi xóa trình độ, tất cả dữ liệu liên quan đến học viên cũng bị xóa! Sau khi xóa, bạn sẽ không thể khôi phục lại dữ liệu!",
            type: 'warning',
            showCancelButton: !0,
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy',
            dangerMode: true
        }).then((result) => {
            if (result.value) {
                window.location.href = removeUrl;
            }
        });
    });
</script>
@endsection
