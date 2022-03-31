<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\cart;
use App\Models\order;
use App\Models\transaction;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Auth;
use Illuminate\Support\Facades\DB;



// use Request;
// use Illuminate\Http\Redirect;


use Inertia\Inertia;

class employeeController extends Controller
{
    //
    public function index() {
        return Inertia::render('Dashboard',['product' => product::all()->map(function($p){
            return [
                'id' => $p->id,
                'productname' => $p->productname,
                'desc' => $p->desc,
                'price' => $p->price,
                'img'=>asset('storage/app/public/'.$p->img),
            ];
        })
        // ,'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
    }

    public function create() {
        return Inertia::render('create');
    }

    
    public function addproduct() {
        return Inertia::render('Add_product');
    }

    public function store(Request $request) {
        // var_dump($request->post());
        $image = $request->image->store('products','public');
        // echo $image;
        product::create([
            'productname' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
            'img' => $image,
        ]);
        return Inertia::render('Dashboard',['product' => product::all()->map(function($p){
            return [
                'id' => $p->id,
                'productname' => $p->productname,
                'desc' => $p->desc,
                'price' => $p->price,
                'img'=>asset('storage/app/public/'.$p->img),
            ];
        })

        // ,'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
    }

    public function edit($emp) {
        return Inertia::render('edit',
    ['employee'=>employee::find($emp)]);
    }

    public function cart_add(Request $request) {
        $userid = auth()->user()->id;
            $prodid = $request->id;
            $price=(int)($request->price);
            $quantity=(int)($request->quantity);
            $tot=$quantity*$price;
            cart::create([
                'userid'=> $userid,
                'productid' => $prodid,
                'quantity' => $quantity,
                'totcharge' => $tot
            ]);

return back();
        // $carts = cart::where('userid',$userid);
    }

    public function cart(){
        $userid = auth()->user()->id;
        $cart = DB::table('carts')->join('products','carts.productid','=','products.id')
                                  ->join('users','carts.userid','=','users.id')
                                  ->select('carts.id','carts.quantity','carts.totcharge','products.productname','products.price')
                                  ->where('carts.userid','=',$userid)
                                  ->get();
                                //   var_dump($cart);
                    return Inertia::render('cart',['cart'=>$cart]);
    }

    public function update($emp,Request $request) {
        employee::where('id','=',$emp)->update(array('name'=>$request->name));
        $emp = employee::find($emp);
        echo $emp;

        // return Inertia::render('employee');
    }

    public function cart_delete($cartid) {
        cart::where('id','=',$cartid)->delete();

        return back();
        
    }

    
}
