<?php

declare(strict_types=1);
namespace App\Parser;

use PhpOffice\PhpSpreadsheet\IOFactory;

class MemberImportFileParser
{

    public static function parse(string $filePath): array
    {
            $csvReader = IOFactory::createReader(IOFactory::READER_CSV)->setReadDataOnly(FALSE);
            $memberCsv = $csvReader->load($filePath);
            $worksheet = $memberCsv->getActiveSheet();

            $rows = $worksheet->toArray();
            $result = [];
            $header = $rows[0];
            array_shift($rows);

            foreach ($rows as $key => $value) {

                foreach ($value as $k => $v) {
                    $result[$key][trim($header[$k])] = !$v ? null :trim($v);
                }
            }

            return ['header' => $header, 'value' => $result];
    }
}