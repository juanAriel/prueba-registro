<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
/**
 * Class PaymentMethodController
 * @package App\Http\Controllers
 */
class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::paginate();

        return view('payment_method.index', compact('paymentMethods'))
            ->with('i', (request()->input('page', 1) - 1) * $paymentMethods->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentMethod = new PaymentMethod();
        return view('payment_method.create', compact('paymentMethod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(PaymentMethod::$rules);

        // Configura la clave secreta de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Crea un intento de pago en Stripe
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->price * 100, // La cantidad se especifica en centavos
                'currency' => 'usd', // Cambia a tu moneda preferida si es diferente
                'payment_method_types' => ['card'],
                'description' => 'Compra en tu aplicación', // Descripción del pago
            ]);

            // Si el pago se confirma, se redirecciona a la vista de índice con un mensaje de éxito
            return redirect()->route('payment_methods.index')
                ->with('success', 'Pago realizado exitosamente.');
        } catch (\Exception $e) {
            // Si hay un error durante el proceso de pago, se redirecciona de vuelta al formulario de creación con un mensaje de error
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        return view('payment_method.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        return view('payment_method.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        request()->validate(PaymentMethod::$rules);

        $paymentMethod->update($request->all());

        return redirect()->route('payment_methods.index')
            ->with('success', 'PaymentMethod updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id)->delete();

        return redirect()->route('payment_methods.index')
            ->with('success', 'PaymentMethod deleted successfully');
    }
}
