@extends('layouts.app')

@section('template_title')
    {{ $plan->name ?? "{{ __('Show') Plan" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Plan</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('plans.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $plan->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $plan->description }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $plan->price }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
