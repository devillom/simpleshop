<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use App\Http\Requests\PhotoUploadRequest;
use App\Http\Requests\PhotoDeleteRequest;

class PhotoController extends Controller
{
    public function upload(PhotoUploadRequest $request)
    {
        $user =  Auth::user();

        $destinationPath = 'uploads/';
        if ($request->hasFile('files')) {
            $photos = new Collection();
            $i = 0;
            foreach($request->file('files') as $file){
                $extension = $file->getClientOriginalExtension();
                $new_filename = time().uniqid().str_random(rand(5,15)).'.'.$extension;

                $file->move($destinationPath,$new_filename);

                $photos[$i] = new Photo();
                $photos[$i]->content_type = $file->getClientMimeType();
                $photos[$i]->disk_name =  $new_filename;
                $photos[$i]->file_name = $file->getClientOriginalName();
                $photos[$i]->path = $destinationPath.$new_filename;
                $photos[$i]->file_size = $file->getClientSize();
                $photos[$i]->user_id = $user->id;
                $photos[$i]->save();
                $i++;
            }

            return $photos->first();

        }
        return response()->json(['status'=>'error']);
    }

    public function delete(PhotoDeleteRequest $request)
    {
        if(!$request->has('filename')) return;
        $photo = Photo::where('disk_name',$request->get('filename'))->first();
        
        if(Auth::user()->hasRole('admin')) {
            $this->deleteFile($photo);
        }else if($photo->user_id == Auth::user()->id){
            $this->deleteFile($photo);
        }
        return response()->json(['status','ok']);
    }

    public function deleteFile(Photo $photo)
    {
        @unlink(public_path().$photo->path);
        $photo->delete();
    }
}
