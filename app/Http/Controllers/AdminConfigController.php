<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class AdminConfigController extends Controller
{
    public function index()
    {
        $configs = Config::all();
        return view('admin.configs.index', compact('configs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:configs',
            'type' => 'required|in:string,upload',
            'value' => 'nullable',
            'is_active' => 'nullable|string'
        ]);

        $config = new Config();
        $config->key = $request->key;
        $config->type = $request->type;

        if ($request->type == 'string') {
            $config->value = $request->value_string;
        } else {
            $config->value = $request->file('value_upload')->hashName();
            $request->file('value_upload')->storeAs('public/configs/', $config->value);
        }

        $config->is_active = $request->is_active == 'true' ? 1 : 0;

        if ($config->save()) {
            return to_route('admin.configs')->with('success', 'Config berhasil ditambahkan.');
        } else {
            return to_route('admin.configs')->with('error', 'Gagal menambahkan Config.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'key' => 'required|unique:configs,key,' . $id,
            'type' => 'required|in:string,upload',
            'value' => 'nullable',
            'is_active' => 'nullable|string'
        ]);

        $config = Config::find($id);
        $config->key = $request->key;
        $config->type = $request->type;

        if ($request->type == 'string') {
            $config->value = $request->value_string;
        } else {
            $config->value = $request->file('value_upload')->hashName();
            $request->file('value_upload')->storeAs('public/configs/', $config->value);
        }

        $config->is_active = $request->is_active ? 1 : 0;

        if ($config->save()) {
            return to_route('admin.configs')->with('success', 'Config berhasil diperbarui.');
        } else {
            return to_route('admin.configs')->with('error', 'Gagal memperbarui config.');
        }
    }

    public function destroy($id)
    {
        $config = Config::find($id);
        if ($config->delete()) {
            return to_route('admin.configs')->with('success', 'Config berhasil dihapus.');
        } else {
            return to_route('admin.configs')->with('error', 'Gagal menghapus config.');
        }
    }
}
