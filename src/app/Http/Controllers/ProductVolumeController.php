<?php

namespace App\Http\Controllers;

use \App\Enums\WorkType;
use App\Models\User;
use App\Models\Line;
use App\Models\Product;
use App\Models\LineProduct;
use App\Models\ProductVolume;
use App\Services\Product\GetVolume;
use App\Services\Product\AddVolume;
use App\Services\Product\UpdateVolume;
use Illuminate\Http\Request;
use App\Http\Requests\IndexProductVolumeRequest;
use App\Http\Requests\StoreProductVolumeRequest;
use App\Http\Requests\UpdateProductVolumeRequest;

class ProductVolumeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProductVolumeRequest $request)
    {
        return view('product.index')->with([
            'line' => Line::findOrFail($request->get('line_id')),
            'products' => LineProduct::products($request->get('line_id'))->get(),
            'volumes' => resolve(GetVolume::class)->execute([
                'line_id' => $request->get('line_id'),
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductVolumeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductVolumeRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductVolume  $productVolume
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVolume $productVolume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductVolume  $productVolume
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVolume $productVolume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductVolumeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductVolumeRequest $request)
    {
        resolve(UpdateVolume::class)->execute($request->only(['result']));

        $line_id = $request->input('result.' . WorkType::WORK_START . '.line_id');

        return redirect()->route('product.volume.index', [
            'line_id' => $line_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductVolume  $productVolume
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVolume $productVolume)
    {
        //
    }
}
