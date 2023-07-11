<?php

namespace App\Controllers;

use App\Models\M_kerja_sama;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \DateTime;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['form']);
    }

    public function index()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');
        $filter = $this->request->getPost('filter');

        helper(['tanggal']);
        $data['title'] = 'Dashboard';

        if (!empty($startDate) && !empty($endDate)) {
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['penguatan_fungsi'] = $this->db->table('penguatan_fungsi')->getWhere(['tgl_awal >=' => $data['startDate'], 'tgl_awal <=' => $data['endDate']])->getResult();
            $data['pembangunan_strategis'] = $this->db->table('pembangunan_strategis')->getWhere(['tgl_awal >=' => $data['startDate'], 'tgl_awal <=' => $data['endDate']])->getResult();
        } else {
            $data['penguatan_fungsi'] = $this->db->table('penguatan_fungsi')->get()->getResult();
            $data['pembangunan_strategis'] = $this->db->table('pembangunan_strategis')->get()->getResult();
        }
        // dd($data['penguatan_fungsi']);

        if (!empty($filter) && $filter == 'excel') {
            // return view('dashboard_admin/dashboard_excel', $data);
            // JIKA SUBMIT EXCEL
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A3', 'No');
            $sheet->setCellValue('B3', 'Jenis');
            // $sheet->setCellValue('C3', 'Mitra');
            $sheet->setCellValue('C3', 'Judul');
            $sheet->setCellValue('D3', 'Ruang Lingkup Kerja Sama');
            $sheet->setCellValue('E3', 'No Surat Persetujuan');
            $sheet->setCellValue('F3', 'Tanggal');
            $sheet->setCellValue('G3', 'Periode');
            $sheet->setCellValue('H3', 'Lokasi');

            $column = 4; // kolom start
            $no = 1;
            foreach ($data['penguatan_fungsi'] as $key => $value) {
                // Set periode
                $date1 = new DateTime($value->tgl_awal);
                $date2 = new DateTime($value->tgl_akhir);
                $interval = $date1->diff($date2);

                // Menghilangkan <div>
                $strJudul = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $value->judul);
                $strRuangLingkup = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $value->ruang_lingkup);

                $sheet->setCellValue('A' . $column, $no);
                $sheet->setCellValue('B' . $column, 'Penguatan Fungsi');
                // $sheet->setCellValue('C' . $column, $value->nama_mitra);
                $sheet->setCellValue('C' . $column, $strJudul);
                $sheet->setCellValue('D' . $column, $strRuangLingkup);
                $sheet->setCellValue('E' . $column, $value->no_pks);
                $sheet->setCellValue('F' . $column, $value->tgl_awal . "/" . $value->tgl_akhir);
                $sheet->setCellValue('G' . $column, $interval->y . ' tahun');
                $sheet->setCellValue('H' . $column, $value->lokasi);
                $column++;
                $no++;
            }

            $no2 = $no;
            foreach ($data['pembangunan_strategis'] as $key => $value) {
                // Set periode
                $date1 = new DateTime($value->tgl_awal);
                $date2 = new DateTime($value->tgl_akhir);
                $interval = $date1->diff($date2);

                // Menghilangkan <div>
                $strJudul = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $value->judul);
                $strRuangLingkup = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $value->ruang_lingkup);

                $sheet->setCellValue('A' . $column, $no);
                $sheet->setCellValue('B' . $column, 'Pembangunan Strategis');
                // $sheet->setCellValue('C' . $column, $value->nama_mitra);
                $sheet->setCellValue('C' . $column, $strJudul);
                $sheet->setCellValue('D' . $column, $strRuangLingkup);
                $sheet->setCellValue('E' . $column, $value->no_pks);
                $sheet->setCellValue('F' . $column, $value->tgl_awal . "/" . $value->tgl_akhir);
                $sheet->setCellValue('G' . $column, $interval->y . ' tahun');
                $sheet->setCellValue('H' . $column, $value->lokasi);
                $column++;
                $no2++;
            }

            $sheet->getStyle('A3:H3')->getFont()->setBold(true);
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ]
                ]
            ];
            $sheet->getStyle('A3:I' . ($column - 1))->applyFromArray($styleArray);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            // $sheet->getColumnDimension('I')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            // Set ramge tanggal jika ada untuk judul excel
            if (isset($data['startDate']) && isset($data['endDate'])) {
                $rangeTanggal = '_' . $data['startDate'] . ' - ' . $data['endDate'];
            } else {
                $rangeTanggal = '';
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=Data Penguatan Fungsi dan Pembangunan Strategis " . $rangeTanggal . ".xlsx");
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        } else {
            return view('dashboard_admin/dashboard', $data);
        }
    }

    public function dahsboard_skw()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        $model = new M_kerja_sama();
        $data['startDate'] = isset($startDate) ? $startDate : '';
        $data['endDate'] = isset($endDate) ? $endDate : '';
        $data['penguatanFungsi'] = $model->dashboard_skw($startDate, $endDate, 'Penguatan Fungsi');
        $data['pembangunanStrategis'] = $model->dashboard_skw($startDate, $endDate, 'Pembangunan Strategis');
        //dd($data);
        return view('dashboard_skw/dashboard', $data);
    }
}
