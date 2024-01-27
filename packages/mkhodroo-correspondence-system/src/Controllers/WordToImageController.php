<?php

namespace Mkhodroo\CorrespondenceSystem\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mkhodroo\CorrespondenceSystem\Models\Activity;
use Mkhodroo\CorrespondenceSystem\Models\Inbox;
use Mkhodroo\DateConvertor\Controllers\SDate;
use PhpOffice\PhpWord\IOFactory;
use Intervention\Image\Facades\Image;

class WordToImageController extends Controller
{
    public static function convertToImage()
    {
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        $letter = LetterController::get(48);
        $receivers = ReceiverController::getByLetterId($letter->id);
        $file = fopen(public_path('file.docx'), 'wb');
        fwrite($file, base64_decode($letter->body));
        fclose($file);
        $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('file.docx'));

        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        $PDFWriter->save(public_path('result.pdf'));

        
    }
}
