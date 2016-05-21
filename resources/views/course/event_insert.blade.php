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
                          <input id="textinput" name="event_name" type="text" placeholder="Name of Event?" class="form-control input-md" required>
                            
                          </div>
                        </div>

                        <!-- Multiple Radios (inline) -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="radios">風格</label>
                          <div class="col-md-4"> 
                            <label class="radio-inline" for="radios-0">
                              <input type="radio" name="dance_style" id="radios-0" value="1" checked="checked" required>
                              Swing
                            </label> 
                            <label class="radio-inline" for="radios-1">
                              <input type="radio" name="dance_style" id="radios-1" value="2">
                              Blues
                            </label> 
                            <label class="radio-inline" for="radios-2">
                              <input type="radio" name="dance_style" id="radios-2" value="3">
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
                                  <input type="checkbox" name="is_special_event" value="1">     
                               </span>
                              <input id="prependedcheckbox" class="form-control" type="text" placeholder="這是一個特殊活動!" ㄒ>
                              
                            </div>
                            <p class="help-block">特殊活動請勾選,謝謝</p>
                          </div>
                        </div>

                        <!-- Button Drop Down -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="selectbasic">請選擇一個地點</label>
                          <div class="col-md-4">
                            <select id="selectbasic" name="location" class="form-control" > 

                              <?php 

                              //Foreach to loop out all the locations
                              if (is_array($event_location) && ! (empty($event_location)))
                              {
                                foreach($event_location as $single_location)
                                {
                                  echo '<option value="' . $single_location['id'] . '">' . $single_location['name'] . '</option>';
                                }
                              }

                              ?>

                            </select>
                          </div>
                        </div>

                        <!-- Multiple Radios (inline) -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="radios">室內 | 室外</label>
                          <div class="col-md-4"> 
                            <label class="radio-inline" for="radios-0">
                              <input type="radio" name="location_type" id="radios-0" value="1" checked="checked">
                              Indoor
                            </label> 
                            <label class="radio-inline" for="radios-1">
                              <input type="radio" name="location_type" id="radios-1" value="2">
                              Outdoor
                            </label> 
                            <label class="radio-inline" for="radios-2">
                              <input type="radio" name="location_type" id="radios-2" value="3">
                              Mix
                            </label>
                          </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">費用</label>  
                            <div class="input group">  

                              <div class="col-md-4">
                                 
                                  <input id="textinput" name="event_fee" type="text" placeholder="400 maybe ?" class="form-control input-md">
                                  <span class="help-block time_help">請直接填數字即可, 若免費活動請填 0</span>  
                              </div>  
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">活動開始時間</label>  
                          <div class="col-md-4">
                              <input id="textinput" name="event_time" type="text" placeholder="2032/05/18 20:00:00" class="form-control input-md" maxlength="20" required>
                              <span class="help-block time_help">請依照上面的格式輸入, 以便資料建立</span>  
                          </div>
                        </div>

                          <div class="form-group">
                          <label class="col-md-4 control-label" for="selectbasic">活動時間</label>
                          <div class="col-md-4">
                            <select id="selectbasic" name="event_length" class="form-control">
                                
                              <option value="2">2 小時</option>  
                              <option value="3">3 小時</option> 
                              <option value="4">4 小時</option> 
                              <option value="5">5 小時</option> 

                              <span class="help-block end_time_help">請選擇活動時間</span>
                            </select>
                          </div>
                        </div>


                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">活動連結</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="event_link" type="text" placeholder="Event Link URL" class="form-control input-md">
                          <span class="help-block time_help">前面請加 http://</span>  
                          </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textarea">活動說明</label>
                          <div class="col-md-4">                     
                            <textarea class="form-control" id="textarea" name="event_desc" placeholder="Tell us about the event! Live band? DJ music ? No Alcohol ? Bring your Own shoes? Taster Lessons?">
                              
                            </textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">Tags</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="event_tags" type="text" placeholder="Live Band, Taster" class="form-control input-md">
                          <span class="help-block tags_help">請用逗號分隔開來</span>    
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">passcode</label>  
                          <div class="col-md-4">
                          <input id="textinput" name="passcode" type="text" placeholder="Event Link URL" class="form-control input-md" required>
                          <span class="help-block time_help">請輸入passcode 才能建立唷! (請洽阿懋) </span>  
                          </div>
                        </div>

                        <!-- Button (Double) -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="button1id"></label>
                          <div class="col-md-8">
                            <button id="button1id" name="submit" class="btn btn-success">Yes 我要新增</button>
                            <a href="/" class="btn btn-danger" role="button">Nah 算惹</a>

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
