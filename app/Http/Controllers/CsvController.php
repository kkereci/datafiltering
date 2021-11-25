<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\treg_excel;
use App\Models\User;

class CsvController extends Controller
{
    public function store3g(Request $request) {
        if($request->hasFile('upload_3g')){
            $path = $request->file('upload_3g')->getRealPath();
            $user_id = \Auth::id();
            \DB::delete('delete treg_excel where user_id = ?', [$user_id]);
            $row = 1;
            if (($handle = fopen($path, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);        
                    if($row == 1 && $data[0] !== 'KONTRATA') dd("Kolona e cvs nuk permban: 'KONTRATA'");
                    else if($row == 1) { $row++; continue; }
                    $kontrata = $data[0];
                    \DB::insert('insert into treg_excel (kontrata, user_id) values (?, ?)', [$kontrata, $user_id]);
                    $row++;
                }
            }
        }
        return view('3g_excel')->with([
            'not_found' => "Lista u ngarkua"
        ]);
    }
    public function storehtt(Request $request) {
        if($request->hasFile('upload_htt')){
            $path = $request->file('upload_htt')->getRealPath();
            $user_id = \Auth::id();
            \DB::delete('delete htt_excel where user_id = ?', [$user_id]);
            $row = 1;
            if (($handle = fopen($path, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);        
                    if($row == 1 && $data[0] !== 'KONTRATA') dd("Kolona e cvs nuk permban: 'KONTRATA'");
                    else if($row == 1) { $row++; continue; }
                    $kontrata = $data[0];
                    \DB::insert('insert into htt_excel (kontrata, user_id) values (?, ?)', [$kontrata, $user_id]);
                    $row++;
                }
            }
        }
        return view('htt_excel')->with([
            'not_found' => "Lista u ngarkua"
        ]);

    }
    public function storevme(Request $request) {
        if($request->hasFile('upload_vme')){
            $path = $request->file('upload_vme')->getRealPath();
            $user_id = \Auth::id();
            \DB::delete('delete vme_excel where user_id = ?', [$user_id]);
            $row = 1;
            if (($handle = fopen($path, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);        
                    if($row == 1 && $data[0] !== 'KONTRATA') dd("Kolona e cvs nuk permban: 'KONTRATA'");
                    else if($row == 1) { $row++; continue; }
                    $kontrata = $data[0];
                    \DB::insert('insert into vme_excel (kontrata, user_id) values (?, ?)', [$kontrata, $user_id]);
                    $row++;
                }
            }
        }

        return view('vme_excel')->with([
            'not_found' => "Lista u ngarkua"
        ]);
    }
    

}
