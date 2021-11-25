<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, Y-M-d H:i:s");
        $filename = $filename . '_' . date("Y-m-d") . ".csv";
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
    
        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
    
        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    public function array2csv(array &$array, array &$header)
    {
        if (count($array) == 0) { return null;  }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, $header);
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }


    public function exportData($result, $downloadName) {
        $this->download_send_headers($downloadName);
        $distributedResultEx = json_decode(json_encode($result), true);
        $header = array_keys($distributedResultEx[0]);
        echo $this->array2csv($distributedResultEx,$header);
        dd();
    }

    public function getMatchData($dataTable, $searchTable, $dataTableContract) {
        
        $conditionColumn = $dataTable.'.'.$dataTableContract;
        return $found_records = \DB::table($dataTable)->whereExists(function ($query) use ($searchTable, $conditionColumn) {
            $query->select(DB::raw(1))
                  ->from($searchTable)
                  ->whereColumn($searchTable.'.kontrata', $conditionColumn)
                  ->where($searchTable.'.user_id', '=', \Auth::id());
        })->get();
    }
    

    public function getUnmatchData($dataTable, $searchTable, $dataTableContract) {

        $conditionColumn = $dataTable.'.'.$dataTableContract;
        return $found_records =  \DB::table($searchTable)->whereNotExists(function ($query) use ($dataTable, $searchTable, $conditionColumn) {
            $query->select(DB::raw(1))
                  ->from($dataTable)
                  ->whereColumn($conditionColumn, $searchTable . '.kontrata');
        })->where($searchTable.'.user_id', '=', \Auth::id())->get();
    }

    public function viewOrExport($notfound_records, $excelName, $viewName ){
        if(!$notfound_records->isEmpty() ) {
            $this->exportData($notfound_records, $excelName );
        } else  return view($viewName)->with([ 'not_found' => "nuk ka match ose nuk ka csv te ngarkuar",]);
    }
}
