<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\cart;
use App\Models\order;
use App\Models\transaction;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Application;
use Illuminate\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\DemoMail;



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

    

    public function create_order(Request $request ) {
                // var_dump($request->post());  
                $userid = auth()->user()->id;
                $data = $request->post();
                $data=$data['data'];
                $products="";
                $total=0;
                foreach($data as $prods){
                    // var_dump($prods);
                    $products.=$prods['productname']." x quantity (".$prods['quantity'].") total (".$prods['totcharge'].") ,  ";
                    $total=$total+$prods['totcharge'];
                }       
                // echo $products;
                // echo $total;
                $order = order::create([
                    'userid'=> $userid,
                    'transactid' => 0,
                    'products' => $products,
                    'total' => $total,
                    'status' =>0
                ]);
                $orderid= $order->id;

                
        $mailData = [
            'title' => 'Mail from Life.com',
            'body' => 'Your order is created  for '.$products
        ];

        Mail::to($request->email)->send(new notfmail($mailData));

                $transaction = transaction::create([
                    'userid'=> $userid,
                    'orderid' => $orderid,
                    'products' => $products,
                    'status' =>0
                ]);

                $transactid = $transaction->id;
                
                order::where('id','=',$orderid)->update(array('transactid'=>$transactid));

                $tr = transaction::where('userid','=',$userid)->get();

                return Inertia::render('transactions',['transactions'=>$tr]);

    }

    public function transactions() {

        $userid = auth()->user()->id;

        $tr = transaction::where('userid','=',$userid)->get();

        // var_dump($tr);

        return Inertia::render('transactions',['transactions'=>$tr]);

    }

    public function update_trans(Request $request) {
        $userid = auth()->user()->id;

        var_dump($request->post());

        $tr = transaction::where('id','=',$request->id)->update(array('status'=>$request->status));

        $trans = transaction::where('id','=',$request->id)->get();


    
        $mailData = [
            'title' => 'Mail from Life.com',
            'body' => 'Status for your order no'.$trans->orderid.' is '.$trans->status
        ];

        Mail::to($request->email)->send(new notfmail($mailData));

        return Inertia::render('transactions',['transactions'=>$trans]);


    }

    public function orders() {

        $userid = auth()->user()->id;

        $or = order::where('userid','=',$userid)->get();


        return Inertia::render('orders',['orders'=>$or]);

    }

    public function search_order(Request $request) {

        $userid = auth()->user()->id;

        if($request->id){
            
        $or = order::find($request->id);
        var_dump($or);
        // return Inertia::render('orders',['orders'=>$or,'orderid'=>$or->id]);
        }
        else {
            
        $or = order::where('userid','=',$userid)->get();

        // var_dump($or->attributes);

        return Inertia::render('orders',['orders'=>$or,'orderid'=>$or]);
        }


    }

    
}
