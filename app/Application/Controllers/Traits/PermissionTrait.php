<?php

namespace App\Application\Controllers\Traits;

trait PermissionTrait {

    protected function saveRolePermission($array , $item = null ,  $id = null){

        $addPermission = $item != null ? $item  : $this->model->find($id);


         //dd($this->model);

        if(method_exists( $this->model ,'role') && class_basename($this->model) != 'Permission'){
            $roles = array_has($array , 'roles') ?  $array['roles'] : [];
            $this->saveRoles($roles , $addPermission);
        }
        if(method_exists( $this->model ,'permission')) {
            $permission = array_has($array , 'permission') ?  $array['permission'] : [];
            $this->savePermission($permission, $addPermission);
        }
        if(method_exists( $this->model ,'coursesincluded')) {
            $courses = array_has($array , 'coursesincluded') ?  $array['coursesincluded'] : [];
            $this->saveCourses($courses, $addPermission);
        }
        if(method_exists( $this->model ,'promotioncoursesincluded')) {
            $promotions = array_has($array , 'promotioncoursesincluded') ?  $array['promotioncoursesincluded'] : [];
            $this->savePromotioncourses($promotions, $addPermission);
        }
        if(method_exists( $this->model ,'promotioneventsincluded')) {
            $promotions = array_has($array , 'promotioneventsincluded') ?  $array['promotioneventsincluded'] : [];
            $this->savePromotionevents($promotions, $addPermission);
        }
        if(method_exists( $this->model ,'usersCoursesEnrollments')) {
            $Courses = array_has($array , 'usersCoursesEnrollments') ?  $array['usersCoursesEnrollments'] : [];
            $this->saveUsersCoursesEnrollments($Courses, $addPermission);
        }

        if(method_exists( $this->model ,'businessgroupscourses')) {
            $Courses = array_has($array , 'businessgroupscourses') ?  $array['businessgroupscourses'] : [];
            $this->saveBusinessGroupsCourses($Courses, $addPermission);
        }

        if(method_exists( $this->model ,'courserelated')) {
            $Courses = array_has($array , 'courserelated') ?  $array['courserelated'] : [];
            $this->saveRelatedCourses($Courses, $addPermission);
        }

        if(method_exists( $this->model ,'talksrelated')) {
            $Talks = array_has($array , 'talksrelated') ?  $array['talksrelated'] : [];
            $this->saveRelatedTalks($Talks, $addPermission);
        }

        if(method_exists( $this->model ,'coursesrelatedevents')) {
            $Courses = array_has($array , 'coursesrelatedevents') ?  $array['coursesrelatedevents'] : [];
            $this->saveCoursesRelatedEvents($Courses, $addPermission);
        }

        if(method_exists( $this->model ,'certificatesrelatedcourses')) {
            $Courses = array_has($array , 'certificatesrelatedcourses') ?  $array['certificatesrelatedcourses'] : [];
            $this->saveCertificatesContainer($Courses, $addPermission);
        }
    }

    public function saveRoles($array , $item){
        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->role()->sync($request);
        }
        return $item->role()->sync([]);
    }

    public function savePermission($array , $item){
        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->permission()->sync($request);
        }
        return $item->permission()->sync([]);
    }

    public function saveCourses($array , $item){

        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->coursesincluded()->sync($request);
        }
        return $item->coursesincluded()->sync([]);
    }

    public function savePromotioncourses($array , $item){

        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->promotioncoursesincluded()->sync($request);
        }
        return $item->promotioncoursesincluded()->sync([]);
    }

    public function savePromotionevents($array , $item){

        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->promotioneventsincluded()->sync($request);
        }
        return $item->promotioneventsincluded()->sync([]);
    }

    public function saveBusinessGroupsCourses($array , $item){
        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->businessgroupscourses()->sync($request);
        }
        return $item->businessgroupscourses()->sync([]);
    }

    public function saveUsersCoursesEnrollments($array , $item){

        if(count($array) > 0){
            $request = $this->checkIfArray($array);


            $currentCourses = $item->usersCoursesEnrollments->pluck('id')->toarray();
            
            $newCourses = $request;


            $differenceArray = array_diff($newCourses, $currentCourses);

            if(count($differenceArray) < 1){
                return;
            }

            // dd($currentCourses);


            return $item->usersCoursesEnrollments()->sync($request);
        }
        return $item->usersCoursesEnrollments()->sync([]);
    }

    public function saveRelatedCourses($array, $item) {
        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->courserelatedsync()->sync($request);
        }
        return $item->courserelatedsync()->sync([]);
    }

    public function saveRelatedTalks($array, $item) {
        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->talksrelatedsync()->sync($request);
        }
        return $item->talksrelatedsync()->sync([]);
    }
    
    public function saveCoursesRelatedEvents($array, $item) {
        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->coursesrelatedevents()->sync($request);
        }
        return $item->coursesrelatedevents()->sync([]);
    }

    public function saveCertificatesContainer($array, $item) {
        if(count($array) > 0){
            $request = $this->checkIfArray($array);
            return $item->certificatesrelatedcourses()->sync($request);
        }
        return $item->certificatesrelatedcourses()->sync([]);
    }
}