@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        Hi, {{$data['user_name']}}, 請在此建立新活動
                    </h3>
                </div>

                <div class="panel-body">
                 
                <form class="form-horizontal" action="{{ URL::asset('event/insert') }}" method="post">
                        {{ csrf_field()}}
                        <fieldset>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">活動名稱</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="event_name" type="text" placeholder="Name of Event?" class="form-control input-md">
                            
                          </div>
                        </div>

                        <!-- Multiple Radios (inline) -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="radios">風格</label>
                          <div class="col-md-4"> 
                            <label class="radio-inline" for="radios-0">
                              <input type="radio" name="style_radio" id="radios-0" value="1" checked="checked">
                              Swing
                            </label> 
                            <label class="radio-inline" for="radios-1">
                              <input type="radio" name="style_radio" id="radios-1" value="2">
                              Blues
                            </label> 
                            <label class="radio-inline" for="radios-2">
                              <input type="radio" name="style_radio" id="radios-2" value="3">
                              Swing &amp; Blues
                            </label>
                          </div>
                        </div>
                        
                        <!-- Prepended checkbox -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="prependedcheckbox">非常態活動</label>
                          <div class="col-md-4">
                            <div class="input-group">
                              <span class="input-group-addon">     
                                  <input type="checkbox">     
                              </span>
                              <input id="prependedcheckbox" name="is_special_event" class="form-control" type="text" placeholder="特殊活動">
                            </div>
                            <p class="help-block">說明</p>
                          </div>
                        </div>

                        <!-- Button Drop Down -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="selectbasic">請選擇一個地點</label>
                          <div class="col-md-4">
                            <select id="selectbasic" name="selectbasic" class="form-control">
                              <option value="1">Tangorismo</option>
                              <option value="2">TAV</option>
                              <option value="3">中山堂</option>
                            </select>
                          </div>
                        </div>

                        <!-- Multiple Radios (inline) -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="radios">室內 | 室外</label>
                          <div class="col-md-4"> 
                            <label class="radio-inline" for="radios-0">
                              <input type="radio" name="location_radios" id="radios-0" value="1" checked="checked">
                              Indoor
                            </label> 
                            <label class="radio-inline" for="radios-1">
                              <input type="radio" name="location_radios" id="radios-1" value="2">
                              Outdoor
                            </label> 
                            <label class="radio-inline" for="radios-2">
                              <input type="radio" name="location_radios" id="radios-2" value="3">
                              Mix
                            </label>
                          </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">費用</label>  
                            <div class="input group">  

                              <div class="col-md-4">
                                 
                                  <input id="textinput" name="event_fee" type="text" placeholder="$400 maybe ?" class="form-control input-md">
                              </div>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">時間</label>  
                          <div class="col-md-4">
                              <input id="textinput" name="textinput" type="text" placeholder="(2016/05/18 20:00:00)" class="form-control input-md">
                              <span class="help-block time_help">請依照上面的格式輸入</span>  
                          </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">活動連結</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="event_link" type="text" placeholder="Event Link URL" class="form-control input-md">
                            
                          </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textarea">活動說明</label>
                          <div class="col-md-4">                     
                            <textarea class="form-control" id="textarea" name="event_desc">Tell us about the event! Live band? DJ music ? No Alcohol ? Bring your Own shoes? Taster Lessons? </textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">Tags</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="event_tags" type="text" placeholder="Event Link URL" class="form-control input-md">
                          <span class="help-block tags_help">請用逗號分隔開來</span>    
                          </div>
                        </div>

                        <!-- Button (Double) -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="button1id"></label>
                          <div class="col-md-8">
                            <button id="button1id" name="submit" class="btn btn-success">Yes 我要新增</button>
                            <button id="button2id" name="cancel" class="btn btn-danger"> Nah 算惹</button>
                          </div>
                        </div>
  

                        </fieldset>
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
