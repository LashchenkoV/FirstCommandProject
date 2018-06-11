<?php

    function get_contentNoStartConsult(){
        return core_render_view("contentNoStartConsult");
    }
    function get_contentStartConsult(){
        core_loadModel("admin_student");
        $data = ["students"=>student_getListForTable()];
        return core_render_view("contentStartConsult",$data);
    }