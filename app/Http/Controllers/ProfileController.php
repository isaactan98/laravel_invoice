<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        $user = auth()->user();

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'website',
                'bankName',
                'bankAcc',
            ]);
            $user->name = $request['name'];
            $user->phone = $request['phone'];
            $user->website = $request['website'];
            $user->bankName = $request['bankName'];
            $user->bankAcc = $request['bankAcc'];
            if ($user->update()) {
                Session::flash('success_msg', 'Profile Updated Successfully');
            } else {
                Session::flash('error_msg', 'Profile Not Update');
            }
            return redirect()->route('profile');
        }

        return view('profile.view', [
            'user' => $user
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $users = auth()->user();
        return view('profile.update', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = \App\Models\User::current();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'phone' => 'required',
            'website',
            'bankName',
            'bankAcc',
        ]);
        $user->name = $request['name'];
        $user->phone = $request['phone'];
        $user->website = $request['website'];
        $user->bankName = $request['bankName'];
        $user->bankAcc = $request['bankAcc'];
        if ($user->update())
            // return redirect()->route('profile')->with('success', 'Profile Updated Successfully');
            return redirect()->route('profile');
        else
            // return redirect()->route('profile')->with('warning', 'Profile Not Update');
            return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
