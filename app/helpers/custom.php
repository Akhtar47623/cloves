<?php

use App\imagetable;
use App\model\Config;
use App\model\Blog;
use App\model\ViewersIp;

function getImage($image = 'logo') {
    return imagetable::where('table_name', $image)->first()->img_path;
}
function footerImage($image = 'logo2'){
    return imagetable::where('table_name', $image)->first()->img_path;
}

function returnFlag($id=false) {
    return Config::findorFail($id)->flag_value;
}
function footerblogs($fblog ='blog') {
    return Blog::where('tag',$fblog)->limit(2)->get();
}
