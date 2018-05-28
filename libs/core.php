<?php

function core_getData(string $name):array {
    return include DATA_PATH.$name.".php";
}

function core_saveArrayToFile(string $name, array $arr):void{
    $jstr = json_encode($arr);
    $path = STORAGE_PATH."{$name}.json";
    file_put_contents($path,$jstr);
};

function core_loadArrayFromFile(string $name):array {
    $path = STORAGE_PATH."{$name}.json";
    if(!file_exists($path))return[];
    $data = file_get_contents($path);
    return json_decode($data,true);
};

function core_appendToArrayInFile(string $name, $data):void{
    $arr = core_loadArrayFromFile($name);
    $arr[] = $data;
    core_saveArrayToFile($name,$arr);
};

function core_removeFromArrayInFile(string $name, int $index):void{
    $arr = core_loadArrayFromFile($name);
    array_splice($arr,$index);
    core_saveArrayToFile($name,$arr);
};

function _core_render_view($view,$data){
    ob_start();
    extract($data);
    include $view.".php";
    return ob_get_clean();
}

function core_render_view($view,$data=[]){
    return _core_render_view(VIEWS_PATH.$view,$data);
}
function core_render_template($template,$data=[]){
    return _core_render_view(TEMPLATES_PATH.$template,$data);
}


function core_render(string $view, array $data=[], string $templates="default"):string {
    $data["content"] = core_render_view($view,$data);
    return core_render_template($templates,$data);
}


function core_loadModel(string $name):void{
  include MODELS_PATH.$name.".php";
}

function is_empty():bool {
    foreach (func_get_args() as $arg) if(empty($arg)) return true;
    return false;
}

function core_navigate():void{
    $routes = core_getData("routes");
    $url = trim(explode("?",$_SERVER["REQUEST_URI"])[0],"/");
    foreach ($routes as $route=>$command){
        if (trim($route,"/")==$url){
            $cmd = explode("@",$command);
            $controller_name = "controller_".$cmd[0];
            $action_name = "action_".$cmd[1];
            if(!file_exists(CONTROLLERS_PATH.$controller_name.".php")) break;
            include_once CONTROLLERS_PATH.$controller_name.".php";
            if(!function_exists($action_name)) break;
            echo call_user_func($action_name);
            return;
        }
    }
    echo "404";
}