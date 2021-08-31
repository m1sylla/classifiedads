<?php

namespace App\Http\Controllers\Admin;

use App\Admin as Admin;
use App\VerifierAdmin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

//use App\Mail\ConfirmAdminEmail as ConfirmAdminEmail;
//use Illuminate\Support\Facades\Mail;

use App\Events\NewAdminRegisteredEvent;

class ManageAdminController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('super.admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return View('admin.admin.admin_list')->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$admins = Auth::guard('admin')->user();
        return view('admin.admin.admin_create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:comptes',
            'level' => 'required|Integer',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'level' => $request['level'],
            'password' => Hash::make($request['password']),
        ]);

        $data = VerifierAdmin::create([
            'admin_id' => $admin->id,
            'token' => sha1(time())
        ]);

        // send confirmation link
        event(new NewAdminRegisteredEvent($admin, $data));
        //Mail::to($admin->email)->queue(new ConfirmAdminEmail($admin,$verifyAdmin));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin.admin_edit')->with('admin', $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:comptes',
            'level' => 'required|Integer',
        ]);

        Admin::where('id',$id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'level' => $request['level'],
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        
        return redirect()->back();
    }
}
