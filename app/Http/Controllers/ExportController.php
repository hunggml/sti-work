<?php

namespace App\Http\Controllers;


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


class ExportController extends Controller
{
    // public function export($data,$name)
    // {
    // 	$fileType = IOFactory::identify(public_path('excels\unit_template.xlsx'));
    //     //Load data
    //     $loadFile = IOFactory::createReader($fileType);
    //     $file = $loadFile->load(public_path('excels\unit_template.xlsx'));
    // 	$active_sheet = $file->getActiveSheet();
    // 	$count = 6;

    // 		foreach($data as $row)
    // 		{	 
    //             if($row->user_created == null){
    //                 $user_created = '';  
    //             }else{
    //                 $user_created = $row->user_created->name;
    //             }
    //             if($row->user_updated == null){
    //                 $user_updated = '';  
    //             }else{
    //                 $user_updated = $row->user_updated->name;
    //             }
    // 			$active_sheet->setCellValue('A' . $count, $row["ID"]);
    // 			$active_sheet->setCellValue('B' . $count, $row["Name"]);
    // 			$active_sheet->setCellValue('C' . $count, $row["Symbols"]);
    // 			$active_sheet->setCellValue('D' . $count, $user_created);
    // 			$active_sheet->setCellValue('E' . $count, $row["Time_Created"]);
    // 			$active_sheet->setCellValue('F' . $count, $user_updated);
    // 			$active_sheet->setCellValue('G' . $count, $row["Time_Updated"]);
    // 			$active_sheet->setCellValue('H' . $count, $row["IsDelete"]);
    // 			$styleArray = [
    //                 'borders' => [
    //                     'outline' => [
    //                         'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                         'color' => ['argb' => '00000000'],
    //                     ],
    //                 ],
    //             ];
    //             $file->getActiveSheet()->getStyle('B6')->applyFromArray($styleArray);

    //             // $file->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    //             $file->getActiveSheet()
    //             ->duplicateStyle(
    //                 $file->getActiveSheet()->getStyle('B6'),
    //                 'A6:H'.$count
    //             );
    //             $file->getActiveSheet()->setAutoFilter('A5:H'.$count);
    //             $count = $count + 1;
    // 		}


    // 		$file->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    // 		$file->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    // 		$file->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    // 		$file->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    // 		$file->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    // 		$file->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    // 		$file->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    // 		$file->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    // 	$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xlsx');
    // 	$file_name = $name . '.' . strtolower('Xlsx');
    // 	$writer->save($file_name);
    // 	header('Content-Type: application/x-www-form-urlencoded');
    // 	header('Content-Transfer-Encoding: Binary');
    // 	header("Content-disposition: attachment; filename=\"".$file_name."\"");
    // 	readfile($file_name);
    // 	unlink($file_name);
    // 	exit;
    // }

    public function exportWork($type)
    {
        $works = Work::Where('user_id', Auth::user()->id)->get();
        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        $fileType = IOFactory::identify(public_path('excels/excel_template.xlsx'));
        //Load data
        $loadFile = IOFactory::createReader($fileType);
        $file = $loadFile->load(public_path('excels/excel_template.xlsx'));
    	$active_sheet = $file->getActiveSheet();
        // $sheet->setCellValue('A1', 'id');
        // $sheet->setCellValue('B1', 'detail');
        // $sheet->setCellValue('C1', 'start_date');
        // $sheet->setCellValue('D1', 'end_date');
        // $sheet->setCellValue('E1', 'status');

        $active_sheet->getColumnDimension('A')->setAutoSize(true);
        $active_sheet->getColumnDimension('B')->setAutoSize(true);
        $active_sheet->getColumnDimension('C')->setAutoSize(true);
        $active_sheet->getColumnDimension('D')->setAutoSize(true);
        $active_sheet->getColumnDimension('E')->setAutoSize(true);
        $count = 2;
        $active_sheet->setAutoFilter('A1:E1');

        foreach ($works as $row) {
            $active_sheet->setCellValue('A' . $count, $row['id']);
            $active_sheet->setCellValue('B' . $count, $row['detail']);
            $active_sheet->setCellValue('C' . $count, $row['start_date']);
            $active_sheet->setCellValue('D' . $count, $row['end_date']);
            $active_sheet->setCellValue('E' . $count, $row['status']);
            $count++;
        }
        
        $fileName = "Danh_sách_công_việc." . $type;
        // if ($type == 'xlsx') {
        //     $writer = new Xlsx($spreadsheet);
        // }
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xlsx');
    	// $file_name = $name . '.' . strtolower('Xlsx');
        $writer->save("excels/" . $fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/') . "/excels" . "/" . $fileName);
    }


    public function exportStaff($type)
    {
        $users = User::with('group')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'name');
        $sheet->setCellValue('C1', 'username');
        $sheet->setCellValue('D1', 'phone');
        $sheet->setCellValue('E1', 'address');
        $sheet->setCellValue('F1', 'email');
        $sheet->setCellValue('G1', 'level');
        $sheet->setCellValue('H1', 'group_id');
        $count = 2;
        foreach ($users->groupBy('group_id') as $key => $value) {
            if ($value->first()->group_id == Auth::user()->group_id) {
                foreach ($value as $row) {
                    $sheet->setCellValue('A' . $count, $row['id']);
                    $sheet->setCellValue('B' . $count, $row['name']);
                    $sheet->setCellValue('C' . $count, $row['username']);
                    $sheet->setCellValue('D' . $count, $row['phone']);
                    $sheet->setCellValue('E' . $count, $row['address']);
                    $sheet->setCellValue('F' . $count, $row['email']);
                    $sheet->setCellValue('G' . $count, $row['level']);
                    $sheet->setCellValue('H' . $count, $row['group_id']);
                    $count++;
                }
            }
        }

        $fileName = "Danh_sách_nhân_viên." . $type;
        if ($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        }
        $writer->save("excels/" . $fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/') . "/excels" . "/" . $fileName);
    }
}
