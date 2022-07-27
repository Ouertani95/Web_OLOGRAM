<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DownloadController extends Controller
{
    public function download_files($file_type,$id,$optional_input="")
    {   
        // Verify if files to download are the Ensembl files
        if($file_type==="ens"){
            // If only CHR is used download only the CHR Ensembl file
            if ($optional_input === "chr") {
                return Storage::download("Ensembl_GTF/$id/$id.chrominfo");
            }
        // Else download both GTF and CHR Ensembl files
        return Storage::download("Ensembl_GTF/$id.zip");
        }
        // Verify if log file is requested
        if($file_type==="log"){
            // Download log file
            return Storage::download("$id/ologram_request.log");
        }    
    }
}
