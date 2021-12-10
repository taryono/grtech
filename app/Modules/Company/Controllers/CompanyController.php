<?php

namespace App\Modules\Company\Controllers;

use App\Models\Company as company;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use DataTables;
use Lib\File;
use App\Notifications\CompanyCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
       
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
     
                        $logo = '<img src="'.($row->logo?asset('logo/'.$row->logo):(asset('assets/images/company.png'))).'" class="img-responsive image-logo" data-title="'.($row->name).'" width="100px">';
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
        return view('Company::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:companies',
                'name' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['status'=> 'failed', 'message'=> 'Input not Valid.']);
            }
            $company = new company();
            $company = $company->create($this->serialize($request->input(), new company())); 
            if ($request->file('logo')) {                
                $this->validate($request, [
                    'name' => 'required',
                    'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]); 
                
                if ($request->file('logo')->isValid()) {
                    $file = $request->file('logo');
                    // image upload in storage/app/app/public/logo   
                    $info = File::storeLocalFile($file, File::createLocalDirectory(storage_path('app/public/logo')));
                    if($company->logo && file_exists(storage_path('app/public/logo/'.$company->logo))){
                        unlink(storage_path('app/public/logo/'.$company->logo));
                    }
                    $company->logo = $info->getFilename(); 
                    $company->save();
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Image not allowed to upload.'], 200);
                }
            }
            $company->notify(new CompanyCreated());
            //Notification::send($company, new CompanyCreated());
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Image upload error => '. $e->getMessage()], 200); 
        }
        return response()->json(['status' => 'success', 'message' => 'Data Successfully Added.'], 200); 
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
        try {
            $company = company::find($company_id);
            if($company){ 
                $company->update($this->serialize($request->input(), $this->model));
                 
                if ($request->file('logo')) {                
                    $this->validate($request, [
                        'name' => 'required',
                        'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]); 
                    if ($request->file('logo')->isValid()) {
                        $file = $request->file('logo');
                        // image upload in storage/app/app/public/logo   
                        $info = File::storeLocalFile($file, File::createLocalDirectory(storage_path('app/public/logo')));
                        if($company->logo && file_exists(storage_path('app/public/logo/'.$company->logo))){
                            unlink(storage_path('app/public/logo/'.$company->logo));
                        }
                        $company->logo = $info->getFilename(); 
                        $company->save();
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Image not allowed to upload.'], 200);
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Image upload error => '. $e->getMessage()], 200); 
        }
        return response()->json(['status' => 'success', 'message' => 'Data was updated.'], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id)
    {
        try {
            $company = $this->model->find($company_id);
            if($company){
                $company->delete(); 
            }
        } catch (\Throwable $e) {
            return response()->json(['status'=> 'failed', 'message'=> 'Data Error '.$e->getMessage()], 200);
        }
        return response()->json(['status'=> 'success', 'message'=> 'Data Was Deleted.'], 200);
    }
}
