@extends('layouts.app')

@section('template_title')
    Payment Method
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Payment Method') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('payment_methods.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Card Number</th>
										<th>Exp Time</th>
										<th>Type Pay</th>
										<th>Code-Card</th>
										<th>Price</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $paymentMethod->card_number }}</td>
											<td>{{ $paymentMethod->exp_time }}</td>
											<td>{{ $paymentMethod->type_pay }}</td>
											<td>{{ $paymentMethod->code_card }}</td>
											<td>{{ $paymentMethod->price }}</td>

                                            <td>
                                                <form action="{{ route('payment_methods.destroy',$paymentMethod->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('payment_methods.show',$paymentMethod->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('payment_methods.edit',$paymentMethod->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $paymentMethods->links() !!}
            </div>
        </div>
    </div>
@endsection
