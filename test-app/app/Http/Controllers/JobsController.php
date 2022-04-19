<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Session;
// use Illuminate\Support\Facades\Redirect;

class JobsController extends Controller
{
    public function run ()
    {
        Job::create([
            'email' => request('email'),
            'gtf' => request('gtf'),
            'bed' => request('bed'),
            'chr' => request('chr')
        ]);
        $gtf = request('gtf');
        $bed = request('bed');
        $chr = request('chr');
        
        $command = "../vendor/bin/sail exec -T gtftk conda run -n pygtftk gtftk ologram -i mini_real.gtf.gz -c hg38.genome -p ENCFF112BHN_H3K4me3_K562_sub.bed -o test2.pdf 2>&1";
        $command2 = "../vendor/bin/sail exec 2>&1";
        $command3 =  "../vendor/bin/sail exec -u root gtftk conda 2>&1";
        $command4 = "../vendor/bin/sail run hello-world 2>&1";
        var_dump(system($command4));
        var_dump(exec($command4));
        var_dump(shell_exec($command4));
        // return $this::show_message();
    
    }

    public function show_message()
    {
        return redirect()->to('/main')->with('success', 'Job is running !');
    }
}
