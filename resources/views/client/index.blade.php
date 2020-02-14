<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
                <title>
                	Tra cứu điểm thi
                </title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            </meta>
        </meta>
    </head>
    <body>
        <style>
            #wrapper {
			width: 100%;
			height: 100%;
			margin: 80px 0;
		}
		#wrapper .body-page-search {
			max-width: 1200px;
			width: auto;
			height: auto;
			margin: auto;
			background: #f1f1f1;
			position: relative;
			padding: 50px 200px;
			border-radius: 50px;
			box-shadow: 0 0 50px #badcf1;
		}

		#wrapper .body-page-search .subtitle h2 {
			font-family: Arial;
			font-size: 20px;
			text-align: center;
			font-weight: 300;
			text-transform: uppercase;
		}
		
		#wrapper .body-page-search .result-search h2 {
			font-family: Arial;
			font-size: 20px;
			text-align: center;
		}
		#wrapper .body-page-search .form-lookup h3 {
			font-family: Arial;
			font-size: 20px;
		}
		#wrapper .body-page-search .result-search h2>span.full_name {
			color: #f36a6a;
			font-weight: 300px;
			font-size: 25px;
		}
		#wrapper .body-page-search .title h1{
			font-family: Arial;
			font-size: 35px;
			text-align: center;
			font-weight: 500;
			text-transform: uppercase;
		}
		#wrapper .body-page-search .form-lookup {
			margin-top: 50px;
		}
		#wrapper .body-page-search .form-lookup .form-group > label.label-name {
			width: 100%;
		    display: block;
		    font-size: 18px;
		    margin-bottom: 10px;
		    font-family: Arial;
		}
		#wrapper .body-page-search .form-lookup .form-group .error>p {
			color: #f36a6a;
			margin-top: 10px;
			display: none;
			font-family: Arial;
		}
		#wrapper .body-page-search .result-search {
			width: 100%;
			height: auto;
			display: block;
			margin: auto;
		}
		#wrapper .body-page-search .result-search>table {
			border: 1px solid #c3c1c3;
			border-collapse: collapse;
		}
		#wrapper .body-page-search .result-search>table.table>thead>tr>th {
			text-align: center;
		}
		#wrapper .body-page-search .result-search>table.table>tbody>tr>th {
			text-align: center;
		}
		#wrapper .body-page-search .result-search>table.table>tbody>tr {
			text-align: center;
		}

		@media only screen and (max-width: 1200px) {
			#wrapper .body-page-search {
			    max-width: 980px;
			}
		}
		@media only screen and (max-width: 860px) {
			#wrapper .body-page-search {
			    max-width: 800px;
			    padding: 50px 50px;
			}
			#wrapper .body-page-search .title h1 {
			    font-size: 35px;
			    line-height: 50px;
			}
		}
		@media only screen and (max-width: 580px) {
			#wrapper .body-page-search {
			    padding: 50px 20px;
			}
		}
        </style>
        <div id="wrapper">
            <div class="body-page-search">
                <div class="group-title">
                    <div class="subtitle">
                        <h2>
                            Trung tâm du học đức trabi
                        </h2>
                    </div>
                    <div class="title">
                        <h1>
                            Hệ thống tra cứu điểm thi trực tuyến
                        </h1>
                    </div>
                </div>
                <!-- Form search -->
                <div class="form-lookup">
                    <h3>
                        Thí sinh điền đầy đủ các thông tin dưới đây
                    </h3>
                    <form action="{{route('search')}}" method="post">
                        @csrf
                        <div class="row">
                        	<div class="col-lg-12">
		                        <div class="form-group m-form__group">
		                            <label class="label-name" for="student_code">
		                                CMND/Hộ chiếu
		                            </label>
		                            <input class="form-control m-input" value="{{old('student_code')}}" id="student_code" name="student_code" placeholder="CMND/Hộ chiếu" type="text">
		                            </input>
		                            <span class="m-form__help">
                                        <code>
                                        	Nhập chính xác số CMND hoặc hộ chiếu đã đăng kí với TRABI
                                        </code>
                                    </span>
		                            @if ($errors->has('student_code'))
		                                <p class="text-danger">
		                                    {{ $errors->first('student_code') }}
		                                </p>
		                            @endif
		                        </div>
		                        <div class="form-group m-form__group">
		                            <label class="label-name" for="level">
		                                Trình độ
		                            </label>
		                            <select class="form-control" id="level" name="level" value="{{old('level')}}">
		                                @foreach ($levels as $level)
		                                <option value="{{$level->id}}">
		                                    {{$level->level_name}}
		                                </option>
		                                @endforeach
		                            </select>
		                            <span class="m-form__help">
                                        <code>
                                        	Chọn chính xác trình độ thi đã đăng kí với TRABI
                                        </code>
                                    </span>
		                        </div>
		                        <div class="form-group m-form__group">
		                            <label class="label-name" for="level">
		                                Kì thi đăng kí 
		                            </label>
		                            <input class="form-control m-input" type="month" name="term" id="term" value="{{old('term')}}">
		                            <span class="m-form__help">
                                        <code>
                                        	Chọn chính xác tháng và năm đã đăng kí với TRABI
                                        </code>
                                    </span>
		                            @if ($errors->has('term'))
		                                <p class="text-danger">
		                                    {{ $errors->first('term') }}
		                                </p>
		                            @endif
		                        </div>
	                        </div>
                        </div>
                        <div class="row">
	                       	<div class="col-lg-12">
	                        	<div class="form-group m-form__group">
			                        <input class="btn btn-primary" id="submit" type="submit" value="Tra cứu">
			                            </input>
			                    </div>
	                        </div>
	                    </div>
                    </form>
                </div>
                <!-- Result search -->
                @if ( isset($exaclly_result_normal) )
	                <div class="result-search" id="result-search">
	                    <div class="table-result">
	                        <div class="card">
	                            <div class="card-header">
	                            	<h4>Thông tin đầy đủ của học viên</h4>
	                                <p>
										<span class="full_name">
											<b>Họ và tên:</b> <span class="text-danger">{{$infor_level->student->name}}</span> <br> 
											<b>CMND/Hộ chiếu:</b> <span class="text-danger"> {{$infor_level->student->student_code}}</span> <br>
											<b>Ngày sinh:</b> <span class="text-danger"> {{date('d-m-Y', strtotime($infor_level->student->birthday))}} </span> <br>
											<b>Trình độ đăng kí:</b> <span class="text-danger"> {{$infor_level->level->level_name}}</span> <br>
											<b>Kì thi đăng kí:</b> <span class="text-danger"> Tháng {{date('m-Y', strtotime($infor_level->term))}}</span> <br>
										</span>
									</p>
	                            </div>
	                            <!-- /.card-header -->
	                            <div class="card-body">
	                                <table class="table table-bordered">
	                                    <thead>
	                                        <tr>
	                                        	<th>
	                                        		Phần thi
	                                        	</th>
	                                        	<th class="text-center">
	                                        		Điểm
	                                        	</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    	<?php
	                                    		$total = 0 ;
	                                    		foreach ($exaclly_result_normal as $result) { 
	                                    			$total +=$result->score_normal;
	                                    	?>
	                                    			<tr>
				                                       	<td>
				                                            {{$result->subject->subject_name}}
				                                        </td>
				                                        <td class="text-center">
				                                            {{$result->score_normal}}
				                                        </td>
				                                    </tr>
	                                    	<?php 
	                                    		}
	                                    	?>
						                    	<tr>
							                    	<td colspan="1">Tổng số điểm</td>
							                    	<td class="text-center">{{$total}}</td>
						                    	</tr>
	                                    </tbody>
	                                </table>
	                                <span class="text-danger"><b>Lưu ý</b></span>
	                                <span class="note">
	                                	<ul>
	                                		<li>Phần viết (Schriftliche Prüfung) có số điểm lớn hơn hoặc hoặc bằng 135 là đỗ, thấp hơn là trượt.</li>
	                                		<li>Phần nói (Mündlich Prüfung) có số điểm lớn hơn hoặc hoặc bằng 45 là đỗ, thấp hơn là trượt .</li>
	                                	</ul>
	                                </span>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                @elseif( isset($exaclly_result_special) )
					<div class="result-search" id="result-search">
	                    <div class="table-result">
	                        <div class="card">
	                            <div class="card-header">
	                            	<h4>Thông tin đầy đủ của học viên</h4>
	                                <p>
										<span class="full_name">
											<b>Họ và tên:</b> <span class="text-danger">{{$infor_level->student->name}}</span> <br> 
											<b>CMND/Hộ chiếu:</b> <span class="text-danger"> {{$infor_level->student->student_code}}</span> <br>
											<b>Ngày sinh:</b> <span class="text-danger"> {{date('d-m-Y', strtotime($infor_level->student->birthday))}} </span> <br>
											<b>Trình độ đăng kí:</b> <span class="text-danger"> {{$infor_level->level->level_name}}</span> <br>
											<b>Kì thi đăng kí:</b> <span class="text-danger"> Tháng {{date('m-Y', strtotime($infor_level->term))}}</span> <br>
										</span>
									</p>
	                            </div>
	                            <!-- /.card-header -->
	                            <div class="card-body">
	                                <table class="table table-bordered">
	                                    <thead>
	                                        <tr>
	                                        	<th class="text-center">
	                                        		Số điểm đạt được
	                                        	</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    	<?php

	                                    		foreach ($exaclly_result_special as $result) { 
	                                    	?>
	                                    			<tr>
				                                       	<td class="text-center">
				                                            {{$result->score_special}}
				                                        </td>
				                                    </tr>
	                                    	<?php 
	                                    		}
	                                    	?>
						                    	<tr>
													<td><span class="btn btn-success btn-block">Đạt</span></td>
							                    </tr>
	                                    </tbody>
	                                </table>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                @endif
            </div>
        </div>
    </body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
    </script>
    <script type="text/javascript">
        @if (session('error')==true) 
                  swal('Không có thông tin về học viên này!' , {
                      icon: "error"
                  });
        @endif
    </script>
</html>