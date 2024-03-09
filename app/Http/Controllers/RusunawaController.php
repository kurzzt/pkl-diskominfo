<?php

namespace App\Http\Controllers;

use App\Models\Rusunawa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RusunawaController extends Controller
{
    public function index(){
        $rusunawas = Rusunawa::all();
        return view('admin.rusunawas.list', ['rusunawas' => $rusunawas]);
    }

    public function create(){
        return view('admin.rusunawas.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'subname' => 'required|string',
            'lantai' => ['required', Rule::in(['I', 'II', 'III', 'IV', 'V'])],
            'tipe' => 'required|integer',
            'fare' => 'required|integer',
            'unit' => ['required', Rule::in(['day', 'year', 'month'])],
        ]);

        $newRusun = Rusunawa::create($data);
        return redirect(route('rusunawas.index'));
    }

    public function show(Rusunawa $rusunawa){
        return view('admin.rusunawas.show', ['rusunawa' => $rusunawa]);
    }

    public function edit(Rusunawa $rusunawa){
        return view('admin.rusunawas.edit', ['rusunawa' => $rusunawa]);
    }

    public function update(Rusunawa $rusunawa, Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'subname' => 'required|string',
            'lantai' => ['required', Rule::in(['I', 'II', 'III', 'IV', 'V'])],
            'tipe' => 'required|integer',
            'fare' => 'required|integer',
            'unit' => ['required', Rule::in(['day', 'year', 'month'])],
        ]);
        $rusunawa->update($data);
        return redirect(route('rusunawas.index'))->with('success', 'Rusunawa Updated Succesffully');
    }

    public function destroy(Rusunawa $rusunawa){
        $rusunawa->delete();
        return redirect(route('rusunawas.index'))->with('success', 'Rusunawa deleted Succesffully');
    }
}