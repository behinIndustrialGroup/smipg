<?php

namespace Modules\MarketingCard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\MarketingCard\App\Http\Models\MarketingCard;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;

class MarketingCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = MarketingCard::get();
        return view('marketingcard::index')->with([
            'people' => $people
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marketingcard::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            // 'nationalId' => 'required|digits:10|unique:marketing_cards',
            // 'firstName' => 'required|string|max:255',
            // 'lastName' => 'required|string|max:255',
            // 'fatherName' => 'required|string|max:255',
            // 'issueDate' => 'required',
            // 'expiryDate' => 'required',
        ]);

        // ذخیره رکورد جدید
        $row = MarketingCard::create($request->all());
        $row->otherFields = json_encode([
            'gender' => $request->gender ?? null,
            'phone' => $request->phone ?? null,
            'mobile' => $request->mobile ?? null,
            'postalCode' => $request->postalCode ?? null,
            'address' => $request->address ?? null,
        ]);
        $row->save();

        $link = route('marketingcard.show', ['marketingcard' => $row->id]);
        $qrCodeFilePath = public_path($row->id . '.png');
        $qrCodeFilePath2 = asset('public/'. $row->id . '.png');

        $qrCodes['simple'] = QrCode::format('png')->size(300)->generate($link);
        $file = fopen($qrCodeFilePath, 'wb');
        fwrite($file, $qrCodes['simple']);
        fclose($file);
        $row->qrCodeFilePath = $qrCodeFilePath2;
        $row->save();

        // بازگشت به صفحه لیست با پیام موفقیت
        return redirect()->route('marketingcard.edit', ['marketingcard' => $row->id])->with('success', 'رکورد با موفقیت ایجاد شد.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $row = MarketingCard::find($id);
        $row->expired = (int)$row->expiryDate/1000 < Carbon::today()->timestamp ? true : false;
        return view('marketingcard::show')->with([
            'person' => $row
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = MarketingCard::find($id);
        return view('marketingcard::edit')->with([
            'row' => $row
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'nationalId' => 'required|digits:10',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'fatherName' => 'required|string|max:255',
            'issueDate' => 'required',
            'expiryDate' => 'required',
        ]);


        $marketingCard = MarketingCard::findOrFail($id);
        $marketingCard->update($request->all());

        if (!$marketingCard->qrCodeFilePath) {
            $link = route('marketingcard.show', ['marketingcard' => $marketingCard->id]);
            $qrCodeFilePath = public_path($marketingCard->id . '.png');
            $qrCodeFilePath2 = asset('public/'. $marketingCard->id . '.png');
            $qrCodes['simple'] = QrCode::format('png')->size(300)->generate($link);
            $file = fopen($qrCodeFilePath, 'wb');
            fwrite($file, $qrCodes['simple']);
            fclose($file);
            $marketingCard->qrCodeFilePath = $qrCodeFilePath2;
            $marketingCard->save();
        }

        return response(trans('marketingTrans::msg.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function downloadQRCode($id)
    {
        $image = MarketingCard::find($id)->qrCodeFilePath;
        // تنظیم هدرهای دانلود
        return response()->download($image, 'qrcode.png', [
            'Content-Type' => 'image/png',
        ]);
    }
}
