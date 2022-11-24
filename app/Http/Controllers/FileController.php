<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Upload file
     * 
     * @param UploadedFile $filepath
     * 
     * @return $filepaths
     */
    public static function uploadFile($filepath, $controller="", $disk='local'){
        if($filepath instanceof UploadedFile){
            $time = time();
            $filename = Str::random().$time;
            $extension = $filepath->extension();
            $name = $filename.'.'.$extension;
            if(($extension == "jpg") || ($extension == "jpeg") || ($extension == "gif") || ($extension == "png")){
                if($stored = Storage::disk($disk)->putFileAs('img', $filepath, $name)){
                    $filepaths = [];
                    $image = UploadFile::create([
                        'filename' => $filename,
                        'extension' => $extension,
                        'disk' => $disk,
                        'controller' => $controller,
                        'size' => Storage::disk($disk)->size($stored),
                        'filepath' => $stored,
                        'url' => Storage::disk($disk)->url($stored)
                    ]);

                    $filepaths['image'] = $image->id;

                    $image = Image::make($filepath)->resize(100, null, function($constraint){
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->encode($extension, 50);

                    if($compressed = Storage::putFileAs('img/compressed', $filepath, $name)){
                        $comp_image = UploadFile::create([
                            'filename' => $filename,
                            'extension' => $extension,
                            'disk' => $disk,
                            'controller' => $controller,
                            'size' => Storage::disk($disk)->size($compressed),
                            'filepath' => $compressed,
                            'url' => Storage::disk($disk)->url($compressed)
                        ]);

                        $filepaths['compressed'] = $comp_image->id;
                    }

                    return $filepaths;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public static function check_file($id){
        $file = UploadFile::find($id);
        if(!empty($file)){
            if(Storage::disk($file->disk)->exists($file->filepath)){
                return $file;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function delete_file($id){
        if($file = self::check_file($id)){
            if(Storage::disk($file->disk)->delete($file->filepath)){
                return $file;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
