<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DownloadController extends Controller
{
    public function download_files($species)
    {

        return Storage::download("Ensembl_GTF/$species.zip");

    }
}
