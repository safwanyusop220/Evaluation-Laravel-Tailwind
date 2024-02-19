<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Exports\EvaluationExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel as Export;
use Maatwebsite\Excel\Facades\Excel;

class EvaluationController extends Controller
{
    public function index()
    {
        $jsonFilePath = public_path('evaluation_20190711.json');
        $data = json_decode(File::get($jsonFilePath), true);

        return view('evaluation', compact('data'));
    }

    private function ExportData($id)
    {
        $jsonFilePath = public_path('evaluation_20190711.json');

        if (!file_exists($jsonFilePath)) {
            abort(404);
        }

        $jsonData = json_decode(file_get_contents($jsonFilePath), true);

        $person = collect($jsonData['data'])->where('id', $id)->first();

        if (!$person) {
            abort(404);
        }

        $rows = [];

        foreach ($person['evaluation']['score'] as $test) {
            foreach ($test as $testName => $testScore) {
                $rows[] = [
                    'Title' => $person['evaluation']['title'],
                    'Test' => $testName,
                    'Score' => $testScore,
                    'EvaluateAt' => Carbon::parse($person['evaluation']['created_at'])->format('m/d/Y'),
                ];
            }
        }

        return [
            'name' => $person['name'],
            'rows' => $rows,
        ];
    }

    public function exportExcel($id)
    {
        $data = $this->ExportData($id);

        $export = new EvaluationExport($data['rows']);

        $fileName = $data['name'] . '_evaluation.xlsx';

        return Excel::download($export, $fileName);
    }

    public function exportCSV($id)
    {
        $data = $this->ExportData($id);

        $export = new EvaluationExport($data['rows']);

        $fileName = $data['name'] . '_evaluation.csv';

        return Excel::download($export, $fileName, Export::CSV);
    }

    
}
