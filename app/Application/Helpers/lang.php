<?php

function adminTrans($file , $word)
{
      return trans($file.'.'.$word);
}

function encodeJson($value)
{
      return json_encode($value , JSON_UNESCAPED_UNICODE);
}

function getCurrentLang()
{
      return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
}

function concatenateLangToUrl($url)
{
      return url(getCurrentLang().'/'.ltrim($url , '\\'));
}

function getAvLang()
{
      return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales();
}

function extractFiled($item = null , $name = 'name', $value = null, $type = 'text', $transeFile = null, $class = '', $dynamic=0, $rows = 8)
{
      $lang  = getAvLang();
      if($type == 'text')
      {
            return extractTextFiled($item , $lang, $name, $class, $value, $transeFile);
      } elseif($type == 'textarea') {

            return extractTexArea($item , $lang, $name, $rows, $class, $value, $transeFile, $dynamic);
      }
}

function getLangValue($value, $key)
{
    if($value != '' && $value != null){
        return isset(json_decode($value)->$key) ? json_decode($value)->$key : null;
    }
    return null;
}

function getDefaultValueKey($value)
{
    if($value != '' && $value != null){
        $deflan = getCurrentLang();
        return isset(json_decode($value)->$deflan) ? json_decode($value)->$deflan  : null;
    }
    return null;
}

function extractTextFiled ($item = null , $lang, $name,  $class = '', $value, $transeFile = null)
{

      $title  = $transeFile != null ? adminTrans($transeFile , $name)  : $name;
      $out = '<div class="'.$name.'"><ul class="nav nav-tabs tab-nav-right" role="tablist">';
      $i = 0;
      foreach ($lang as $l)
      {
            $active = $i == 0 ? 'active' : '';
            $out .= ' <li role="presentation" class="nav-item '.$active.'" ><a href="#'
                  . $name 
                  . $l['regional']
                  . '" data-toggle="tab" aria-expanded="false" class="nav-link '.$active.'">'
                  . $title
                  . ' '
                  . "(".$l['native'].")"
                  . '</a></li>';
            $i++;
      }
      $i = 0;
      $out .= '</ul><div class="tab-content">';
      foreach($lang as $key => $ln)
      {
          $value = $item != null && $item->{$name.'_'.$key} ? $item->{$name.'_'.$key}  : '';
            $active = $i == 0 ? 'active' : '';
            $out .= '<div role="tabpanel" class="tab-pane fade '
                 . $active
                  . ' in" id="'
                  . $name 
                  . $ln['regional']
                  . '">';
            $out .= '<div class="form-group">';
            $out .= '<div class="form-line">';
            $out .= '<input type="text" data-key="'
                 . $key
                  . '" name="'
                  . $name
                  . '[' 
                  . $key 
                  . ']" placeholder="'
                  . $title
                  . ' '
                  . $ln['native']
                  . '" id="'
                  . $name
                  . '_'
                  . $key
                  . '" class="form-control '
                  . $class 
                  . '" value="'
//                  . checkValueBeforeSet($value, $key)
                .$value
                  . '" />';
            $out .= '</div>';
            $out .= '</div></div>';
            $i++;
      }
      $out .='</div></div>';
      return $out;
}

