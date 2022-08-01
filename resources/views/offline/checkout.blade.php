@extends('user.layouts.main')

@section('title', trans('messages.subscriptions'))

@section('page_header')

    <div class="page-title">
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li class="breadcrumb-item"><a href="{{ route('/') }}">{{ trans('messages.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('messages.subscription') }}</li>
        </ul>
    </div>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h2>{!! trans('cashier::messages.pay_invoice') !!}</h2>  

            <div class="alert alert-info bg-grey-light">
                {!! $service->getPaymentInstruction() !!}
            </div>
            <hr>
                
            <div class="d-flex align-items-center">
                <form method="POST"
                    action="{{ \Acelle\Cashier\Cashier::lr_action('\Acelle\Cashier\Controllers\OfflineController@claim', [
                        'invoice_uid' => $invoice->uid
                    ]) }}"
                >
                    {{ csrf_field() }}
                    <button
                        class="btn btn-primary mr-10 mr-4"
                    >{{ trans('cashier::messages.offline.claim_payment') }}</button>
                </form>

                <form id="cancelForm" method="POST" action="{{ action('App\Http\Controllers\User\SubscriptionController@cancelInvoice', [
                            'invoice_uid' => $invoice->uid,
                ]) }}">
                    {{ csrf_field() }}
                    <a href="{{ action('App\Http\Controllers\User\SubscriptionController@index') }}">
                        {{ trans('cashier::messages.go_back') }}
                    </a>
                </form>
            </div>
            
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
            @include('user.invoices.bill', [
                'bill' => $invoice->getBillingInfo(),
            ])
        </div>
    </div>
@endsection