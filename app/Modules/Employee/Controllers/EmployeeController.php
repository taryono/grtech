<?php

namespace App\Modules\Employee\Controllers;

use App\Models\Employee as employee;
use App\Models\Company as company;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController; 
use DataTables;
       
class EmployeeController extends MainController
{
    public function __construct() { 
        parent::__construct(new employee(), 'Employee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = employee::select('*');
            return Datatables::of($employees)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<div class="justify-content-between"><a href="'.(route('employee.edit',$row->id)).'" class="edit btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit" data-title="'.($row->full_name()).'">Edit</a>';
                           $btn .= '&nbsp;<a href="'.(route('employee.destroy',$row->id)).'" class="delete btn btn-danger btn-sm" data-title="'.($row->full_name()).'">Delete</a></div>';
       
                            return $btn;
                    })
                    ->addColumn('company', function($row){ 
                        $link = '<a href="'.(route('employee.show_company',$row->company_id)).'" class="detail" data-toggle="modal" data-target="#modal-detail" data-title="'.(isset($row->company)?$row->company->name:"Noname").'">'.(isset($row->company)?$row->company->name:"Noname").'</a>';
                        return $link;
                    })
                    ->addColumn('full_name', function($row){ 
                        return $row->full_name();
                    }) 
                    ->rawColumns(['action','company'])
                    ->make(true);
        }
        
        return view('Employee::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show_company($company_id)
    {   $company = company::find($company_id);
        return view('Employee::show_company', ['company'=> $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($employee_id)
    {
        $employee = employee::find($employee_id);
        return view('Employee::edit', ['employee'=> $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employee_id)
    { 
        try {
            $employee = employee::find($employee_id);
            if($employee){
                $employee->update([
                    'first_name'=> $request->first_name,
                    'last_name'=> $request->last_name,
                    'email'=> $request->email,
                    'phone'=> $request->phone, 
                    'company_id'=> $request->company_id, 
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json(['status'=> 'failed', 'message'=> 'Update Data Error '.$e->message()]);
        }
        return response()->json(['status'=> 'success', 'message'=> 'Data Was Updated.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {
        try {
            $employee = employee::find($employee_id);
            if($employee){
                $employee->delete(); 
            }
        } catch (\Throwable $e) {
            return response()->json(['status'=> 'failed', 'message'=> 'Data Error '.$e->message()]);
        }
        return response()->json(['status'=> 'success', 'message'=> 'Data Was Deleted.']);
    }
}
