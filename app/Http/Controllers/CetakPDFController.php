<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\ProductsIn;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Models\ProductOut;
use Illuminate\Http\Request;

class CetakPDFController extends Controller
{
    public function barang_masuk(){
        $products = ProductsIn::orderByDesc('id')->get();
        return view('cetakPDF.bm', compact('products'));
    }

    public function cetak_bm()
    {
        $products = ProductsIn::orderByDesc('id')->get();
        $pdf = PDF::loadview('cetakPDF.cetakbm', ['products' => $products]);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
    }

    public function barang_keluar()
    {
        $products = ProductOut::orderByDesc('id')->get();
        return view('cetakPDF.bk', compact('products'));
    }

    public function cetak_bk()
    {
        $products = ProductOut::orderByDesc('id')->get();
        $pdf = PDF::loadview('cetakPDF.cetakbk', ['products' => $products]);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
    }

    public function filterBM(Request $request)
    {
        $start = $request->dari;
        $end = $request->sampai;
        $code = Code::first()->code;
        $products = ProductsIn::whereBetween('tanggal_masuk', [$start, $end])->get();
        // return view('barang_masuk.barang_masuk', compact('products', 'code'));
        return view('cetakPDF.bm', compact('products'));
    }

    public function filterBK(Request $request)
    {
        $start = $request->dari;
        $end = $request->sampai;
        $code = Code::first()->code;
        $products = ProductOut::whereBetween('tanggal_keluar', [$start, $end])->get();
        // return view('barang_masuk.barang_masuk', compact('products', 'code'));
        return view('cetakPDF.bk', compact('products'));
    }

    public function searchBM(Request $request)
    {
        $products = ProductsIn::where('merk_barang', 'LIKE', '%'. $request->search.'%')->orderByDesc('id')->get();
        return view('cetakPDF.bm', compact('products'));
    }

    public function searchBK(Request $request)
    {
        $products = ProductOut::where('merk_barang', 'LIKE', '%'. $request->search.'%')->orderByDesc('id')->get();
        return view('cetakPDF.bk', compact('products'));
    }
}
