<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
    	return view('welcome');
    }

    public function upload(Request $request)
    {

    	if($request->hasFile('upload'))
        {
    		$function_number = $request->CKEditorFuncNum;
            $filenameWithExt = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('upload')->storeAs('public/uploads', $fileNameToStore);
            $path = url('/')."/".str_replace("public/", "storage/", $path);
            $message = '';
  			echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$path', '$message');</script>"; 
        }
    }
    
}
