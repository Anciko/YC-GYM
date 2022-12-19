<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ShopmemberHistory;

class ShopRequestController extends Controller
{
    public function index()
    {
        return view('admin.shop_request.index');
    }

    public function ssd()
    {
        $shop_request =  DB::table('users')->select('id', 'name', 'shopmember_type')->where('shop_request', 1)->get();

        return Datatables::of($shop_request)
            ->addIndexColumn()
            ->addColumn('action', function ($each) {
                $edit_icon = '';
                $delete_icon = '';
                $detail_icon = '';

                $detail_icon = '<a href=" ' . route('payment.detail', $each->id) . ' " class="text-warning mx-1 mt-1" title="payment">
                                        <i class="fa-solid fa-circle-info fa-xl"></i>
                              </a>';

                $edit_icon = '<a href=" ' . route('admin.shop_request.accept', $each->id) . ' " class="mx-1 btn btn-sm btn-success">
                                    Accept
                              </a>';

                $delete_icon = '<a href=" ' . route('admin.shop_request.decline', $each->id) . ' " class="mx-1 btn btn-sm delete-btn btn-danger" data-id="' . $each->id . '" >
                                    Decline
                                </a>';

                return '<div class="d-flex justify-content-center">' . $detail_icon . $edit_icon . $delete_icon . '</div>';
            })
            ->make(true);
    }

    public function request_accept($id)
    {
        $user = User::findOrFail($id);
        $user->shop_request = 2;
        $user->save();

        $date  = Carbon::Now()->toDateString();

        ShopmemberHistory::create([
            'user_id'=>$id,
            'shopmember_type_id'=>1,
            'date'=> $date
        ]);
    }
}
