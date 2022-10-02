<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BlogCategory;
use App\Models\MultiImage;
use Intervention\Image\ImageManagerStatic as Image;


class BlogController extends Controller
{

    public function allBlog(){
        $blogs = Blog::latest()->get();
        return view('admin.blog.blog_all', compact('blogs'));
    }

    public function addBlog(){
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blog.blog_add', compact('categories'));
    }

    public function storeBlog(Request $request){

        $request->validate([
            'blog_title' => 'required',
            'blog_description' => 'required',
            'blog_tags' => 'required',
            'blog_category_id' => 'required',
            'blog_image' => 'required'
        ]);

        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(430,327)->save('upload/blog_images/'.$name_gen);
        $save_url = 'upload/blog_images/'.$name_gen;

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->blog_description,
            'blog_image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification);

    }


    public function editBlog($id){
        $blog = Blog::findorFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blog.blog_edit', compact('blog', 'categories'));
    }

    public function updateBlog(Request $request){

        $blog_id = $request->id;

        if($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(1020,519)->save('upload/portfolio_images/'.$name_gen);
            $save_url = 'upload/portfolio_images/'.$name_gen;

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Blog Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);

        }else {

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
            ]);

            $notification = array(
                'message' => 'Blog Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);

        }

    }

    public function deleteBlog($id){

        $blog = Blog::findorFail($id);
        $image = $blog->blog_image;
        unlink($image);

        Blog::findorFail($id)->delete();

        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function detailBlog($id){

        $blog = Blog::findorFail($id);
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $allMultiImage = MultiImage::latest()->limit(3)->get();
        return view('frontend.blog_details', compact('blog', 'allblogs', 'categories', 'allMultiImage'));

    }

    public function categoryBlog($id){
        $blogpost = Blog::where('blog_category_id', $id)->orderBy('id', 'DESC')->paginate(3);
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $category = BlogCategory::findorFail($id);
        $allMultiImage = MultiImage::latest()->limit(3)->get();

        return view('frontend.cat_blog_details', compact('blogpost', 'allblogs', 'categories', 'category', 'allMultiImage'));
    }

    public function homeBlog(){
        $allblogs = Blog::latest()->paginate(3);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $allMultiImage = MultiImage::latest()->limit(3)->get();
        return view('frontend.blog', compact('allblogs', 'categories', 'allMultiImage'));
    }


}
