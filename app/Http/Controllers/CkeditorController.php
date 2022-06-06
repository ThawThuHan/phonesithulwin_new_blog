<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store("post_images");

            $json = [];
            if ($path) {
                $url = asset('storage/' . $path);
                $json['uploaded'] = true;
                $json['url'] = $url;
                @header('Content-type: text/html; charset=utf-8');
                echo json_encode($json);
            } else {
                $json["uploaded"] = false;
                $json["error"] = array("message" => "Error Uploaded");
                echo json_encode($json);
            }
        }
    }
}
