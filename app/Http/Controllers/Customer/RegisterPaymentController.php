<?php

namespace App\Http\Controllers\Customer;

use App\Models\Payment;
use App\Models\BankingInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            return redirect()->route('home');
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
        $payment->payment_type = 'bank';
        $payment->bank_account_number = $request->bank_account_number;
        $payment->bank_account_holder = $request->bank_account_holder;
        $payment->payment_name = $request->payment_name;
        $payment->amount = $request->amount;
        $payment->photo = $imgName;
        $payment->save();
        if ($payment) {
            Alert::success('Success', 'Payment Successfull!');
            return redirect('/');
        }
        else {
            Alert::error('Failed', 'Payment failed! Please Try Again!');
            return back();
        }
    }
}
