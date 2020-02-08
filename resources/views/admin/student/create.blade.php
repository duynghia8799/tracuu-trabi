@extends('admin.layout.master')
@section('title-page') 
    Thêm học viên mới
@endsection
@section('content-page')
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Thêm học viên mới
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
                        <a class="m-nav__link" href="{{route('students.create')}}">
                            <span class="m-nav__link-text">
                                Thêm học viên mới
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
                                        Thêm học viên mới
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form action="{{route('students.create.store')}}" class="m-form m-form--fit m-form--label-align-right" method="post" name="createStudents">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <div class="alert alert-danger" role="alert">
                                        Những trường có dấu (*) là những trường bắt buộc
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group m-form__group">
                                            <h4>
                                                <code>
                                                    Nhập thông tin cơ bản
                                                </code>
                                            </h4>
                                        </div>
                                        <!-- Name student -->
                                        <div class="form-group m-form__group">
                                            <label for="name">
                                                Họ và tên
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <input class="form-control m-input" id="name" name="name" placeholder="Nhập họ và tên" type="text" value="{{ old('name') }}">
                                            </input>
                                            @if ($errors->has('name'))
                                            <p class="text-danger">
                                                {{ $errors->first('name') }}
                                            </p>
                                            @endif
                                        </div>
                                        <!-- Student code -->
                                        <div class="form-group m-form__group">
                                            <label for="student_code">
                                                CMND/Hộ chiếu
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <input class="form-control m-input" id="student_code" name="student_code" placeholder="Nhập CMND/Hộ chiếu" type="text" value="{{ old('student_code') }}">
                                            </input>
                                            @if ($errors->has('student_code'))
                                            <p class="text-danger">
                                                {{ $errors->first('student_code') }}
                                            </p>
                                            @endif
                                        </div>
                                        <!-- Birthday student -->
                                        <div class="form-group m-form__group">
                                            <label for="birthday">
                                                Ngày sinh
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="input-group date">
                                                <input class="form-control m-input" id="m_datepicker_3" name="birthday" readonly="" type="text" value="{{ old('birthday') }}">
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
                                                <code>
                                                    m-d-Y
                                                </code>
                                            </span>
                                            @if ($errors->has('birthday'))
                                            <p class="text-danger">
                                                {{ $errors->first('birthday') }}
                                            </p>
                                            @endif
                                        </div>
                                        <!-- Phone student -->
                                        <div class="form-group m-form__group">
                                            <label for="phone">
                                                Số điện thoại
                                            </label>
                                            <input class="form-control m-input" id="phone" name="phone" placeholder="Nhập số điện thoại" type="text" value="{{ old('phone') }}">
                                            </input>
                                            @if ($errors->has('phone'))
                                            <p class="text-danger">
                                                {{ $errors->first('phone') }}
                                            </p>
                                            @endif
                                        </div>
                                        <!-- Email student -->
                                        <div class="form-group m-form__group">
                                            <label for="email">
                                                Email
                                            </label>
                                            <input class="form-control m-input" id="email" name="email" placeholder="Nhập email" type="text" value="{{ old('email') }}">
                                            </input>
                                            @if ($errors->has('email'))
                                            <p class="text-danger">
                                                {{ $errors->first('email') }}
                                            </p>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Gender student -->
                                        <div class="form-group m-form__group">
                                            <label for="gender">
                                                Giới tính
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="m-radio-list">
                                                <label class="m-radio">
                                                    <input name="gender" type="radio" value="{{config('common.gender.male')}}">
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
                                            </div>
                                            @if ($errors->has('gender'))
                                            <p class="text-danger">
                                                {{ $errors->first('gender') }}
                                            </p>
                                            @endif
                                        </div>
                                        <!-- Course student -->
                                        <div class="form-group m-form__group">
                                            <label for="level">
                                                Trình độ đăng ký thi
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <select class="form-control" id="level" name="level">
                                                @foreach ($levels as $level)
                                                <option value="{{$level -> id}}">
                                                    {{$level -> level_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="term">
                                                Kì thi ngày
                                                <span class="text-danger">
                                                    *
                                                </span>
                                            </label>
                                            <div class="input-group date">
                                                <input class="form-control m-input" id="m_datepicker_3" name="term" readonly="" type="text" value="{{ old('term') }}">
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
                                                <code>
                                                    m-d-Y
                                                </code>
                                            </span>
                                            @if ($errors->has('term'))
                                            <p class="text-danger">
                                                {{ $errors->first('term') }}
                                            </p>
                                            @endif
                                        </div>
                                        <div class="form-group m-form__group">
                                            <h4>
                                                <code>
                                                    Nhập điểm số
                                                </code>
                                            </h4>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <code>
                                                    Điểm từng phần
                                            </code>
                                        </div>
                                        @php ($i = 0)
                                        @foreach ($subjects as $subject)
                                        <div class="form-group{{ $errors->has('score.' . $i) ? 'has-error' : '  ' }} m-form__group">
                                            
                                            <label>
                                                {{$subject->subject_name}}
                                            </label>
                                            <input class="form-control m-input" id="score-{{ $i }}" name="score[]" placeholder="Nhập số điểm" type="text" value="{{ old('score.' .$i) }}">
                                            </input>
                                            <input id="subject" name="subject[]" type="hidden" value="{{$subject->id}}">
                                                @if ($errors->has('score.' .$i))
                                                <p class="text-danger">                                                    
                                                    {{ $errors->first('score.' .$i) }}
                                                </p>
                                                @endif
                                            </input>
                                        </div>
                                        @php ($i++)
                                        @endforeach
                                        <div class="form-group m-form__group">
                                            <code>
                                                    Điểm đặc biệt
                                            </code>
                                        </div>
                                        <div class="form-group m-form__group">

                                            <label for="score_special">
                                                Điểm đặc biệt (Nếu có)
                                            </label>
                                            <input class="form-control m-input" id="score_special" name="score_special" placeholder="Nhập điểm" type="text" value="{{ old('score_special') }}">
                                            </input>
                                            @if ($errors->has('score_special'))
                                            <p class="text-danger">
                                                {{ $errors->first('score_special') }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <button class="btn btn-primary" type="submit">
                                                Thêm
                                            </button>
                                            <button class="btn btn-danger" type="reset">
                                                Hủy
                                            </button>
                                        </div>
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
@section('script')
<script>
    $(document).ready(function(){
            $("#level").select2();
    });
</script>
@endsection
