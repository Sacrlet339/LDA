<?php

namespace App\Http\Controllers;
use App\Models\company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends Controller
{
    public function index(){
        //get all companies that not been deleted and present them to view
        $companies = company::get();
        return view('companies', compact('companies'));
    }
    public function store(Request $req){
        // dd($req->all());
        $validated = Validator::make($req->all(), [
            'name' => 'required|unique:companies',
            'email' => 'required|max:100',
            'tel' => 'min:10|max:12',
        ]);
        if ($validated->fails()) {
            return redirect()->back()
            ->withErrors($validated)
            ->withInput();
        }
        $company = new company();
        $company->name = $req->post('name');
        $company->email = $req->post('email');
        $company->tel = $req->post('tel');
        $company->save();

        return redirect()->back()->with('success','Action Successful');
    }
    public function update(Request $req){
        dd($req->all());
    }
    public function delete(Request $req){
        dd($req->all());
    }
}
