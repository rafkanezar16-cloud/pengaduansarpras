<?php

namespace App\Support;

use ZipArchive;

/**
 * Penulis file .xlsx sederhana (tanpa library tambahan) dengan format rapi:
 * judul, header berwarna, border, lebar kolom, warna status, freeze pane, filter.
 */
class SimpleXlsx
{
    // Indeks style (lihat styles())
    public const S_TITLE = 1;
    public const S_SUB = 2;
    public const S_HEAD = 3;
    public const S_TEXT = 4;
    public const S_DATE = 5;
    public const S_CENTER = 6;
    public const S_ST_DIAJUKAN = 7;
    public const S_ST_DIPROSES = 8;
    public const S_ST_SELESAI = 9;
    public const S_ST_DITOLAK = 10;
    public const S_TOTAL = 11;

    private array $rows = [];       // [rowNumber => [colIndex => [value, style, type]]]
    private array $widths = [];
    private array $merges = [];
    private int $freezeRow = 0;
    private ?string $filter = null;

    public function setWidths(array $widths): self { $this->widths = $widths; return $this; }
    public function merge(string $range): self { $this->merges[] = $range; return $this; }
    public function freeze(int $row): self { $this->freezeRow = $row; return $this; }
    public function autoFilter(string $range): self { $this->filter = $range; return $this; }

    /** $cells: list of [value, style] atau value. Tanggal: kirim objek DateTimeInterface. */
    public function addRow(int $rowNumber, array $cells, ?float $height = null): self
    {
        $this->rows[$rowNumber] = ['cells' => $cells, 'ht' => $height];
        return $this;
    }

    public static function col(int $i): string
    {
        $s = '';
        for ($i++; $i > 0; $i = intdiv($i - 1, 26)) {
            $s = chr(65 + ($i - 1) % 26).$s;
        }
        return $s;
    }

