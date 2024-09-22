<?php

namespace App\Exports;

use App\Models\FormFieldResponses;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FormResponsesExport
{
    protected $formResponses;
    protected $publishedFormFields;

    public function __construct($formResponses, $publishedFormFields)
    {
        $this->formResponses = $formResponses;
        $this->publishedFormFields = $publishedFormFields;
    }

    public function generate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headings
        $headings = array_merge(['Response ID'], $this->publishedFormFields->values()->all());
        $sheet->fromArray($headings, null, 'A1');

        // Make the header bold
        $headerStyle = [
            'font' => [
                'bold' => true,
            ],
        ];
        $sheet->getStyle('A1:' . $sheet->getHighestDataColumn() . '1')->applyFromArray($headerStyle);

        // Add data
        $row = 2; // Start from the second row
        foreach ($this->formResponses as $response) {
            $fieldResponses = FormFieldResponses::where('response_id', $response->id)->pluck('value', 'form_field_id')->toArray();
            $dataRow = [$response->id];

            foreach ($this->publishedFormFields as $fieldId => $label) {
                $dataRow[] = $fieldResponses[$fieldId] ?? null;
            }

            $sheet->fromArray($dataRow, null, "A{$row}");
            $row++;
        }

        // Auto size columns
        $highestColumn = $sheet->getHighestDataColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        foreach (range(1, $highestColumnIndex) as $columnID) {
            $sheet->getColumnDimensionByColumn($columnID)->setAutoSize(true);
        }
        return $spreadsheet;
    }
}
