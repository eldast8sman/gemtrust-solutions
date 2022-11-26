<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index(){
        $sections = Section::orderBy('section', 'asc');
        if($sections->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Sections fetched successfully',
                'data' => $sections->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Article was fetched'
            ], 404);
        }
    }

    public function store(Request $request){
        if($section = Section::create($request->all())){
            return response([
                'status' => 'success',
                'message' => 'Section added successfully',
                'data' => $section
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Could not create Section properly'
            ], 500);
        }
    }

    public function show($id){
        $section = Section::find($id);
        if(!empty($section)){
            return response([
                'status' => 'success',
                'message' => 'Section fetched successfully',
                'data' => $section
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Section was fetched'
            ], 404);
        }
    }

    public function update(Request $request, $id){
        $section  = Section::find($id);
        if(!empty($section)){
            if($section->update($request->all())){
                return response([
                    'status' => 'success',
                    'message' => 'Section updated successfully',
                    'data' => $section
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Section was not updated'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Section was fetched'
            ], 404);
        }
    }

    public function destroy($id){
        $section = Section::find($id);
        if(!empty($section)){
            $section->delete();

            return response([
                'status' => 'failed',
                'message' => 'Section successfully deleted',
                'data' => $section
            ], 404);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Section was fetched'
            ], 404);
        }
    }
}
