@extends('admin.layout.master')
@section('title-page') 
    Chỉnh sửa thông tin học viên
@endsection
@section('content-page')
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Chỉnh sửa thông tin học viên
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
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a class="m-nav__link" href="{{route('students.edit',$student -> id)}}">
                            <span class="m-nav__link-text">
                                Chỉnh sửa thông tin học viên
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet m-portlet--tab">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon">
                                        <i class="flaticon-list-3">
                                        </i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Chỉnh sửa thông tin học viên
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form action="{{route('students.edit.update',$student -> id)}}" class="m-form m-form--fit m-form--label-align-right" method="post">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <div class="alert alert-danger" role="alert">
                                        Những trường có dấu (*) là những trường bắt buộc
                                    </div>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="name">
                                        Họ và tên
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input class="form-control m-input" id="name" name="name" placeholder="Nhập họ và tên" type="text" value="{{ $student -> name }}">
                                    </input>
                                    @if ($errors->has('name'))
                                    <p class="text-danger">
                                        {{ $errors->first('name') }}
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="student_code">
                                        CMND/Hộ chiếu
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <input class="form-control m-input" id="student_code" name="student_code" placeholder="Nhập CMND/Hộ chiếu" type="text" value="{{ $student -> student_code }}">
                                    </input>
                                    @if ($errors->has('student_code'))
                                    <p class="text-danger">
                                        {{ $errors->first('student_code') }}
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="phone">
                                        Ngày sinh
                                    </label>
                                    <span class="text-danger">
                                        *
                                    </span>
                                    <div class="input-group date">
                                        <input class="form-control m-input" id="m_datepicker_3" name="birthday" readonly="" type="text" value="{{ $student -> birthday }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar">
                                                    </i>
                                                </span>
                                            </div>
                                        </input>
                                    </div>
                                    <span class="m-form__help">
                                        Định dạng
                                        <span class="text-danger">
                                            m-d-Y
                                        </span>
                                    </span><br>
                                    @if ($errors->has('birthday'))
                                    <p class="text-danger">
                                        {{ $errors->first('birthday') }}
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="phone">
                                        Số điện thoại
                                    </label>
                                    <input class="form-control m-input" id="phone" name="phone" placeholder="Nhập số điện thoại" type="text" value="{{ $student -> phone }}">
                                    </input>
                                    @if ($errors->has('phone'))
                                    <p class="text-danger">
                                        {{ $errors->first('phone') }}
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="email">
                                        Email
                                    </label>
                                    <input class="form-control m-input" id="email" name="email" placeholder="Nhập email" type="text" value="{{ $student -> email }}">
                                    </input>
                                    @if ($errors->has('email'))
                                    <p class="text-danger">
                                        {{ $errors->first('email') }}
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="gender">
                                        Giới tính
                                    </label>
                                    <div class="m-radio-list">
                                        @if ($student->gender == config('common.gender.male'))
                                        <label class="m-radio">
                                            <input checked="" name="gender" type="radio" value="{{$student->gender}}">
                                                Nam
                                                <span>
                                                </span>
                                            </input>
                                        </label>
                                        <label class="m-radio">
                                            <input name="gender" type="radio" value="{{config('common.gender.female')}}">
                                                Nữ
                                                <span>
                                                </span>
                                            </input>
                                        </label>
                                        @elseif ($student->gender == config('common.gender.female'))
                                        <label class="m-radio">
                                            <input checked="" name="gender" type="radio" value="{{config('common.gender.male')}}">
                                                Nam
                                                <span>
                                                </span>
                                            </input>
                                        </label>
                                        <label class="m-radio">
                                            <input checked="" name="gender" type="radio" value="{{$student->gender}}">
                                                Nữ
                                                <span>
                                                </span>
                                            </input>
                                        </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group m-form__group">
                                    <input name="id" type="hidden" value="{{ $student -> id }}">
                                    </input>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <button class="btn btn-primary" type="submit">
                                            Cập nhật
                                        </button>
                                        <button class="btn btn-danger" type="reset">
                                            Hủy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Body -->
@endsection
