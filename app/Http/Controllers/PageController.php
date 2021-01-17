<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DownloadFileRequest;


class PageController extends Controller
{
    function __construct()
    {
        $this->middleware('pbweb.token')->only('download');
        $this->middleware('pbweb.downloadfile')->only('download');
    }

    function Home()
    {
        return view('home',['token' =>'123456']);
    }

    function pb(Request $request)
    {
        $level = 54;
        $version = $request->input('version');

        return view('pb', [
            'ver' => $version,
            'level' => $level
        ]);
    }

    function download($id,DownloadFileRequest $request)
    {
    // $fileName = "$id.jpg";可以在DownloadFileRequest使用 $id = $this->route('id'); 得到傳入的ID
        return $request->downloadFile($id);
    }
}
