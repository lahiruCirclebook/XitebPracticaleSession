<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPrescription;
use App\Models\Quotation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class pharmacyController extends Controller
{
    //get uploaded prescription list
    public function PrescriptionList()
    {
        $prescriptions = DB::table('user_prescriptions')
            ->join('users', 'users.userId', '=', 'user_prescriptions.userId')
            ->where('user_prescriptions.isActive', '=', 1)
            ->select('users.*', 'user_prescriptions.*')
            ->get();

        return view('Pharmacy.pharmacy', compact(['prescriptions']));
    }

    //prepare Quotation
    public function PrepareQuotation()
    {
        $customText = '';
        $whatsappNumber = env('WHATSAPP_NUMBER');

        $customText = 'Your prescription order is ready for delivery.. If you confirm it, send a short message with "Yas" or "No" if you reject it.';

        $urlString = "https://wa.me/" . $whatsappNumber . "?text=Mr/Ms%20-%20" . 'Hi Happy Customer' . '%0a' . $customText;
        return view('Pharmacy.prepareQuotation', compact(['urlString']));
    }

    //add quotation
    public function AddQuotation(Request $request)
    {
        $users = DB::table('users')
            ->join('user_prescriptions', 'user_prescriptions.userId', '=', 'users.userId')
            ->where('user_prescriptions.isActive', '=', 1)
            ->select('users.userId')
            ->get();

        foreach ($users as  $user) {
            $userId =  $user->userId;
        }


        for ($i = 0; $i < count($request->input('date')); $i++) {

            $quotationId = Str::random(7);

            if (Quotation::where('quotationId', '=', $quotationId)->exists()) {
                $quotationId = Str::random(7);
            }

            $quotation = new  Quotation;


            $quotation->quotationId = $quotationId;
            $quotation->userId = $userId;
            $quotation->date = $request->date[$i];
            $quotation->drug = $request->drug[$i];
            $quotation->price = $request->price[$i];
            $quotation->quantity = $request->quantity[$i];
            $quotation->amount = $request->amount[$i];
            $quotation->isActive = 1;

            $quotation->save();
        }

        UserPrescription::where(['userId' => $userId])->update([
            'isActive' => 0,

        ]);
        return redirect()
            ->back();
    }

    /*here, i configure the whatsapp to notify the our customer who can accept or ignore the quotation by communicate through the whatsapp */
    private function ByWhatsapp(): string
    {

        $customText = '';
        $whatsappNumber = env('WHATSAPP_NUMBER');

        $customText = 'Your prescription order is ready for delivery.. If you confirm it, send a short message with "Yas" or "No" if you reject it.';

        $urlString = "https://wa.me/" . $whatsappNumber . "?text=Mr/Ms%20-%20" . 'Hi Happy Customer' . '%0a' . $customText;


        return $urlString;
    }
}
