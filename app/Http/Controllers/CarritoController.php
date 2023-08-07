<?php

namespace App\Http\Controllers;

use App\Configuracion;
use App\SProducto;
use App\Carrito;
use Illuminate\Http\Request;

use Session;
use Auth;
use Stripe\Charge;
use Stripe\Stripe;
use App\SOrder;

class CarritoController extends Controller
{
    public function getAddToCart(Request $request, $id) {
        $product = SProducto::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Carrito($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));
        return redirect()->route('front.tienda');
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Carrito($oldCart);
        $cart->reduceByOne($id);

        if(count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('shoppingCart');
    }

    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Carrito($oldCart);
        $cart->removeItem($id);

        if(count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('shoppingCart');
    }

    public function getCart() {
        $data = Configuracion::first();
        if(!Session::has('cart')) {
            return view('front.carrito.shopping-cart', ['products' => null, 'data' => $data]);
        }

        $oldCart = Session::get('cart');
        $cart = new Carrito($oldCart);
        return view('front.carrito.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'data' => $data]);
    }

    public function getCheckoutStripe() {
        $data = Configuracion::first();
        if(!Session::has('cart')) {
            return view('front.carrito.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Carrito($oldCart);
        $total = $cart->totalPrice;

        return view('front.carrito.checkoutStripe', ['total' => $total, 'data' => $data]);
    }

    public function postCheckoutStripe(Request $request) {
        if(!Session::has('cart')) {
            return redirect()->route('shoppingCart');
        }

        $oldCart = Session::get('cart');
        $cart = new Carrito($oldCart);

        Stripe::setApiKey('sk_test_51Nb8P9Kuq6E1vXOyXhk1dDg9nNnmZ8y5Beo9eIaHvdGkvTNhOcmYYxIMpEm2YScJOWWJSBXCCaPDvCUwzTaUcRvg00a0oFXRax');
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                // "source" => $request->input('stripeToken'), // Obtained with Stripe.js source or customer
                "source" => "tok_mastercard",
                "description" => "Test Charge"
            ));
            $order = new SOrder();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
        } catch(\Exception $e) {
            return redirect()->route('checkoutStripe')->with('error', $e->getMessage());
        }

        Session::forget('cart');
        return redirect()->route('user.profile')->with('success', 'Successfully purchased products!');
    }
}
