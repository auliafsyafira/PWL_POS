<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload(){
        return view('file-upload');
    }

    public function fileUploadRename(){
        return view('file-upload-rename');
    }

    public function prosesFileUploadRename(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file|image|max:500',
            'image_name' => 'required|string',
        ]);
        
        // ambil nama extension file asal
        $extfile = $request->berkas->getClientOriginalExtension();
        // mendapatkan nama file akhir dari inputan teks
        $namaFile = $request->input('image_name'). '.' . $extfile;
        // pindahkan file upload ke folder storage/app/public/gambar/
        $path = $request->berkas->move('gambar', $namaFile);

        // menambahkan link ke gambar
        echo "Gambar berhasil diupload ke <a href='$path' target='_blank'>$namaFile</a>"; 
        echo "<br> <br>";
        echo "<img src=".$path." width='700px'>";
    }

    // public function prosesFileUploadRename(Request $request){
    //     $request->validate([
    //         'berkas' => 'required|min:5|alpha_dash',
    //         'image_name' => 'required|file|image|max:1000',
    //     ]);

    //     // ambil nama extension file asal
    //     $extfile = $request->gambar_profile->getClientOriginalExtension();
    //     // generate nama file akhir, diambil dari inputan nama_gambar = extension
    //     $namaFile = $request->input('image_name').".".$extfile;
    //     // pindahkan file upload ke folder storage/app/public/gambar/
    //     $path = $request->berkas->image_name->storeAs('public/gambar'.$namaFile);

    //     // generate path gambar yang bisa diakses (path di folder public)
    //     $pathPublic = asset('storage/gambar/'.$namaFile);

    //     echo "Gambar berhasil di upload ke <a href=".$pathPublic.">$namaFile</a>";
    //     echo "<br><br>";
    //     echo "<img src=".$pathPublic." width='200px'>";
    // }

    // public function prosesFileUpload(Request $request){
    //     //dump($request->berkas);
    //     //return "Pemrosesan file upload di sini";

    //     $request->validate([
    //         'berkas'=>'required|file|image|max:5000',]);
    //         $extfile=$request->berkas->getClientOriginalName();
    //         $namaFile='web-'.time().".".$extfile;

    //         $path = $request->berkas->move('gambar', $namaFile);
    //         $path = str_replace("\\","//", $path);
    //         echo"Variabel path berisi:$path <br>";

    //         $pathBaru=asset('gambar/'.$namaFile);
    //         echo "proses upload berhasil, file berada di: $path";
    //         echo "<br>";
    //         echo "Tampilkan link:<a href='$pathBaru'>$pathBaru</a>";

    //         echo $request->berkas->getClientOriginalName()."lolos validasi";

        // if($request->hasFile('berkas')){
        //     echo "path(): ".$request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): ".$request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): ".$request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): ".$request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): ".$request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): ".$request->berkas->getSize();
        // } else {
        //     echo "Tidak ada berkas yang diupload";
        // }
    }


