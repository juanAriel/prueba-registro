<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('card_number') }}
            {{ Form::text('card_number', $paymentMethod->card_number, ['class' => 'form-control' . ($errors->has('card_number') ? ' is-invalid' : ''), 'placeholder' => 'Card Number']) }}
            {!! $errors->first('card_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('exp_time') }}
            {{ Form::text('exp_time', $paymentMethod->exp_time, ['class' => 'form-control' . ($errors->has('exp_time') ? ' is-invalid' : ''), 'placeholder' => 'Exp Time']) }}
            {!! $errors->first('exp_time', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type_pay') }}
            {{ Form::text('type_pay', $paymentMethod->type_pay, ['class' => 'form-control' . ($errors->has('type_pay') ? ' is-invalid' : ''), 'placeholder' => 'Type Pay']) }}
            {!! $errors->first('type_pay', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('code_card') }}
            {{ Form::text('code_card', $paymentMethod->code_card, ['class' => 'form-control' . ($errors->has('code_card') ? ' is-invalid' : ''), 'placeholder' => 'Code_Card']) }}
            {!! $errors->first('code_card', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price') }}
            {{ Form::text('price', $paymentMethod->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Price']) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>