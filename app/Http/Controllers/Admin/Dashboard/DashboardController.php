<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function showAdminDashboard(Request $request){
        if(Auth::guard('admin')->check()){
            if ($request->ajax()) {
                $data = User::select('*');
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn ('status',function($row){
                            $checkedAttribute = $row->status == 1 ? 'checked' : '';
                            return 
                            '<input class="status js-switch" type="checkbox" '. $checkedAttribute .' data-id="'.$row->id.'" 
                               >';
                        })
                        ->addColumn('action', function($row){
                            $activeUser = $row->status == 1 ? 'active' : '';
                            $viewBtn = '';
                            if($activeUser == 'active') {
                                $viewBtn .= '<a href="javascript:void(0)" data-view-id="'.$row->id.'" class="btn btn-secondary viewData">';
                                $viewBtn .= '<i class="fa fa-eye"></i>';
                                $viewBtn .= '</a>';
                            }
                            $editBtn = '';
                            if($activeUser == 'active'){
                                $editBtn = '<a href="javascript:void(0)" data-edit-id="'.$row->id.'" class="btn btn-secondary editData">
                                <i class="fa fa-edit"></i></a>';
                            }
                            $deleteBtn = '';
                            if($activeUser == 'active'){
                                $deleteBtn = '<a href="javascript:void(0)" data-delete-id="'.$row->id.'" class="btn btn-secondary deleteData">
                                <i class="fa fa-trash"></i></a>';
                            }
                            return $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn;
                        })
                        ->rawColumns(['action','status'])
                        ->make(true);
            }
            return view('admin.dashboard.admin_dashboard');
        }
        return redirect()->route('admin.show.login.page');
    }

    public function changeStatus(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['message'=>'Status change successfully.']);
    }
}
