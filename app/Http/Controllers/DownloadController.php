<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DownloadController extends Controller
{
    public function download_files($file_type,$id,$optional_input="")
    {   if($file_type==="ens"){
            if ($optional_input === "chr") {
                return Storage::download("Ensembl_GTF/$id/$id.chrominfo");
            }
        return Storage::download("Ensembl_GTF/$id.zip");
        }
        if($file_type==="log"){
            return Storage::download("$id/ologram_request.log");
        }
        

    }
}
