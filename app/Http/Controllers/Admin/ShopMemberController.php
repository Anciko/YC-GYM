<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\ShopMember;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTrainerRequest;
use App\Http\Requests\CreateShopMemberRequest;


class ShopMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.shop_member.index');
    }

    public function ssd()
    {
        $shop_members = ShopMember::all();

        return Datatables::of($shop_members)
            ->addIndexColumn()
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format("Y-m-d H:i:s");
            })
            ->addColumn('action', function ($each) {
                $edit_icon = '';
                $detail_icon = '';
                $delete_icon = '';

                $edit_icon = '<a href=" ' . route('trainer.edit', $each->id) . ' " class="text-warning mx-1 " title="edit">
                                    <i class="fa-solid fa-edit fa-xl"></i>
                              </a>';
                $detail_icon = '<a href=" ' . route('trainer.show', $each->id) . ' " class="text-info mx-1" title="detail">
                                    <i class="fa-solid fa-circle-info fa-xl"></i>
                                </a>';

                $delete_icon = '<a href=" ' . route('trainer.destroy', $each->id) . ' " class="text-danger mx-1              delete-btn" title="delete"  data-id="' . $each->id . '" >
                                    <i class="fa-solid fa-trash fa-xl"></i>
                                </a>';

                return '<div class="d-flex justify-content-center">' . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop_member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShopMemberRequest $request)
    {
        $shop_member = new ShopMember();
        $shop_member->member_type = $request->member_type;
        $shop_member->duration = $request->duration;
        $shop_member->price = $request->price;
        $shop_member->cons = $request->cons;
        $shop_member->pros = $request->pros;

        $shop_member->save();

        return redirect()->route('shop-member.index')->with('success', 'New ShopMember is created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.trainers.show', compact(''));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainer = User::findOrFail($id);

        $roles = Role::all();
        $old_roles = $trainer->roles->pluck('id')->toArray();
        return view('admin.trainers.edit', compact('trainer', 'roles', 'old_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrainerRequest $request, $id)
    {
        $trainer = User::findOrFail($id);
        $trainer->name = $request->name;
        $trainer->phone = $request->phone;
        $trainer->training_type = $request->training_type;
        $trainer->address = $request->address;

        $trainer->password = $request->password == null ? $trainer->password  : Hash::make($request->password);

        $trainer->update();
        $trainer->syncRoles($request->role);
        return redirect()->route('trainer.index')->with('success', 'Trainer is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainer = User::findOrFail($id);
        $trainer->delete();

        return 'success';
    }
}
