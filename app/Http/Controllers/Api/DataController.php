<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;
use App\Http\Resources\DataResource;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function index()
    {
        $datas = Data::latest()->get();

        return view('welcome', compact('datas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'temp'     => 'required',
            'humid'     => 'required',
            'moist'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Data::create([
            'temp'     => $request->temp,
            'humid'     => $request->humid,
            'moist'   => $request->moist,
        ]);

        return new DataResource(true, 'Data Berhasil Ditambahkan!', $data);
    }
}
