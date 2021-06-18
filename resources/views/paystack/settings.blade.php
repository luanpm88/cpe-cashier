@extends('layouts.backend')

@section('title', trans('cashier::messages.paystack'))

@section('page_script')
	<script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/validate.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/tinymce/tinymce.min.js') }}"></script>
        
    <script type="text/javascript" src="{{ URL::asset('js/editor.js') }}"></script>
@endsection

@section('page_header')

    <div class="page-title">
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ action("HomeController@index") }}">{{ trans('messages.home') }}</a></li>
            <li><a href="{{ action("Admin\PaymentController@index") }}">{{ trans('messages.payment_gateways') }}</a></li>
            <li class="active">{{ trans('messages.update') }}</li>
        </ul>
        <h1>
            <span class="text-semibold"><i class="icon-credit-card2"></i> {{ trans('cashier::messages.paystack') }}</span>
        </h1>
    </div>

@endsection

@section('content')
		<div class="row">
			<div class="col-md-6">
				<p>
					{!! trans('cashier::messages.paystack.intro') !!}
				</p>
			</div>
		</div>
			
		<h3>{{ trans('cashier::messages.payment.options') }}</h3>

        <form enctype="multipart/form-data" action="{{ $gateway->getSettingsUrl() }}" method="POST" class="form-validate-jquery">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    @include('helpers.form_control', [
                        'type' => 'text',
                        'name' => 'public_key',
                        'value' => $gateway->publicKey,
                        'label' => trans('cashier::messages.paystack.public_key'),
                        'help_class' => 'payment',
                        'rules' => ['public_key' => 'required'],
                    ])

                    @include('helpers.form_control', [
                        'type' => 'text',
                        'name' => 'secret_key',
                        'value' => $gateway->secretKey,
                        'label' => trans('cashier::messages.paystack.secret_key'),
                        'help_class' => 'payment',
                        'rules' => ['secret_key' => 'required'],
                    ])
                </div>
            </div>


            <hr>
            <div class="text-left">
                @if (!\Acelle\Library\Facades\Billing::isGatewayEnabled($gateway))
                    <input type="submit" name="enable_gateway" class="btn btn-mc_primary mr-5" value="{{ trans('cashier::messages.save_and_enable') }}" />
                @endif
                <button class="btn btn-mc_default mr-5">{{ trans('messages.save') }}</button>
                <a class="btn btn-mc_default" href="{{ action('Admin\PaymentController@index') }}">{{ trans('messages.cancel') }}</a>
            </div>

        </form>

@endsection