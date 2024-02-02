@extends('layouts.app')

@section('template_title')
    {{ $paymentMethod->name ?? "{{ __('Show') Payment Method" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Payment Method</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('payment_methods.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Card Number:</strong>
                            {{ $paymentMethod->card_number }}
                        </div>
                        <div class="form-group">
                            <strong>Exp Time:</strong>
                            {{ $paymentMethod->exp_time }}
                        </div>
                        <div class="form-group">
                            <strong>Type Pay:</strong>
                            {{ $paymentMethod->type_pay }}
                        </div>
                        <div class="form-group">
                            <strong>Code-Card:</strong>
                            {{ $paymentMethod->code_card }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $paymentMethod->price }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
