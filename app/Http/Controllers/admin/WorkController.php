<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkRequest;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

        $image = $request->image;

        if($request->hasFile('image')) {

            // update data & image

            // get detail data
            $data = Work::findOrFail($id);

            // upload new file image & create image file name
            // $fileImageName = $request->file('image')->store(
            //     'assets/gallery', // directory location
            //     'public' // public
            // );

            // delete old image
            // Storage::delete(public_path('storage/assets/gallery' . $data->image));
            // $path = storage_path('storage' . 'assets/gallery/k8YNw9uRMpTgkL9mD89VbIL3mIMfhfeKM2zuS76P.jpg');


            // dd($path);

            // $isExists = Storage::disk('assets/gallery')->exists('1EVMpZ89xE7nHw6DK5ExP8H0pAUPu4YREjEhXCJY.jpg');
            $isExists = Storage::exists('storage/' . 'assets/gallery/capung.jpg');
        
            // funsi ini belum jalan
            if($isExists){

                dd('File founded');
                // File::delete(public_path('upload/test.png'));

                // delete file success
                Storage::delete($data->image);
                // unlink('storage/' . 'assets/gallery/capung.jpg');

            }else{
                dd('File does not exists');
            }

            // Storage::delete(public_path('storage/app/assets/gallery' . "1EVMpZ89xE7nHw6DK5ExP8H0pAUPu4YREjEhXCJY.jpg"));

            dd("deleted");
            
            // include new image in param 
            // $request['image'] = $fileImageName;

            // update data
            // $data->update($request->all());


        } else {

            // update data only

            // get detail data
            $data = Work::findOrFail($id);
            $request->image = $data->image;

            // update data
            $data->update($request->all());

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
            ->route('works.index')
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
