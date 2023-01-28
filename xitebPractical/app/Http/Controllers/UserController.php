<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;
use App\Models\User;
use App\Models\UserPrescription;
use App\Models\Quotation;
use Carbon\Carbon;

class UserController extends Controller
{

    //login
    /*if email is equal to the $request->email and password is equal to
     the $request->password then user can login to the system*/
    public function Login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $email = Auth::user()->email;


            session()->put('id', $id);
            session()->put('name', $name);

            /*here, email is equal to the admin@gmail.com and name is equal to the 'admin' it redirect to the
             '/prescriptions' route. and else it redirect to the '/users' route
            */
            if ($email == "admin@gmail.com" || $name == "admin") {
                return redirect('/prescriptions');
            } else {
                return redirect('/users');
            }
        } else {

            return view('home.login')->withErrors(['Incorrect Login Details', 'The Message']);
        }
    }

    //logout
    public function Logout()
    {

        session()->forget('name');
        session()->forget('id');
        session()->flush();

        return redirect('/');
    }

    //user registration
    public function UserRegister(Request $request)
    {

        /*here, user's email is validated as a uniq email for each users */
        $this->validate($request, [
            'email' => 'unique:users'
        ]);

        $userId = Str::random(7);

        $user = new User;

        $user->userId = $userId;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('/');
    }

    //upload the prescription
    public function AddPrescription(Request $request)
    {
        $prescriptionId = Str::random(7);
        $userId = Auth::user()->userId;

        if (UserPrescription::where('prescriptionId', '=', $prescriptionId)->exists()) {
            $prescriptionId = Str::random(7);
        }
        if (
            UserPrescription::where('prescriptionId', '=', $request->prescriptionId)->exists()
        ) {
            return redirect()
                ->back()
                ->with('error', 'This prescription is already added');
        }
        if (!empty($request->prescriptionImage)) {
            /*$prescriptionImage = $request->prescriptionImage->getClientOriginalName();
            $prescriptionImagePath = $request->prescriptionImage->move(
                base_path('public/prescriptionImages'),
                $prescriptionImage
            );*/

            $prescriptionImage = array();
            if ($files = $request->file('prescriptionImage')) {
                foreach ($files as $file) {
                    $imageName = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $imageFullName = $imageName . "." . $ext;
                    $uploadPath = 'public/prescriptionImage/';
                    $imageUrl = $uploadPath . $imageFullName;
                    $file->move($uploadPath, $imageFullName);
                    $prescriptionImage[] = $imageUrl;
                }
            }

            $userPrescription = new UserPrescription();

            $userPrescription->prescriptionId = $prescriptionId;
            $userPrescription->userId = $userId;
            $userPrescription->prescriptionImage = implode('|', $prescriptionImage);
            $userPrescription->note = $request->note;
            $userPrescription->deliveryAddress = $request->deliveryAddress;
            $userPrescription->deliveryTime = $request->deliveryTime;
            $userPrescription->isActive = 1;


            $userPrescription->save();
        } else {

            $userPrescription = new UserPrescription();

            $userPrescription->prescriptionId = $prescriptionId;
            $userPrescription->userId = $userId;
            $userPrescription->prescriptionImage = 'default.png';
            $userPrescription->note = $request->note;
            $userPrescription->deliveryAddress = $request->deliveryAddress;
            $userPrescription->deliveryTime = $request->deliveryTime;
            $userPrescription->isActive = 1;

            $userPrescription->save();
        }
        return redirect()
            ->back()
            ->with('message', 'Prescription Uploaded Successfully');
    }

    //view prepared quotation
    public function ViewPreparedQuotation()
    {
        $preparedQuotation = DB::table('quotations')
            ->join('users', 'users.userId', '=', 'quotations.userId')
            ->where('quotations.isActive', '=', 1)
            ->select('quotations.*')
            ->get();

        $total = Quotation::where('isActive', 1)
            ->where(
                'date',
                '>=',
                Carbon::now()
                    ->subDays(30)
                    ->toDateTimeString()
            )
            ->sum('amount');

        return view('Users.viewPreparedQuotation', compact(['preparedQuotation', 'total']));
    }
}
