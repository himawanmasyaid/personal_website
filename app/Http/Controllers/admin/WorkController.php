<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkRequest;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // get all data
        $works = Work::all();

        // dd("data works $works");

        // return data & show view
        return view('pages.admin.works.index', [
            'items' => $works
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // show view
        return view('pages.admin.works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request)
    {

        // data request
        $data = $request->all();

        // upload file image & create image file name
        $data['image'] = $request->file('image')->store(
            'assets/gallery', // directory location
            'public' // public
        );

        // save data
        Work::create($data);

        return redirect()->route('works.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work = Work::findOrFail($id);

        dd("detail : $work");

        return redirect()->route('works.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $work = Work::findOrFail($id);

        // show data view
        return view('pages.admin.works.edit', [
            'item' => $work,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkRequest $request, $id)
    {

        $work = Work::findOrFail($id);

        if($request->image == '') {
            // update data only
            
            // update data
            $item = Work::findOrFail($id);

            // collection data
            $item->update($request);

        } else {
            // update data & image

        }    

        // $data = $request->all();
        // $data['image'] = $request->file('image')->store(
        //     'assets/gallery', //tempatnya
        //     'public' //agar public
        // );

        // hapus file lama
        // panggil model,jika datanya adamunculin, jika tidak masuk halaman 404

        // need testing
        // Storage::delete(public_path('storage/' . $item->image));
        // unlink('storage/' . $item->image);

        return redirect()
            ->route('work.index')
            ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Work::findOrfail($id);

        // delete image
        Storage::delete(public_path('storage/' . $item->image));
        unlink('storage/' . $item->image);

        // delete data in table
        $item->delete();

        return redirect()->route('works.index');

    }

}
