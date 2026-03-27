<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use IlluminateHttpResponse;
use IlluminateHttpFacadesDB;
use App\http\Controllers\StudentController;
use App\Models\Student;
use App\Models\Instructor;  
use App\Models\User1; 


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newStudents = Student::with('user1')->latest()->limit(10)->get();
        $totalUsers = User1::count();
        
        return view('cms.admin.main', compact('newStudents', 'totalUsers'));}
     
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
