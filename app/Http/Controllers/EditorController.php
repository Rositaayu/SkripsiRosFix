<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Editor::with('user')->latest()->get();

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }

        return view('pages.editor.index');
    }

    public function create()
    {
        return view('pages.editor.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:user,email'],
            'password' => ['required'],
            'alamat' => 'required',
            'no_hp' => ['required', 'unique:super_editor,no_hp', 'numeric', 'digits_between:10,12'],
            'kuota' => ['required', 'numeric'],
            'is_active' => ['required', 'in:0,1'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'editor',
            'is_active' => $request->is_active
        ]);

        Editor::create([
            'id_user' => $user->id_user,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('editor')->with('success', 'Editor created successfully.');
    }

    public function edit($id)
    {
        $data = Editor::with('user')->findOrFail($id);

        return view('pages.editor.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Editor::with('user')->findOrFail($id);

        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'alamat' => 'required',
            'no_hp' => ['required', 'unique:editor,no_hp,' . $id . ',id_editor', 'numeric', 'digits_between:10,12'],
            'kuota' => ['required', 'numeric'],
            'is_active' => ['required', 'in:0,1'],
        ];

        if ($request->email != $data->user->email) {
            $rules['email'] = ['required', 'email', 'unique:user,email,' . $id . ',id_user'];
        }

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data->update([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'kuota' => $request->kuota
        ]);

        $user = User::findOrFail($data->id_user);
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $data->user->password,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('editor')->with('success', 'Editor updated successfully.');
    }
}
