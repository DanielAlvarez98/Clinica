<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{

    public function index()
    {
        $medicines = Medicine::all();
        return view('medicine.index', ['medicines' => $medicines]);
    }

    public function checkMedicine(Request $request)
    {
        $product = $request->input('product');
        $valueProduct = Medicine::where('product', $product)->exists();
        return response()->json(['valueProduct' => $valueProduct]);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        Medicine::create($input);
        return redirect()->route('medicine.index')->with('flash_message', 'Addedd!');
    }

    public function editAjax(Medicine $medicine)
    {
        return response()->json($medicine);
    }

    public function update(Request $request, Medicine $medicine)
    {
        $input = $request->all();
        $medicine->update($input);
        return redirect()->route('medicine.index')->with('flash_message', 'Update!');
    }
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicine.index')->with('flash_message', 'deleted!');
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == 'edit') {
                $data = array(
                    'product' => $request->product,
                    'price' => $request->price,
                    'description' => $request->description
                );

                Medicine::where('id', $request->id)->update($data);
            }
            if ($request->action == 'delete') {
                Medicine::where('id', $request->id)->delete();
            }
            return response()->json($request);
        }
    }
}