function extractTextFiledAutoIncrement ($item = null , $name,  $class = '', $value, $transeFile = null, $counter)
{

      $lang = getAvLang();
      $title  = $transeFile != null ? adminTrans($transeFile , $name)  : $name;
      $out = '<div class="choice">';

      if($item) {
            
            $out .= '<input type="hidden" name="choice-' . $counter . '[id]" value="' . $item->id . '">';
      }

      $out .= '<ul class="nav nav-tabs tab-nav-right" role="tablist">';
      
      $i = 1;
      foreach ($lang as $l)
      {
            $active = $i == 0 ? 'active' : '';
            $out .= ' <li role="presentation" class="nav-item '.$active.'" ><a href="#'
                  . $name . '-' . $counter
                  . $l['regional']
                  . '" data-toggle="tab" aria-expanded="false" class="nav-link '.$active.'">'
                  . $title . '-' . $counter
                  . ' '
                  . "(".$l['native'].")"
                  . '</a></li>';
            $i++;
      }
      $i = 0;
      $out .= '</ul><div class="tab-content">';
      foreach($lang as $key => $ln)
      {
          $value = $item != null && $item->{$name.'_'.$key} ? $item->{$name.'_'.$key}  : '';
          
            $active = $i == 0 ? 'active' : '';
            $out .= '<div role="tabpanel" class="tab-pane fade '
                 . $active
                  . ' in" id="'
                  . $name . '-' . $counter
                  . $ln['regional']
                  . '">';
            $out .= '<div class="form-group">';
            $out .= '<div class="form-line">';
            $out .= '<input type="text" data-key="'
                 . $key
                  . '" name="'
                  . $name . '-' . $counter
                  . '[choice][' 
                  . $key 
                  . ']" placeholder="'
                  . $title
                  . ' '
                  . $ln['native']
                  . '" id="'
                  . $name . '-' . $counter
                  . '_'
                  . $key
                  . '" class="form-control '
                  . $class 
                  . '" value="'
//                  . checkValueBeforeSet($value, $key)
                .$value
                  . '" />';
            $out .= '</div>';
            $out .= '</div></div>';
            $i++;
      }

      $out .= '<div class="form-group">'
      . '<label for="is_correct-' . $counter . '">Is this the correct answer?</label>'
      . '<div class="form-check">'
      . '<label class="form-check-label">';

      if(isset($item) && $item->is_correct == 0) {
            $out .= '<input class="form-check-input" name="choice-' . $counter . '[is_correct]" checked type="radio" value="0" >No';
      }else{
            $out .= '<input class="form-check-input" name="choice-' . $counter . '[is_correct]" type="radio" value="0" >No';
      }
      
      $out .=  '</label>'
      . '<label class="form-check-label">';
      if(isset($item) && $item->is_correct == 1) {
            $out .= '<input class="form-check-input" name="choice-' . $counter . '[is_correct]" checked type="radio" value="1" >Yes';
      }else{
            $out .= '<input class="form-check-input" name="choice-' . $counter . '[is_correct]" type="radio" value="1" >Yes';
      }
      $out .=  '</label>'
      . '</div>'
      . '</div>';

      if($item){

            $out .= '<span class="btn btn-warning" onclick="removechoice(this, ' . $item->id . ')"> <i class="fa fa-minus"></i></span></div></div>';
      }else{

            $out .= '<span class="btn btn-warning" onclick="removechoice(this)"> <i class="fa fa-minus"></i></span></div></div>';
      }

      return $out;
      
}


function addNewQuestionChoice($counter) {

      //dd($test);
      $out = '<div class="form-group">'
            . '<label for="choice-' . $counter . '[is_correct]">Is this the correct answer?</label>'
            . '<div class="form-check">'
            . '<label class="form-check-label">'
            . '<input class="form-check-input" name="choice-' . $counter . '[is_correct]" type="radio" value="0" >'
            . 'No'
            . '</label>'
            . '<label class="form-check-label">'
            . '<input class="form-check-input" name="choice-' . $counter . '[is_correct]" type="radio" value="1" >'
            . 'Yes'
            . '</label>'
            . '</div>'
            . '</div>'
            . '<span class="btn btn-warning" onclick="removechoice(this)">'
            . '<i class="fa fa-minus"></i>'
            . '</span>';

            return $out;
      

}

function checkValueBeforeSet($value , $key){
    if($value != null && $value != '' && is_string($value)){
      return  getLangValue($value, $key);
    } elseif(is_array($value)){
        return $value[$key];
    }else{
        return $value;
    }
}

