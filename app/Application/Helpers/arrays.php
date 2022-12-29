<?php

use App\Application\Model\Categories;
use App\Application\Model\Certificates;
use App\Application\Model\Certificatescontainer;
use App\Application\Model\Courses;
use App\Application\Model\Events;
use App\Application\Model\Group;
use App\Application\Model\User;

function status()
{
    return [
        'Active' => trans('home.Active'),
        'Deactive' => trans('home.Deactive'),
    ];
}
function faqTypes()
{
    return [
        '1' => trans('faq.faqType1'),
        '2' => trans('faq.faqType2'),
        '3' => trans('faq.faqType3'),
        '4' => trans('faq.faqType4'),

    ];
}

function quizStatus(){
    
    return [
        '0' => 'Not Started',
        '1' => 'In Progress',
        '2' => '',
        '3' => '',
        '4' => 'Done'
    ];
}

function usersTypes()
{
    // return [
    //     '1' => trans('home.UserType1'),
    //     '2' => trans('home.UserType2'),
    //     '3' => trans('home.UserType3'),
    //     '4' => trans('home.UserType4'),
    //     '5' => trans('home.UserType5'),
    //     '6' => trans('home.UserType6'),
    //     '7' => trans('home.UserType7'),
    //     '8' => trans('home.UserType8'),
    //     '9' => trans('home.UserType9'),
    //     '10' => trans('home.UserType10'),
    //     '11' => trans('home.UserType11'),
    //     '12' => trans('home.UserType12'),
    //     '13' => trans('home.UserType13'),
    //     '14' => trans('home.UserType14'),


    // ];

    return Group::all()->pluck('name', 'id')->toArray();
}

function order_status()
{
    return [
        ''=>'Order Status',
        '0' => trans('home.Order_status_0'),
        '1' => trans('home.Order_status_1'),
        '2' => trans('home.Order_status_2'),
        '3' => trans('home.Order_status_3'),
        '4' => trans('home.Order_status_4'),
        '5' => trans('home.Order_status_5'),
        '6' => trans('home.Order_status_6'),
        '7' => trans('home.Order_status_7'),
        '8' => trans('home.Order_status_8'),
    ];
}

function order_type()
{
    return [
        '1' => trans('home.Order_type_online'),
        '2' => trans('home.Order_type_offline'),

    ];
}

function languages()
{
    return [
        '1' => trans('website.lang1'),
        '2' => trans('website.lang2'),
        '3' => trans('website.lang3'),
    ];
}

function allCourses(){

    $courses = Courses::all()->pluck('title_lang', 'id')->toArray() ;

    return $courses;
}

function allCoursesSelect($course=null){

    $courses = allCourses();
    $selectedCourses[] = null;

    if($course){
        $selectedCourses[$course->id] = $course->title_lang;
    }

    $out = '<select name="courses[]" class="form-control select2">';

    foreach($courses as $key => $value){

        if($course && $value && in_array($value, $selectedCourses)){
            $out .= '<option selected value="' . $key . '">' . $value . '</option>';
        }else{
            $out .= '<option value="' . $key . '">' . $value . '</option>';
        }
    }

    $out .= "</select>";

    return $out;
}

function allCertificatesSelect($order=null){
    $certificatesWithCourses = Certificatescontainer::all()->pluck('TitleWithCourse', 'id')->toArray();

    $selectedCertificates[] = null;
    if($order){
        foreach($order->ordersposition as $orderPosition){
            foreach($orderPosition->TypeCertificateContainer as $key => $value){
                $selectedCertificates[$key] = $value;
            }
        }
    }

    $out = '<select multiple name="certificates[]" class="form-control certificates">';

    foreach($certificatesWithCourses as $key => $value){
        if($order && $value && in_array($value, $selectedCertificates)){
            $out .= '<option selected value="' . $key . '">' . $value . '</option>';
        }else{
            $out .= '<option value="' . $key . '">' . $value . '</option>';
        }
    }

    $out .= "</select>";


    // $coursesWithCertificates = Courses::with('certificatescontainer')->get();
    // $out = '<select multiple name="certificates[]" class="form-control certificates">';

    // foreach($coursesWithCertificates as $course){

    //     $out .= '<optgroup label="' . $course->title_lang . '">';

    //     foreach($course->certificatescontainer as $certificateContainer){
    //         if($certificateContainer->certificate){
    //             $out .= '<option value="' . $certificateContainer->id . '">' . $certificateContainer->TitleWithCourse . '</option>';
    //         }

    //     }
    //     $out .= "</optgroup>";
    // }

    // $out .= "</select>";

    return $out;
}

