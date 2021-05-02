<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{

    public function importGroup(Request $request)
    {
        // $title = "Import Spreadsheet";
        // $template = url('documents/template-users.xlsx');
        $groups = Group::all();
        $array_id = [];
        foreach($groups as $value) {
            $array_id[] = $value->id;
        }
        if ($_POST) {
            $request->validate([
                'import' => 'required|mimes:xlsx|max:10000'
            ]);
            $file = $request->file('import');
            $name = time() . '.xlsx';
            $path = public_path('documents' . DIRECTORY_SEPARATOR);

            if ($file->move($path, $name)) {
                $inputFileName = $path . $name;
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $reader->setReadDataOnly(true);
                // $reader->setLoadSheetsOnly(["Sheet1"]);

                $spreadSheet = $reader->load($inputFileName);
                $workSheet = $spreadSheet->getActiveSheet();
                $workSheet2 = $spreadSheet->getActiveSheet()->toArray();
                dd($workSheet2);
                // dd(count($workSheet2)+1);
                $startRow = 2;
                $columns = [
                    "A" => "id",
                    "B" => "name"
                ];
                $data_insert = [];
                for ($i = $startRow; $i < count($workSheet2)+1; $i++) {
                    $id = $workSheet->getCell("A" . $i)->getValue();
                    if (empty($id) || !is_numeric($id)) continue;

                    if($workSheet->getCell("A" . $i)->getValue() == null) {
                        toastr()->error('Id không được để trống');
                        return redirect()->route('group.list');
                    }
                    if($workSheet->getCell("B" . $i)->getValue() == null) {
                        toastr()->error('Tên group không được để trống');
                        return redirect()->route('group.list');
                    }

                    $data_row = [];
                    foreach ($columns as $col => $field) {
                        $val = $workSheet->getCell($col . $i)->getValue();
                        $data_row[$field] = $val;
                    }
                    if(in_array($id,$array_id)) {
                        toastr()->error('Id : '.$id.' đã tồn tại, import không thành công');
                        return redirect()->route('group.list');
                    }
                    else {
                        $data_insert[] = $data_row;
                    }
                  
                }
                // DB::table('groups')->truncate();
                DB::table('groups')->insert($data_insert);
                toastr()->success('import thành công');
                return redirect()->route('group.list');
            }
        }
    }
}
