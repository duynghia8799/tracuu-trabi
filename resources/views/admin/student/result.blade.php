@extends('admin.layout.master')
@section('title-page')
    Chi tiết điểm của học viên
@endsection
@section('content-page')
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Chi tiết điểm thi
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
                                Danh sách học viên
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
                            <i class="fa fa-user-cog">
                            </i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Điểm thi của học viên: <span class="text-danger">&nbsp;{{$student->name}}</span>
                            
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                        <tr>
                            <th>
                                Môn thi
                            </th>
                            <th>
                                Điểm
                            </th>
                            <th>
                                Tùy chọn
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($i = 1)
                        @foreach ($resultOfStudent as $point)
                        <tr>
                            <td>
                                {{$point->subjects->name}}
                            </td>
                            <td>
                                {{$point->score}}
                            </td>
                            <td>
                                <div aria-controls="collapseExample" aria-expanded="false" class="btn btn-secondary dropdown-toggle" data-toggle="collapse" href="#dropdown-form-<?= $i; ?>" role="button">
                                    <!-- <span  aria-haspopup="true"  data-toggle="dropdown" id="dropdownMenuButton"> -->
                                    <i class="la la-edit text-success">
                                    </i>
                                    Sửa điểm
                                    <!-- </span> -->
                                </div>
                            </td>
                        </tr>
                        @php ($i++)
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- end:: Body -->
@endsection
