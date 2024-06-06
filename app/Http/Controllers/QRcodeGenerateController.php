<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Browsershot\Browsershot;
// reference the Dompdf namespace
use Dompdf\Dompdf;

class QRcodeGenerateController extends Controller
{
    // QR code generation
    public function qrcode(){
        $qrCodes = [];
        $letters = [
            1 => "A",
            2 => "B",
            3 => "C",
            4 => "D",
            5 => "E",
            6 => "F",
            7 => "G",
            8 => "H",
            9 => "I",
            10 => "J",
        ];
        for ($i=1; $i < 501; $i++) {
            array_push($qrCodes, [
                "qr" => QrCode::size(260)->generate('https://qr-system.webbing-agency.com/user/' . ($i + 4500) . '/' . $letters[10] . $i),
                "code" => $letters[10] . $i
            ]);
        }
        return view('qrcode', compact("qrCodes"));
    }
}
