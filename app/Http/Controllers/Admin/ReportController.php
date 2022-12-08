<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Action;
use PhpParser\Node\Expr\New_;
use Yajra\Datatables\Datatables;

class ReportController extends Controller
{
    public function index()
    {
        $report_posts = Post::with('reports')->with('user')->get();

        //$report_posts=DB::table('posts')->get();
        return view('admin.socialmedia_report.index', compact('report_posts'));
    }

    public function ssd()
    {
        $report_counts= DB::select('SELECT count(reports.post_id)as report_count,post_id FROM `reports` group by reports.post_id;');
        $reports=Report::where('status',0)->get();

        foreach($reports as $key=>$value){
            foreach($report_counts as $rp_count){
                if($value->post_id==$rp_count->post_id){
                    $reports[$key]['rp_count']=$rp_count->report_count;
                }
            }
        }

        return Datatables::of($reports)
        ->editColumn('created_at', function ($each) {
            return $each->created_at->format('d M Y , g:i A'); // human readable format
          })
        ->addIndexColumn()
        ->addColumn('action', function ($each) {
            $view_icon = '';
            $delete_icon = '';

            $view_icon = '<a href=" ' . route('admin.view.report', $each->id) . ' " class="text-success mx-1 " title="view">
                        <i class="fa fa-folder-open fa-xl" data-id="' . $each->id . '"></i>
                    </a>';
            $delete_icon = '<a href=" ' . route('member.destroy', $each->id) . ' " class="text-danger mx-1" id="delete" title="delete">
                        <i class="fa-solid fa-trash fa-xl delete" data-id="' . $each->id . '"></i>
                    </a>';

                        return '<div class="d-flex justify-content-center">' . $view_icon . $delete_icon. '</div>';
                    })
        ->rawColumns(['action',''])
        ->make(true);

    }

    public function view_post(Request $request,$id)
    {
        $report=Report::findOrFail($id);
        $report_post=DB::table('reports')
                                ->where('post_id',$report->post_id)
                                ->leftjoin('posts','posts.id','reports.post_id')
                                ->get();
        //dd($report_post);
        return view('admin.socialmedia_report.view_report',compact('report'));
    }

    public function accept_report($report_id)
    {
        $report=Report::findOrFail($report_id);

        $post=Post::findOrFail($report->post_id);
        $post_id=$post->id;

        $rp_posts=Report::where('post_id',$post_id)->get();

        foreach($rp_posts as $rp_post){
            $rp_post->action_message='delete post';
            $rp_post->status=1;
            $rp_post->update();
        }

        $post->report_status=1;
        $post->update();

        return response()->json([
            'success' => 'Reported Post is deleted',
        ]);

    }

    public function decline_report($report_id)
    {
        $report=Report::findOrFail($report_id);
        $post=Post::findOrFail($report->post_id);
        $post_id=$post->id;

        $rp_posts=Report::where('post_id',$post_id)->get();

        foreach($rp_posts as $rp_post){
            $rp_post->status=2;
            $rp_post->update();
        }

        return response()->json([
            'success' => 'Reported Post is Decline',
        ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