    private function esc(string $v): string
    {
        $v = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', $v);
        return htmlspecialchars($v, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }

    private function sheetXml(): string
    {
        $x = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
            .'<sheetPr><pageSetUpPr fitToPage="1"/></sheetPr>'
            .'<sheetViews><sheetView workbookViewId="0" showGridLines="0">';
        if ($this->freezeRow > 0) {
            $x .= '<pane ySplit="'.$this->freezeRow.'" topLeftCell="A'.($this->freezeRow + 1).'" activePane="bottomLeft" state="frozen"/>'
                .'<selection pane="bottomLeft"/>';
        }
        $x .= '</sheetView></sheetViews><sheetFormatPr defaultRowHeight="18"/>';

        if ($this->widths) {
            $x .= '<cols>';
            foreach ($this->widths as $i => $w) {
                $n = $i + 1;
                $x .= '<col min="'.$n.'" max="'.$n.'" width="'.$w.'" customWidth="1"/>';
            }
            $x .= '</cols>';
        }

        $x .= '<sheetData>';
        ksort($this->rows);
        foreach ($this->rows as $r => $row) {
            $ht = $row['ht'] ? ' ht="'.$row['ht'].'" customHeight="1"' : '';
            $x .= '<row r="'.$r.'"'.$ht.'>';
            foreach ($row['cells'] as $c => $cell) {
                [$val, $style] = is_array($cell) ? $cell : [$cell, self::S_TEXT];
                $ref = self::col($c).$r;
                if ($val instanceof \DateTimeInterface) {
                    $serial = intdiv(strtotime($val->format('Y-m-d').' UTC'), 86400) + 25569;
                    $x .= '<c r="'.$ref.'" s="'.$style.'"><v>'.$serial.'</v></c>';
                } elseif (is_int($val) || is_float($val)) {
                    $x .= '<c r="'.$ref.'" s="'.$style.'"><v>'.$val.'</v></c>';
                } elseif ($val === null || $val === '') {
                    $x .= '<c r="'.$ref.'" s="'.$style.'"/>';
                } else {
                    $x .= '<c r="'.$ref.'" s="'.$style.'" t="inlineStr"><is><t xml:space="preserve">'.$this->esc((string) $val).'</t></is></c>';
                }
            }
            $x .= '</row>';
        }
        $x .= '</sheetData>';

        if ($this->filter) {
            $x .= '<autoFilter ref="'.$this->filter.'"/>';
        }
        if ($this->merges) {
            $x .= '<mergeCells count="'.count($this->merges).'">';
            foreach ($this->merges as $m) {
                $x .= '<mergeCell ref="'.$m.'"/>';
            }
            $x .= '</mergeCells>';
        }
        $x .= '<pageMargins left="0.5" right="0.5" top="0.6" bottom="0.6" header="0.3" footer="0.3"/>'
            .'<pageSetup paperSize="9" orientation="landscape" fitToWidth="1" fitToHeight="0"/>'
            .'</worksheet>';

        return $x;
    }

    private function styles(): string
    {
        $border = '<border><left style="thin"><color rgb="FFCBD5E1"/></left><right style="thin"><color rgb="FFCBD5E1"/></right>'
            .'<top style="thin"><color rgb="FFCBD5E1"/></top><bottom style="thin"><color rgb="FFCBD5E1"/></bottom><diagonal/></border>';
        $fill = fn (string $rgb) => '<fill><patternFill patternType="solid"><fgColor rgb="FF'.$rgb.'"/><bgColor indexed="64"/></patternFill></fill>';

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
        .'<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">'
        .'<numFmts count="1"><numFmt numFmtId="164" formatCode="dd/mm/yyyy"/></numFmts>'
        .'<fonts count="7">'
            .'<font><sz val="11"/><name val="Calibri"/></font>'                                             // 0
            .'<font><b/><sz val="16"/><color rgb="FF1E3A8A"/><name val="Calibri"/></font>'                  // 1 judul
            .'<font><i/><sz val="10"/><color rgb="FF64748B"/><name val="Calibri"/></font>'                  // 2 sub
            .'<font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font>'                  // 3 header
            .'<font><b/><sz val="11"/><color rgb="FF1D4ED8"/><name val="Calibri"/></font>'                  // 4 diajukan
            .'<font><b/><sz val="11"/><color rgb="FF15803D"/><name val="Calibri"/></font>'                  // 5 selesai
            .'<font><b/><sz val="11"/><color rgb="FFB91C1C"/><name val="Calibri"/></font>'                  // 6 ditolak
        .'</fonts>'
        .'<fills count="8"><fill><patternFill patternType="none"/></fill><fill><patternFill patternType="gray125"/></fill>'
            .$fill('2563EB').$fill('DBEAFE').$fill('FEF3C7').$fill('DCFCE7').$fill('FEE2E2').$fill('F1F5F9')
        .'</fills>'
        .'<borders count="2"><border><left/><right/><top/><bottom/><diagonal/></border>'.$border.'</borders>'
        .'<cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>'
        .'<cellXfs count="12">'
            .'<xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>'                                                                                                   // 0
            .'<xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0" applyFont="1"><alignment vertical="center"/></xf>'                                                     // 1 judul
            .'<xf numFmtId="0" fontId="2" fillId="0" borderId="0" xfId="0" applyFont="1"><alignment vertical="center"/></xf>'                                                     // 2 sub
            .'<xf numFmtId="0" fontId="3" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="center" wrapText="1"/></xf>' // 3 header
            .'<xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment vertical="top" wrapText="1"/></xf>'                       // 4 teks
            .'<xf numFmtId="164" fontId="0" fillId="0" borderId="1" xfId="0" applyNumberFormat="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="top"/></xf>' // 5 tanggal
            .'<xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="top"/></xf>'                // 6 tengah
            .'<xf numFmtId="0" fontId="4" fillId="3" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="top"/></xf>' // 7 diajukan
            .'<xf numFmtId="0" fontId="0" fillId="4" borderId="1" xfId="0" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="top"/></xf>'  // 8 diproses
            .'<xf numFmtId="0" fontId="5" fillId="5" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="top"/></xf>' // 9 selesai
            .'<xf numFmtId="0" fontId="6" fillId="6" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="center" vertical="top"/></xf>' // 10 ditolak
            .'<xf numFmtId="0" fontId="3" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1" applyAlignment="1"><alignment horizontal="left" vertical="center"/></xf>' // 11 total
        .'</cellXfs>'
        .'</styleSheet>';
    }

    public function save(string $path, string $sheetName = 'Laporan'): void
    {
        $zip = new ZipArchive();
        $zip->open($path, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            .'<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            .'<Default Extension="xml" ContentType="application/xml"/>'
            .'<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>'
            .'<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>'
            .'<Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>'
            .'</Types>');
        $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            .'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>');
        $filterName = '';
        if ($this->filter) {
            [$a, $b] = explode(':', $this->filter);
            $abs = fn ($c) => preg_replace('/([A-Z]+)(\d+)/', '\$$1\$$2', $c);
            $filterName = '<definedNames><definedName name="_xlnm._FilterDatabase" localSheetId="0" hidden="1">'
                .$this->esc("'".$sheetName."'!".$abs($a).':'.$abs($b)).'</definedName></definedNames>';
        }
        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">'
            .'<sheets><sheet name="'.$this->esc($sheetName).'" sheetId="1" r:id="rId1"/></sheets>'.$filterName.'</workbook>');
        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            .'<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            .'<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>'
            .'<Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>');
        $zip->addFromString('xl/styles.xml', $this->styles());
        $zip->addFromString('xl/worksheets/sheet1.xml', $this->sheetXml());
        $zip->close();
    }
}
