<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;

class BlogCaterogyController extends Controller
{
    public function allBlogCategory(){
        $blogcategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all', compact('blogcategory'));
    }

    public function addBlogCategory(){
        return view('admin.blog_category.add_blog_category');
    }

    public function storeBlogCategory(Request $request){

        $request->validate([
            'blog_category' => 'required',
        ], [
            'blog_category.required' => 'Blog Category is Required',
        ]);


        BlogCategory::insert([
            'blog_category' => $request->blog_category,
        ]);

        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);

    }

    public function editBlogCategory($id){

        $blogcategory = BlogCategory::findorFail($id);
        return view('admin.blog_category.edit_blog_category', compact('blogcategory'));
    }

    public function updateBlogCategory(Request $request, $id){

        BlogCategory::findOrFail($id)->update([
            'blog_category' => $request->blog_category
        ]);

        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);
    }

    public function deleteBlogCategory($id){

        $blogcategory = BlogCategory::findorFail($id);

        BlogCategory::findorFail($id)->delete();

        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

}
