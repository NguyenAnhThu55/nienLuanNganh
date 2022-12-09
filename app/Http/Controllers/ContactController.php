<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
// use Session;
use Illuminate\Support\Facades\Session;
use App\Models\Contact;
use Illuminate\Support\Facades\Redirect;
session_start();

use App\Models\Comment;
use App\Models\Rating;
use Livewire\WithFileUploads;
class ContactController extends Controller
{
    public function lien_he(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view('pages.contacts.contact')->with('category', $cate_product)->with('brand', $brand_product);
    }
}
