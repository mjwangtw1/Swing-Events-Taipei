@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        Hi, {{$data['user_name']}}, Create a New Event here
                    </h3>
                </div>

                <div class="panel-body">
                    

                <div class="panel panel-default">
 
                   <h3>建立新活動</h3>
                       <form action="{{ URL::asset('course/insert') }}" method="post">
                          {{ csrf_field()}}

                            <div class="form-group">

                             <fieldset class="form-group">
                                <textarea class="form-control" id="course_title" rows="1"></textarea>
                                <label >Event Nanme 活動名稱</label>

                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Style 風格
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#">Swing 搖擺舞</a></li>
                                    <li><a href="#">Blues 藍調</a></li>
                                    <li><a href="#">Swing&Blues 兩者都有</a></li>
                                  </ul>
                                </div>


                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Location 地點
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#">Sappho</a></li>
                                    <li><a href="#">福州 11</a></li>
                                    <li><a href="#">Tangorismo</a></li>
                                    <li><a href="#">TAV</a></li>
                                    <li><a href="#">中山堂</a></li>
                                    <li><a href="#">Triangle</a></li>
                                    <li><a href="#">Maji Maji</a></li>
                                  </ul>
                                </div>
                                
                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Image 圖片
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#">Swing 室外</a></li>
                                    <li><a href="#">Swing 室內</a></li>
                                    <li><a href="#">Blues 室內</a></li>
                                    <li><a href="#">大型 Party</a></li>
                                  </ul>
                                </div>



                                <label ></label>
                                <textarea class="form-control" id="course_teacher" rows="1"></textarea>
                                <label >費用</label>
                                <textarea class="form-control" id="course_level" rows="1"></textarea>
                                <label ></label>
                                <textarea class="form-control" id="course_location" rows="1"></textarea>
                                <label >費用</label>
                                <textarea class="form-control" id="course_price" rows="1"></textarea>
                                <label >連結</label>
                                <textarea class="form-control" id="course_link" rows="1"></textarea>
                                <label >時間</label>
                                <textarea class="form-control" id="course_date" rows="1"></textarea>
                                <label >活動說明</label>
                                <textarea class="form-control" id="course_desc" rows="1"></textarea>
                                <input name="course_group" type="hidden" value="{{$data['user_name']}}">

                              </fieldset>

                              <p>
                            <!-- <input class="btn btn-warning" type="submit" value="Submit"> -->
                            <a class="btn btn-warning" id="course_submit" href="#" role="button">確定新增</a>
                            <a class="btn btn-primary" href="{{ URL::asset('course/') }}" role="button">取消</a>
                            <a class="btn btn-default" href="{{ URL::asset('course/') }}" role="button">課程列表</a>
            </p>


                        </form>                     
                </div>            

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_js')
    <script src="{{ URL::asset('js/course_edit.js') }}"></script>
@stop
