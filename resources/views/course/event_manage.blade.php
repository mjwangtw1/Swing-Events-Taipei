@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3>Hi, {{$data['user_name']}}, Here will list all the events you posted</h3>
                  </div>

                <div class="panel-body">
                    

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
                  <div class="panel-heading">活動一覽表 (過期活動不會在此)   

                    <button type="button" class="btn btn-warning" aria-label="Left Align">
                      <span class="glyphicon glyphicon-star" aria-hidden="true">
                        <a href="/new_event">
                          新增活動
                        </a>
                        </span>
                    </button>

                      

                  </div>
                    
                      <!-- Table -->
                      <table class="table">
                        <!--This part is Title part-->
                        <tr>
                            <td>活動</td>
                            <td>風格</td>
                            <td>時間</td>
                            <td>地點</td>
                            <td>費用</td>
                            <td>連結</td>
                            <td>簡介</td>
                            <td>圖片</td>
                            <td>Created</td>
                            <td>Tag</td>
                            <td>編輯</td>
                        <!--     <td>主辦</td>
                            <td>分級</td>
                            <td>價格(couple)</td>
                            <td>報名連結</td>
                            
                            <td>簡介</td>
                            <td>編輯</td> -->
                            
                        </tr>

                        <!--This part is content, should use foreach loop-->

                        <tr>
                            <td>好的 blues party Lv.3</td>
                            <td>Blues</td>
                            <td>5/20, 8pm</td>
                            <td>Sappho</td>
                            <td>400</td>
                            <td>http://tinyurl.abc.qq</td>
                            <td>blues party blah blah blah 棒棒啦!</td>
                            <td>圖片圖片位置</td>
                            <td>RnB</td>
                            <td>Live Band!, Taster</td>
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