function allEvents() {

    $empty = ['' => ''];
    $events = Events::all();

    
    return $events;

}

function allInstructors(){

    return User::where('group_id', User::TYPE_INSTRUCTOR)->get()->pluck('fullname_lang', 'id')->toArray();

}


function salesAgents(){

    $instructors = User::where('group_id', 15)->get()->pluck('email', 'id')->toArray();
    return $instructors;

}

function typesCourses()
{
    return [
        '' => '',
        '1' => trans('website.typesCourses1'),
        '2' => trans('website.typesCourses2'),
        '3' => trans('website.typesCourses3'),
        '4' => trans('website.typesCourses4'),
        '5' => trans('website.typesCourses5'),
    ];
}
function eventTypes()
{
    return [
        '1' => trans('eventsdata.Type1'),
        '2' => trans('eventsdata.Type2'),
        '3' => trans('eventsdata.Type3'),
    ];
}
function levels()
{
    return [
        '1' => trans('website.lang1'),
        '2' => trans('website.lang2'),
        '3' => trans('website.lang3'),
    ];
}

function categoriesList(){
    $categories = Categories::where('status', 1)->get()->pluck('name_lang', 'id')->toArray();

    return $categories;
}

function specialization()
{
    return [
        '' => trans('account.Select specialization'),
        'Physician' => trans('account.Physician'),
        'Pharmacist' => trans('account.Pharmacist'),
        'Vet' => trans('account.Vet'),
        'Physical therapist' => trans('account.Physical therapist'),
        'Dentist' => trans('account.Dentist'),
        'Nurse' => trans('account.Nurse'),
        'Other' => trans('account.Other')
    ];
}


function sub_specialization(){

    return [
        'Community' => trans('account.Community'),
        'Industry' => trans('account.Industry'),
        'Clinical' => trans('account.Clinical'),
        'Sales therapist' => trans('account.Sales therapist'),
        'Marketing' => trans('account.Marketing'),
        'Other' => trans('account.Other'),


    ];

}

function setting_type()
{
    return [
        'text' => trans('home.text'),
        'textarea' => trans('home.textarea'),
        'image' => trans('home.image'),
    ];

}

function type()
{
    return [
        'Main' => trans('home.main'),
        'Sub' => trans('home.sub'),
    ];
}


function menuTarget()
{
    return [
        'blank' => trans('home.blank'),
        'self' => trans('home.self'),
    ];
}


function permissionType()
{
    return [
        'on' => trans('home.on'),
        'off' => trans('home.off'),
    ];
}

function removeFromArray($orignalArray, $expectArray)
{
    return array_values(array_diff($orignalArray, $expectArray));
}

function rename_keys($array, $replacement_keys)
{
    if (count($replacement_keys) > 0) {
        return array_combine($replacement_keys, array_values($array));
    }
}


function extractJsonInfo($data)
{
    $newData = (array)json_decode($data);
    foreach ($newData as $key => $d) {
        if (is_object($d)) {
            $newData[$key] = (array)$d;
        }
    }
    return $newData;
}

function getMigrationType(){
    return [
        'string',
        'boolean',
        'char',
        'date',
        'double',
        'text',
        'mediumText',
        'longText',
        'float',
        'integer',
        'ipAddress',
        'tinyInteger'
    ];
}


function notFilter()
{
    return ['icon', 'body', 'des', 'meta', 'keywords' , 'lng' , 'lat' , 'youtube' , 'url'] + getFileFieldsName();
}


