@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Course Manage Panel</div>

                <div class="panel-body">
                    <h3>Hi, {{$data['user_name']}}, Here will list all classes you posted</h3>

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">LV3超級花招班 
                    <span class="label label-warning" style="float:right;display: inline-block;">
                    凱惇    
                    </span>
                    <span class="label label-success" style="float:right;display: inline-block;">
                      中高級班    
                    </span>
                    <span class="label label-info" style="float:right;display: inline-block;">
                      4000/couple
                    </span>
                    </h3>
                  </div>
                  <div class="panel-body">
                    Yo 這是凱惇的全新花招班
                  </div>

                  <div class="panel-footer">
                  <span>報名連結</span>
                  <span style="float:right;">Salsa Salud</span>
                  </div>
                </div>




                <div class="panel panel-default">
                  <!-- Default panel contents -->
                  <div class="panel-heading">課程一覽表</div>
                    
                      <!-- Table -->
                      <table class="table">
                        <!--This part is Title part-->
                        <tr>
                            <td>課程</td>
                            <td>老師</td>
                            <td>分級</td>
                            <td>地點</td>
                            <td>價格(couple)</td>
                            <td>報名連結</td>
                            <td>時間</td>
                            <td>簡介</td>
                            <td>編輯</td>
                            <td>Created</td>
                        </tr>

                        <!--This part is content, should use foreach loop-->

                        <tr>
                            <td>LV3 超級花招班</td>
                            <td>凱惇</td>
                            <td>中高級</td>
                            <td>Salsa Salud</td>
                            <td>4000</td>
                            <td>http://www.google.com.twsadis</td>
                            <td>5/2,5/9,5/16,5/23</td>
                            <td>超級花招班又來嚕！！！</td>
                            <td>
                                <a class=" glyphicon glyphicon-remove " data-id="2" role="button"></a>
                            </td>
                            <td>{{$data['user_name']}}</td>
                        </tr>

                        <!--This part is user input-->
                  </table>
                    
                </div>            
            



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
