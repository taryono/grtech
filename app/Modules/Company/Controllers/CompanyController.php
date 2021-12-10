<?php

namespace App\Modules\Company\Controllers;

use App\Models\Company as company;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use DataTables;
       
class CompanyController extends MainController
{
    public function __construct() { 
        parent::__construct(new company(), 'Company');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $companies = company::select('*');
            return Datatables::of($companies)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div class="justify-content-between"><a href="'.(route('company.edit',$row->id)).'" class="edit btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit" data-title="'.($row->name).'">Edit</a>';
                        $btn .= '&nbsp;<a href="'.(route('company.destroy',$row->id)).'" class="delete btn btn-danger btn-sm" data-title="'.($row->name).'">Delete</a></div>';
    
                         return $btn;
                    })
                    ->addColumn('logo', function($row){
     
                        $logo = '<img src="'.($row->logo?$row->logo:(asset('assets/images/company.png'))).'" class="img-responsive image-logo" data-title="'.($row->name).'" width="100px">';
                         return $logo;
                    })
                    ->rawColumns(['action','logo'])
                    ->make(true);
        }
        return view('Company::index');
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id)
    {
        $company = company::find($company_id);
        return view('Company::edit', ['company'=> $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company_id)
    {
        $company = company::find($company_id);
        if($company){
            $company->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'website'=> $request->website, 
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