function extractTexArea($item = null , $lang, $name, $rows=8, $class = '', $value,  $transeFile = null)
{
      $title  = $transeFile != null ? adminTrans($transeFile , $name)  : $name;
      $out = '<ul class="nav nav-tabs tab-nav-right" role="tablist">';
      $i = 0;
      foreach ($lang as $l)
      {
            $active = $i == 0 ? 'active' : '';
            $out .= ' <li role="presentation" class="nav-item '.$active.'"><a href="#'
                  . $name
                  . $l['regional']
                  . '" data-toggle="tab" aria-expanded="false" class="nav-link '.$active.'">'
                  . $title
                  . ' '
                  . "(".$l['native'].")"
                  . '</a></li>';
            $i++;
      }
      $i = 0;

      $out .= '</ul><div class="tab-content">';
      foreach($lang as $key => $ln)
      {
            
            $value = $item != null && $item->{$name.'_'.$key} ? $item->{$name.'_'.$key}  : '';

            $active = $i == 0 ? 'active' : '';
            $out .= '<div role="tabpanel" class="tab-pane fade '
                 . $active
                  . ' in" id="'
                  . $name
                  . $ln['regional']
                  . '">';
            $out .= '<div class="form-group">';
            $out .= '<div class="form-line">';
            $out .= '<textarea  name="'
                 . $name
                 . '['
                 . $key
                 . ']" data-key="'
                 . $key
                 . '" placeholder="'
                 . $title
                 . ' '
                 . $ln['native']
                 . '"  id="'
                 . $name
                 . '_'
                 . $key
                 . '" rows="'
                 . $rows
                 . '" class="form-control '
                 . $class
                 . '">'
//                . checkValueBeforeSet($value, $key)
                 .$value
                 . '</textarea>';
            $out .= '</div>';
            $out .= ' </div></div>';
            $i++;
      }
      $out .='</div>';
      return $out;
}


function extractTexAreaArr($item, $name, $subarr_name, $class = '',  $rows=8, $transeFile = null)
{
      $lang = getAvLang();


      $title  = $transeFile != null ? adminTrans($transeFile , $name)  : $name . ' - ' . $item->title_en;
      $out = '<ul class="nav nav-tabs tab-nav-right" role="tablist">';
      $i = 0;
      foreach ($lang as $l)
      {
            $active = $i == 0 ? 'active' : '';
            $out .= ' <li role="presentation" class="nav-item '.$active.'"><a href="#'
                  . $item->name . '_' . $subarr_name
                  . $l['regional']
                  . '" data-toggle="tab" aria-expanded="false" class="nav-link '.$active.'">'
                  . $title
                  . ' '
                  . "(".$l['native'].")"
                  . '</a></li>';
            $i++;
      }
      $i = 0;


      $out .= '</ul><div class="tab-content">';
      foreach($lang as $key => $ln)
      {
            $value = $item->{'description_' . $key};
// dd($name);
            $active = $i == 0 ? 'active' : '';
            $out .= '<div role="tabpanel" class="tab-pane fade '
                 . $active
                  . ' in" id="'
                  . $item->name . '_' . $subarr_name
                  . $ln['regional']
                  . '">';
            $out .= '<div class="form-group">';
            $out .= '<div class="form-line">';
            $out .= '<textarea  name="'
                 . $name
                 . '['
                 . $item->name
                 . '][' . $subarr_name
                 . '][' . $key . ']" data-key="'
                 . $key
                 . '" placeholder="'
                 . $title
                 . ' '
                 . $ln['native']
                 . '"  id="'
                 . $name . '[' . $subarr_name . ']'
                 . '_'
                 . $key
                 . '" rows="'
                 . $rows
                 . '" class="form-control '
                 . $class
                 . '">'
//                . checkValueBeforeSet($value, $key)
                 .$value
                 . '</textarea>';
            $out .= '</div>';
            $out .= ' </div></div>';
            $i++;
      } 
      $out .='</div><input type="hidden" name="' 
      . $name 
      . '[' 
      . $item->name 
      . '][id]' 
      . '" value="' . $item->id . '">';

      //dd($out);
      return $out;
}

function transformArray($array)
{
      $newArray = [];
      foreach($array as $key => $ar)
      {
            if(is_array($ar))
            {
                  $newArray[$key] = json_encode($ar, JSON_UNESCAPED_UNICODE);
            } else {
                  $newArray[$key] = $ar;
            }
      }
      return $newArray;
}

function transformSelect($array)
{
      $newArray = [];
      if(count($array) > 0)
      {
            foreach($array as $key => $value)
            {
                  $newArray[$key] = getDefaultValueKey($value);
            }
      }
      return $newArray;
}

function getDir()
{
      return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection();
}

function getDirection()
{
      $cD = getDir();
      return $cD == 'rtl' ? 'right' : 'left';
}

function getReverseDirection()
{
      $cD = getDir();
      return $cD == 'rtl' ? 'left' : 'right';
}

function lang($filed , $lang = null){
      $lang  = $lang != null ? $lang : getCurrentLang();
      return $filed.'_'.$lang;
}