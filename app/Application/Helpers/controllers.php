<?php

function getControllerType(){
    return[
        'admin' => trans('admin.admin controller'),
        'website' => trans('admin.website controller')
    ];
}


function getControllerByType($type = 'admin' , $returnType = 'json'){
    $types  = getControllerType();
    if(array_key_exists($type , $types)){
        $path = app_path('Application/Controllers/'.ucfirst($type));
        $folder = Illuminate\Support\Facades\File::directories($path);
        $array = [];
        foreach($folder as $f){
            $array = $array + getControllersFromFolders($path , $type , $f);
        }
        $array= $array + getControllersFromFolders($path , $type);
        return $returnType == 'json' ? json_encode($array) : $array;
    }
    return false;
}

function executeCurl($data, $url){

    $curl = curl_init();

    $postdata = json_encode($data);
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => $postdata,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

function getControllersFromFolders($path , $type , $folder = ''){
    $folderNameSpace = $folder != '' ? getDirectoryName($folder).'\\' : $folder;
    $folderPath = $folder != '' ? getDirectoryName($folder).DS : $folder;
    $path = $folder != '' ? $folder : $path;
    $files = Illuminate\Support\Facades\File::allFiles($path);
    $slug = [];
    foreach ($files as $file){
        $className = explode(DS , $file);
        $name =  explode('.',end($className))[0];
        $nameSpace = 'App\\Application\\Controllers\\'.ucfirst($type).'\\'.$folderNameSpace.$name;
        $skipp  = $type == "admin" ? skipp("admin") : skipp("website");
        if(
            File::isFile(app_path('Application/Controllers/'.ucfirst($type).'/'.$folderPath.$file->getFileName()))
            &&
            class_exists('App\\Application\\Controllers\\'.ucfirst($type).'\\'.$folderNameSpace.$name)
            &&
            !in_array('App\\Application\\Controllers\\'.ucfirst($type).'\\'.$folderNameSpace.$name , $skipp)
        ){
            $slug[str_replace('\\' , '-' , $nameSpace)] = class_basename($nameSpace);
        }
    }
    return $slug;
}

function getMethodByController($controller , $type = 'admin' , $returnType = 'json'){
    $type = ucfirst($type);
    $controller = str_replace('-' , "\\" , $controller);
    // $controller = str_replace('App\\' , 'app\\' , $controller);
    $path = base_path(path($controller).'.php');
    // if(file_exists($path)){
        return $returnType == 'json' ? json_encode(get_this_class_methods($controller)) : get_this_class_methods($controller);
    // }
}


function get_this_class_methods($class){
    $array1 = get_class_methods($class);
    if($parent_class = get_parent_class($class)){
        $array2 = get_class_methods($parent_class);
        $array3 = array_diff($array1, $array2);
    }else{
        $array3 = $array1;
    }
    return($array3);
}

function getDirectoryName($dir){
    if(file_exists($dir)){
        $path = explode(DS , $dir);
        return end($path);
    }
    return false;
}


function  skipp($type){
    try {
        $path = app_path('Http/Middleware/CustomPermissions/'.$type.'.php');
        $content = File::getRequire($path);
        return $content;
    } catch (Illuminate\Filesystem\FileNotFoundException $exception) {
        return [];
    }
    return [];
}
