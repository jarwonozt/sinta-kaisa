<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::all();
        $code = Code::first()->code;
        return view('pegawai.pegawai', compact('employees', 'code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = IdGenerator::generate(['table' => 'users', 'field' => 'kode_pegawai', 'length' => '6', 'prefix' => 'PG-']);
        return view('pegawai.add', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_pegawai' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            'imagex' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ]);

        if($request->imagex != null){
            $imageName = time().'.'.$request->imagex->getClientOriginalExtension();
            // $request->imagex->storeAs('images', $imageName);
            $request->imagex->move('image',$imageName);
        }

        if($validatedData){
            User::create(
                [
                'kode_pegawai' => $request->kode_pegawai,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'image' => $imageName ?? null,
                ]
            );
            Alert::success('Success', 'Data user berhasil ditambahkan');
            return redirect('/pegawai');
        } else {
            Alert::error('Error', 'Data user gagal ditambahkan');
            return redirect()->back();
        }
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
    public function edit($id)
    {
        $employee = User::where('id', $id)->first();
        return view('pegawai.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd(Rule::unique('users')->ignore($request->id));
        $validatedData = $request->validate([
            'kode_pegawai' => ['required', Rule::unique('users')->ignore($request->id)],
            'username' => ['required', Rule::unique('users')->ignore($request->id)],
            'role' => 'required',
            'imagex' => 'image|mimes:jpeg,png,gif|max:2048',
        ]);

        if($request->imagex != null){
            $imageName = time().'.'.$request->imagex->getClientOriginalExtension();
            // $request->imagex->storeAs('images', $imageName);
            $request->imagex->move('image',$imageName);
        }

        if ($validatedData) {
            User::where('id', $id)->update([
                'kode_pegawai' => $request->kode_pegawai,
                'username' => $request->username,
                'role' => $request->role,
                'image' => $imageName ?? auth()->user()->image,
            ]);
            Alert::success('Success', 'Data berhasil diupdate');
            return redirect('/pegawai');
        } else {
            Alert::error('Error', 'Data gagal diupdate');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
