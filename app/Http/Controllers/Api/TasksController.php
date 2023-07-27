<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    //
    public function index (){

        $tasks = Task::all();

        if($tasks->count() > 0){
            return response()->json([
                'status' => 200,
                'tasks' => $tasks,
            ], 200);
        } else{
            return response()->json([
                'status' => 404,
                'message' => 'no records found',
            ], 404);
        }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'description' => 'required',
            'status' => 'required|string|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }else{
            $task= Task::Create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            if($task){
                return response()->json([
                    'status' => 200,
                    'message' => 'Task Created Successfully',
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Error Creating Task',
                ],500);
            }
        }
    }

    public function show($id){
        $task = Task::find($id);
        if($task){
            return response()->json([
                'status' => 200,
                'task' => $task,
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Task Not Found',
            ],404);
        }
    }

    public function edit($id){
        $task = Task::find($id);
        if($task){
            return response()->json([
                'status' => 200,
                'task' => $task,
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Task Not Found',
            ],404);
        }
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'description' => 'required',
            'status' => 'required|string|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }else{
            $task = Task::find($id);


            if($task){

                $task->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->status,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Task updated Successfully',
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'TAsk not found',
                ],404);
            }
        }
    }

    public function delete($id){
        $task = Task::find($id);

        if($task){

            $task->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Task deleted Successfully',
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Task not found',
            ],404);
        }
    }

}
