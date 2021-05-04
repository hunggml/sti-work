<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{

    public function readFile(Request $request)
    {
        $file     = request()->file('import');
        $name     = $file->getClientOriginalName();
        $arr      = explode('.', $name);
        $fileName = strtolower(end($arr));
        // dd($file, $name, $arr, $fileName);
        if ($fileName != 'xlsx' && $fileName != 'xls') {
            // dd('run');
            toastr()->error('File import phải là định dạng .xlsx hoặc .xls');
            return redirect()->route('group.list');
        } else if ($fileName == 'xls') {
            $reader  = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            $spreadsheet = $reader->load($file);
            $data        = $spreadsheet->getActiveSheet()->toArray();
        } else if ($fileName == 'xlsx') {
            $reader  = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($file);
            $data        = $spreadsheet->getActiveSheet()->toArray();
            // dd($data);
        }
        // dd($data);
        return $data;
    }

    public function importGroup(Request $request)
    {
        
        $data = $this->readFile($request);
        // dd($data);
        $dataGroups = array();
        foreach ($data as $key => $value) {
            // dd($data);
            $arr = [
                'name' => $value[0],
            ];
            array_push($dataGroups, $arr);
        }
        // dd($dataGroups);
        DB::table('groups')->insert($dataGroups);
        toastr()->success('import thành công');
        return redirect()->route('group.list');
    }
}
