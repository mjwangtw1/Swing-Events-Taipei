@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Course Manage Panel</div>

                <div class="panel-body">
                    <h3>Hi, {{$data['user_name']}}, Create a New Class here</h3>

                <div class="panel panel-default">
 
                   <h3>New Class</h3>
                       <form action="{{ URL::asset('course/insert') }}" method="post">
                          {{ csrf_field()}}

                            <div class="form-group">

                             <fieldset class="form-group">
                                <textarea class="form-control" id="course_title" rows="1"></textarea>
                                <label >Teacher</label>
                                <textarea class="form-control" id="course_teacher" rows="1"></textarea>
                                <label >Level</label>
                                <textarea class="form-control" id="course_level" rows="1"></textarea>
                                <label >Location</label>
                                <textarea class="form-control" id="course_location" rows="1"></textarea>
                                <label >Price</label>
                                <textarea class="form-control" id="course_price" rows="1"></textarea>
                                <label >URL Link</label>
                                <textarea class="form-control" id="course_link" rows="1"></textarea>
                                <label >Class Date</label>
                                <textarea class="form-control" id="course_date" rows="1"></textarea>
                                <label >Class Desc</label>
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
