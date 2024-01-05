<?php

namespace App\Http\Controllers\Admin\TaskList;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskListRequest;
use App\Models\TaskList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TaskListController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::guard('admin')->check() || Auth::guard('user')->check()){
            if ($request->ajax()) {
                $data = Auth::guard('admin')->check() ? TaskList::select('*') : TaskList::where('user_id',Auth::guard('user')->id());
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn ('is_active',function($row){
                            $checkedAttribute = $row->is_active == '1' ? 'checked' : '';
                            return 
                            '<input class="is_active js-switch" type="checkbox" '. $checkedAttribute .' data-id="'.$row->id.'" 
                               >';
                        })
                        ->filter(function ($instance) use ($request) {
                            if ($request->get('status') == 'new' || $request->get('status') == 'incomplete' || $request->get('status') == 'complete') {
                                $instance->where('status', $request->get('status'));
                            }
                        })
                        // ->editColumn('start_date', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->start_date)->format('d-m-Y'); 
                        //     return $formatedDate; })
                        // ->editColumn('end_date', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->start_date)->format('d-m-Y'); 
                        //     return $formatedDate; })
                        ->addColumn('action', function($row){
                            $activeUser = $row->is_active == '1' ? 'active' : '';
                            $viewBtn = '';
                            if($activeUser == 'active') {
                                $viewBtn .= '<a href="javascript:void(0)" data-view-id="'.$row->id.'" class="btn btn-warning viewData">';
                                $viewBtn .= '<i class="fa fa-eye"></i>';
                                $viewBtn .= '</a>';
                            }
                            $editBtn = '';
                            if($activeUser == 'active'){
                                $editBtn = '<a href="' . route('tasklist.edit',$row->id) . '" class="btn btn-primary editData">
                                <i class="fa fa-edit"></i></a>';
                            }
                            $deleteBtn = '';
                            if($activeUser == 'active'){
                                $deleteBtn = '<a href="javascript:void(0)" data-delete-id="'.$row->id.'" class="btn btn-danger deleteData">
                                <i class="fa fa-trash"></i></a>';
                            }
                            return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                        })
                        ->rawColumns(['action','is_active'])
                        ->make(true);
            }
            return view('admin.tasklist.index');
        }
        return redirect()->route('admin.show.login.page');
    }

    public function create()
    {
        return view('admin.tasklist.create');
    }

    public function store(TaskListRequest $request)
    {
        try {
            $taskList = TaskList::create([
                'user_id' => Auth::guard('user')->id(),
                'subject' => $request->subject,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'priority' => $request->priority,
                'is_active' => '1'
            ]);

            return redirect()->route('tasklist.index')->with('success','Task Created Successfully !!');

        } catch (\Throwable $e) {
            return back()->with('error','Something Went Wrong !!');
        }
    }

    public function show($id){
        try {
            $taskList = TaskList::findTask($id)->first();
            $taskData = array(
                'data' => $taskList,
                'startDate' => Carbon::createFromFormat('Y-m-d H:i:s', $taskList->start_date)->format('d-m-Y'),
                'endDate' => Carbon::createFromFormat('Y-m-d H:i:s', $taskList->end_date)->format('d-m-Y'),
            );
            $html = View('admin.tasklist.show', $taskData)->render();
            return response()->json([
                'success' => true,
                'html' => $html,
                'message' => 'See User Detail'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => true,
                'message' => 'Something Went Wrong'
            ], 200);
        }
    }

    public function edit($id){
        try {
            $taskList = TaskList::findTask($id)->first();
            return view('admin.tasklist.edit',compact('taskList'));
        } catch (\Throwable $e) {
            return back()->with('error','Something Went Wrong !!');
        }
    }

    public function update(TaskListRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $taskList = TaskList::find($request->id);
            $taskList->update($validatedData);

            return redirect()->route('tasklist.index')->with('success','Task Updated Successfully !!');

        } catch (\Throwable $e) {
            return back()->with('error','Something Went Wrong !!');
        }
    }

    public function delete($id){
        try {
            $taskList = TaskList::findTask($id)->delete();
            return response()->json([
                'success' => true,
                'message' => "Task Deleted Successfullly !!"
            ],200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => "Something Went Wrong !!"
            ],200);
        }
    }

    public function changeStatus(Request $request){
        $taskList = TaskList::find($request->user_id);
        $taskList->is_active = $request->is_active;
        $taskList->save();
  
        return response()->json(['message'=>'Status change successfully.']);
    }
}
