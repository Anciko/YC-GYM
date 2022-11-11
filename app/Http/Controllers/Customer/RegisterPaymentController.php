<?php

namespace App\Http\Controllers\Customer;

use App\Models\Payment;
use App\Models\BankingInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterPaymentController extends Controller
{
    //
    public function payment()
    {
        $banking_info = BankingInfo::all();

        return view('customer.payment',compact('banking_info'));
    }

    public function changeStatusAndType($id)
    {
        $banking_info = BankingInfo::all();

        $member = Member::findOrFail($id);

        $auth_user = auth()->user();
        $user = User::findOrFail($auth_user->id);
        $user->request_type = $member->id;

        $user->update();

        return view('customer.payment',compact('banking_info'));

    }

    // public function test()
    // {

    //     $banking_info = BankingInfo::all();
    //     return view('customer.payment_test',compact('banking_info'));
    // }
    public function ewallet_store(Request $request)
    {
        $this->validate($request,[
            'account_name'=> 'required|regex:/^[\pL\s\-]+$/u',
            'payment_name' => 'required',
            'phone'=> 'required|min:9|max:11',
            'amount'=> 'required',
            'image' => 'required',
        ]);
        //dd($request->all());
        $user = auth()->user();

        $user = User::findOrFail($user->id);
        $user->active_status = 1;


        $user->update();
         // Store Image
         if($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = uniqid() . '_' . $image->getClientOriginalName();
            Storage::disk('local')->put(
                'public/payments/'.$imgName,
                file_get_contents($image)
            );
        }
        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->payment_type = 'ewallet';
        $payment->account_name = $request->account_name;
        $payment->payment_name = $request->payment_name;
        $payment->phone = $request->phone;
        $payment->amount = $request->amount;
        $payment->photo = $imgName;
        $payment->save();
        if ($payment) {
            Alert::success('Success', 'Payment Successfull!');
            return redirect()->route('social_media');
        }
        else {
            Alert::error('Failed', 'Payment failed!');
            return back();
        }
    }



    public function bank_payment_store(Request $request)
    {
            $this->validate($request,[
            'bank_account_number'=> 'required|min:10',
            'bank_account_holder' => 'required|regex:/^[\pL\s\-]+$/u',
            'amount'=> 'required',
            'image' => 'required',
        ]);
        //dd($request->all());
        $user = auth()->user();
        $user = User::findOrFail($user->id);
        $user->active_status = 1;
        $user->update();
         // Store Image
         if($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = uniqid() . '_' . $image->getClientOriginalName();
            Storage::disk('local')->put(
                'public/payments/'.$imgName,
                file_get_contents($image)
            );
        }
        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->payment_type = 'banking';
        $payment->bank_account_number = $request->bank_account_number;
        $payment->bank_account_holder = $request->bank_account_holder;
        $payment->payment_name = $request->payment_name;
        $payment->amount = $request->amount;
        $payment->photo = $imgName;
        $payment->save();
        if ($payment) {
            Alert::success('Success', 'Payment Successfull!');
            return redirect('/home');
        }
        else {
            Alert::error('Failed', 'Payment failed! Please Try Again!');
            return back();
        }
    }
}
