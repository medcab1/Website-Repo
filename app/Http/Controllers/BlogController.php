<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booking_view;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Factory;
use App\Models\users;
use App\Models\booking_addons;
use Validator;
use Input;
use Session;
use Carbon;

class BlogController extends Controller
{
    public function blogs_view()
    {
        $blogs = DB::table('blog')->where('blog_status', '=', 0)->orderBy('blog_id', 'DESC')->select('blog_id', 'blog_title', 'blog_sku', 'blog_meta_desc', 'blog_thumbnail', 'blog_post_date')->paginate(14);
        $links = $blogs->toArray()['links'];
        // dd($links);
        return view('blog')->with(compact('blogs', 'links'));
    }
    public function blog_detail($title)
    {
        $blog = DB::table('blog')->where('blog_sku', $title)->where('blog_status', 0)->first();

        $blogs = DB::table('blog')
            ->where('blog_status', 0)
            ->orderBy('blog_id', 'DESC')
            ->select('blog_id', 'blog_title', 'blog_sku', 'blog_meta_desc', 'blog_thumbnail', 'blog_post_date')
            ->paginate(3);

        return view('blog_detail', compact('blog', 'blogs'));
    }

    public function city_content($title)
    {
        $city = DB::table('city_content')->where('city_name', $title)->get();
        $faq = DB::table('city_faq')->where('city_id', $city[0]->city_id)->get();
        $lucknow_hospitals = DB::table('hospital_lists')->where('hospital_city_name', 4933)->limit(20)->get();

        return view('city')->with('city', $city[0])->with('faq', $faq)->with('lucknow_hospitals', $lucknow_hospitals);
    }




    public function blog_filter(Request $request, $search_key)
    {

        $tableName = 'blog'; // Replace with your table name
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        $query = DB::table($tableName);
        if ($search_key == 'all') {
            $results = $query->get();
        } else {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', '%' . $search_key . '%');
            }
            $results = $query->get();
        }
        // dd($query->toArray());
        return redirect()->back()->with('blogs', $results);
    }
    public function saveBlog(Request $request)
    {
        $blog_thumbnail = "";
        if ($request->file('blog_thumbnail') != null) {
            $blog_thumbnail = "blog_thumbnail" . time() . '.' . $request->file('blog_thumbnail')->extension();
        }
        $saveblog = DB::table('blog')
            ->insert([
                'blog_sku' => $request->input('blog_sku'),
                'blog_title' => $request->input('blog_title'),
                'blog_desc' => $request->input('blog_desc'),
                'blog_post_date' => $request->input('blog_post_date'),
                'blog_thumbnail' => "assets/blogs/" . $blog_thumbnail,
                'blog_meta_title' => $request->input('blog_meta_title'),
                'blog_meta_desc' => $request->input('blog_meta_desc'),
                'blog_meta_keyword' => $request->input('blog_meta_keyword'),
                'blog_force_keyword' => $request->input('blog_force_keyword'),
                'blog_thumbnail_alt' => $request->input('blog_thumbnail_alt'),
                'blog_status' => $request->input('blog_status'),
            ]);
        if ($saveblog) {
            if ($request->file('blog_thumbnail') != null) {
                $upload = $request->file('blog_thumbnail')->move(public_path('assets/blogs'), $blog_thumbnail);
                if ($upload) {
                    return redirect('https://madmin.medcab.in/blogs/view_blogs');
                } else {
                    return redirect()->back()->with('blog_status', 'Failed to add/upload Blog!');
                }
            } else {
                return redirect('https://madmin.medcab.in/blogs/view_blogs');
            }
        } else {
            return redirect()->back()->with('blog_status', 'Failed to add Blog!');
        }
    }

    public function updateBlog(Request $req, $id)
    {
        $blog_thumbnail = $req->input('blog_thumbnail_name');
        if ($req->file('blog_thumbnail') != null) {
            $blog_thumbnail = "blog_thumbnail" . time() . '.' . $req->file('blog_thumbnail')->extension();
        }
        $updateblog = DB::table('blog')->where('blog_id', '=', $id)
            ->update([
                'blog_sku' => $req->input('blog_sku'),
                'blog_title' => $req->input('blog_title'),
                'blog_desc' => $req->input('blog_desc'),
                'blog_post_date' => $req->input('blog_post_date'),
                'blog_thumbnail' => "assets/blogs/" . $blog_thumbnail,
                'blog_meta_title' => $req->input('blog_meta_title'),
                'blog_meta_desc' => $req->input('blog_meta_desc'),
                'blog_meta_keyword' => $req->input('blog_meta_keyword'),
                'blog_force_keyword' => $req->input('blog_force_keyword'),
                'blog_thumbnail_alt' => $req->input('blog_thumbnail_alt'),
                'blog_status' => $req->input('blog_status'),
            ]);
        if ($updateblog) {
            if ($req->file('blog_thumbnail') != null) {
                $upload = $req->file('blog_thumbnail')->move(public_path('assets/blogs'), $blog_thumbnail);
                if ($upload) {
                    // return redirect()->back()->with('blog_success','Updated Successfully');
                    return redirect('https://madmin.medcab.in/blogs/view_blogs');
                } else {
                    return redirect()->back()->with('blog_error', 'Failed to Update/Upload Blog!');
                }
            } else {
                return redirect('https://madmin.medcab.in/blogs/view_blogs');
            }
        } else {
            return redirect()->back()->with('blog_error', 'Failed to Update Blog!');
        }
    }
}
