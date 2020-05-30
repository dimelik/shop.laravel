<?php

namespace App\Http\Controllers;

use Artisan;
use Illuminate\Http\Request;
use Storage;

class ResetController extends Controller
{
    public function reset(){
        Artisan::call('migrate:fresh --seed');

        foreach (['categories', 'products'] as $folder){
            Storage::deleteDirectory($folder);
            Storage::makeDirectory($folder);

            $files = Storage::disk('reset')->files($folder);
            foreach ($files as $file){
                Storage::put($file, Storage::disk('reset')->get($file));
            }
        }

        session()->flash('success', 'reset OK');
        return redirect()->route('index');
    //    dd(1);
    }
}
