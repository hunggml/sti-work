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
use Illuminate\Support\Carbon;


class ExportController extends Controller
{

    public function exportWork()
    {
        $date = Carbon::now();
        $user = User::Where('id', Auth::user()->id)->get();
        // $works = Work::Where('user_id', Auth::user()->id)->offset(0)->limit(500)->get();
        $works = Work::Where('user_id', Auth::user()->id)->paginate(10);
        // dd($works,$works->items());
        // $works['currentPage']=2;
        // dd($works);
        // $dem = round(($works/10), 0, PHP_ROUND_HALF_UP);
        // dd($dem); 
        // $works = Work::all();

        $fileType = IOFactory::identify(public_path('excels/excel_template.xlsx'));
        //Load data
        $loadFile = IOFactory::createReader($fileType);
        $file = $loadFile->load(public_path('excels/excel_template.xlsx'));
        $active_sheet = $file->getActiveSheet();
        
        $active_sheet->getColumnDimension('A')->setAutoSize(false);
        $active_sheet->getColumnDimension('B')->setAutoSize(true);
        $active_sheet->getColumnDimension('C')->setAutoSize(true);
        $active_sheet->getColumnDimension('D')->setAutoSize(true);
        $active_sheet->getColumnDimension('E')->setAutoSize(true);
        $count = 6;
        $active_sheet->setAutoFilter('A5:E5');
        // $active_sheet->setCellValue('A3', 'Ngày (date): ' . $date);

        // foreach ($user as $value) {
        //     $active_sheet->setCellValue('A4', 'Nhân viên ( staff) : ' . $value->name);
        // }

        foreach ($works as $row) {
            
            $active_sheet->setCellValue('A' . $count, $row['id']);
            $active_sheet->setCellValue('B' . $count, $row['detail']);
            $active_sheet->setCellValue('C' . $count, $row['start_date']);
            $active_sheet->setCellValue('D' . $count, $row['end_date']);
            $active_sheet->setCellValue('E' . $count, $row['status']);
            $count++;
            // dd($count);
            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
    
            ];
            $file->getActiveSheet()->getStyle('A6')->applyFromArray($styleArray);

            $file->getActiveSheet()->duplicateStyle(
                $file->getActiveSheet()->getStyle('A6'),
                'A6:E' . $count
            );
            // dd($count);


        }
        // $active_sheet->setCellValue('A'.$count,'=SUM(A6:'.'A'.$count.')');
        // $active_sheet->mergeCells('A' . $count . ':' . 'E' . $count);

        $fileName = "Danh_sách_công_việc.xlsx";
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xlsx');
        $writer->save("excels/" . $fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/') . "/excels" . "/" . $fileName);
        // return redirect()->route('work.index');
    }


    public function exportBill()
    {
        $date = Carbon::now();
        $user = User::Where('id', Auth::user()->id)->get();
        $works = Work::Where('user_id', Auth::user()->id)->offset(0)->limit(500)->get();

        // $works['currentPage']=2;
        // dd($works);
        // $dem = round(($works/10), 0, PHP_ROUND_HALF_UP);
        // dd($dem); 
        // $works = Work::all();

        $fileType = IOFactory::identify(public_path('excels/excel_template.xlsx'));
        //Load data
        $loadFile = IOFactory::createReader($fileType);
        $file = $loadFile->load(public_path('excels/excel_template.xlsx'));
        $active_sheet = $file->getActiveSheet();

        $active_sheet->getColumnDimension('A')->setAutoSize(false);
        $active_sheet->getColumnDimension('B')->setAutoSize(true);
        $active_sheet->getColumnDimension('C')->setAutoSize(true);
        $active_sheet->getColumnDimension('D')->setAutoSize(true);
        $active_sheet->getColumnDimension('E')->setAutoSize(true);
        $count = 6;
        $active_sheet->setAutoFilter('A5:E5');
        // $active_sheet->setCellValue('A3', 'Ngày (date): ' . $date);

        // foreach ($user as $value) {
        //     $active_sheet->setCellValue('A4', 'Nhân viên ( staff) : ' . $value->name);
        // }

        foreach ($works as $row) {
            
            $active_sheet->setCellValue('A' . $count, $row['id']);
            $active_sheet->setCellValue('B' . $count, $row['detail']);
            $active_sheet->setCellValue('C' . $count, $row['start_date']);
            $active_sheet->setCellValue('D' . $count, $row['end_date']);
            $active_sheet->setCellValue('E' . $count, $row['status']);
            $count++;

            $styleArray = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
    
            ];
            $file->getActiveSheet()->getStyle('A6')->applyFromArray($styleArray);

            $file->getActiveSheet()->duplicateStyle(
                $file->getActiveSheet()->getStyle('A6'),
                'A6:E' . $count+1
            );


        }
        $active_sheet->setCellValue('A'.$count, 'ky gui');
        $active_sheet->getRowDimension($count+1)->setRowHeight(100);
        // $active_sheet->setCellValue('A'.$count,'=SUM(A6:'.'A'.$count.')');
        // $active_sheet->mergeCells('A' . $count . ':' . 'E' . $count);

        $fileName = "Danh_sách_công_việc.xlsx";
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xlsx');
        $writer->save("excels/" . $fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/') . "/excels" . "/" . $fileName);
        // return redirect()->route('work.index');
    }

}
