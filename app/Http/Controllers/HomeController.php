<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    public function dododo($request, $routi, $tablename, $contractName, $meterName, $sherbimi, $downloadName)
    {   
        $results = \DB::table($tablename);
        $search = $request->has('term') !== false ? $request->input('term') : '';
        $status = $request->has('status') !== false ? $request->input('status') : 'all';
        $status == '' ? null : $status;
        $matesi = $request->has('nr_serial') !== false ? $request->input('nr_serial') : '';
        $llojisherbimi = $request->has('llojisherbimi') !== false ? $request->input('llojisherbimi') : '';
        
        if($status != 'all') $results->where('match_z_billing', '=', $status);
        if($search != '') $results->whereRaw("upper(".$contractName. ") LIKE '%". strtoupper($search) ."%'");
        if($matesi != '') $results->whereRaw("upper(".$meterName . ") LIKE '%". strtoupper($matesi)."%'");
        if($llojisherbimi != '' && $llojisherbimi != 'all') $results->whereRaw("upper(".$sherbimi.") = '". strtoupper($llojisherbimi) ."'");

        if($request->has('exportData') === false) {
            $results = $results->paginate(10)->withQueryString();
            $results->isEmpty() ? $results = [] : $results;
            
            return view($routi)->with([
                'products' => $results,
                'term' => $search,
                'status' => $status,
                'matesi' => $matesi,
                'llojisherbimi' => $llojisherbimi,
            ]);
        } else {
            
            $results = $results->get();
            $results->isEmpty() ? $results = [] : $results;

            $this->exportData($results, $downloadName);
        } 
        
       
    }
    public function index(Request $request)
    {
        return $this->dododo($request, 'home', 'TBL_3G', 'KONTRATA', 'NR_SERIAL_I_MATESIT_ELE', 'LLOJI_I_SHERBIMI', '3g_export');
    }
    public function vme(Request $request)
    {
        return $this->dododo($request, 'vme', 'Z_VME_2020', 'ID_KLIENTIT', 'NR_SERIAL_I_MATESIT_EL', 'LLOJI_SHERBIMIT', 'vme_export');
    }

    public function htt(Request $request)
    {   
        return $this->dododo($request, 'htt', 'Z_HTT_2020', 'ID_KLIENTIT', 'NR_SERIAL_I_MATESIT_EL', 'LLOJI_SHERBIMIT', 'htt_export');
    }

//DOWNLOADS
 
    //3g excel

    public function treg_excel(Request $request)
    {
        return view('3g_excel')->with(['not_found' => "", ]);
    }


    public function matched_treg_excel(Request $request)
    {
        //Find all matching records between treg_excel's KONTRATA and tbl_3g's KONTRATA
        $found_records = $this->getMatchData('tbl_3g', 'treg_excel', 'kontrata');

        $this->viewOrExport($found_records, 'excel_3g_Matched', 'treg_excel' );

        
    }

    public function unmatched_treg_excel(Request $request)
    {
        $notfound_records = $this->getUnmatchData('tbl_3g', 'treg_excel', 'kontrata');
    
        $this->viewOrExport($notfound_records, 'excel_3g_unmatched', 'treg_excel' );
 
    }
    //VME excel
    public function vme_excel()
    {
        return view('vme_excel')->with([ 'not_found' => "",]);
    }

    public function matched_vme_excel(Request $request)
    {

        $found_records = $this->getMatchData('Z_VME_2020', 'VME_EXCEL', 'id_klientit');

        $this->viewOrExport($found_records, 'excel_vme_Matched', 'vme_excel' );

    }


    public function unmatched_vme_excel(Request $request)
    {   

        $notfound_records = $this->getUnmatchData('Z_VME_2020', 'VME_EXCEL', 'id_klientit');
        
        $this->viewOrExport($notfound_records, 'excel_vme_notMatched', 'vme_excel' );

    }
    
    //HTT excel
    public function htt_excel()
    {
        return view('htt_excel')->with(['not_found' => "",]);
    }

    public function matched_htt_excel(Request $request)
    {

        $found_records = $this->getMatchData('Z_HTT_2020', 'HTT_EXCEL', 'id_klientit');

        $this->viewOrExport($found_records, 'excel_htt_matched', 'htt_excel' );

    }


    public function unmatched_htt_excel(Request $request)
    {   

        $notfound_records = $this->getUnmatchData('Z_HTT_2020', 'HTT_EXCEL', 'id_klientit');
        $this->viewOrExport($notfound_records, 'excel_htt_notMatched', 'htt_excel' );
    
    }
}
