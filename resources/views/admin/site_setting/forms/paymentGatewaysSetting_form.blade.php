{!! APFrmErrHelp::showErrorsNotice($errors) !!}

@include('flash::message')

<div class="form-body">

    <div class="row">
        <div class="col-lg-4">
            <div class="paymentboxstabs">
            <ul class="nav nav-tabs">              
                <li class="active"> <a href="#packagesfor" data-toggle="tab" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i> Packages For </a> </li>              
                <li class=""> <a href="#paypaltab" data-toggle="tab" aria-expanded="false"><i class="fa fa-cc-paypal" aria-hidden="true"></i> PayPal </a> </li>
                <li class=""> <a href="#stripetab" data-toggle="tab" aria-expanded="false"><i class="fa fa-cc-stripe" aria-hidden="true"></i> Stripe </a> </li>
                <li class=""> <a href="#razorpaytab" data-toggle="tab" aria-expanded="false"><i class="fa fa-credit-card" aria-hidden="true"></i> Razorpay </a> </li>
                <li class=""> <a href="#paytmtab" data-toggle="tab" aria-expanded="false"><i class="fa fa-credit-card" aria-hidden="true"></i> Paytm </a> </li>
                <li class=""> <a href="#paystacktab" data-toggle="tab" aria-expanded="false"><i class="fa fa-credit-card" aria-hidden="true"></i> Paystack </a> </li>
            </ul>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="tab-content">
                <!-- Packages -->
                <div class="tab-pane fade active in" id="packagesfor">
                <fieldset>
                <legend>Packages:</legend>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_jobseeker_package_active') !!}">
                    {!! Form::label('is_jobseeker_package_active', 'Is Package active for job seaker?', ['class' => 'bold']) !!}
                    <div class="radio-list">
                        <label class="radio-inline">{!! Form::radio('is_jobseeker_package_active', 1, null, ['id' => 'is_jobseeker_package_active_yes']) !!} Yes </label>
                        <label class="radio-inline">{!! Form::radio('is_jobseeker_package_active', 0, true, ['id' => 'is_jobseeker_package_active_no']) !!} No </label>
                    </div>
                    {!! APFrmErrHelp::showErrors($errors, 'is_jobseeker_package_active') !!}
                </div>

                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_company_package_active') !!}">
                    {!! Form::label('is_company_package_active', 'Is Package active for company?', ['class' => 'bold']) !!}
                    <div class="radio-list">
                        <label class="radio-inline">{!! Form::radio('is_company_package_active', 1, true, ['id' => 'is_company_package_active_yes']) !!} Yes </label>
                        <label class="radio-inline">{!! Form::radio('is_company_package_active', 0, null, ['id' => 'is_company_package_active_no']) !!} No </label>
                    </div>

                    {!! APFrmErrHelp::showErrors($errors, 'is_company_package_active') !!}
                </div>        

                </fieldset>
                </div>

                <!-- PayPal -->
                <div class="tab-pane fade" id="paypaltab">
                <fieldset>
                <legend>PayPal:</legend>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paypal_account') !!}">
                    {!! Form::label('paypal_account', 'Paypal account', ['class' => 'bold']) !!}                    
                    {!! Form::text('paypal_account', null, array('class'=>'form-control', 'id'=>'paypal_account', 'placeholder'=>'paypal account')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paypal_account') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paypal_client_id') !!}">
                    {!! Form::label('paypal_client_id', 'Paypal client_id', ['class' => 'bold']) !!}                    
                    {!! Form::text('paypal_client_id', null, array('class'=>'form-control', 'id'=>'paypal_client_id', 'placeholder'=>'paypal client_id')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paypal_client_id') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paypal_secret') !!}">
                    {!! Form::label('paypal_secret', 'Paypal secret', ['class' => 'bold']) !!}                    
                    {!! Form::text('paypal_secret', null, array('class'=>'form-control', 'id'=>'paypal_secret', 'placeholder'=>'paypal secret')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paypal_secret') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paypal_live_sandbox') !!}">
                    {!! Form::label('paypal_live_sandbox', 'Is Sandbox?', ['class' => 'bold']) !!}
                    <div class="radio-list">
                        <?php
                        $radio_1 = 'checked="checked"';
                        $radio_2 = '';
                        if (old('paypal_live_sandbox', ((isset($siteSetting)) ? $siteSetting->paypal_live_sandbox : 'sandbox')) == 'live') {
                            $radio_1 = '';
                            $radio_2 = 'checked="checked"';
                        }
                        ?>
                        <label class="radio-inline">
                            <input id="paypal_sandbox" name="paypal_live_sandbox" type="radio" value="sandbox" {{$radio_1}}>
                            Sandbox </label>
                        <label class="radio-inline">
                            <input id="paypal_live" name="paypal_live_sandbox" type="radio" value="live" {{$radio_2}}>
                            Live </label>
                    </div>
                    {!! APFrmErrHelp::showErrors($errors, 'paypal_live_sandbox') !!}
                </div>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_paypal_active') !!}">
                    {!! Form::label('is_paypal_active', 'Is Paypal active?', ['class' => 'bold']) !!}
                    <div class="radio-list">
                        <label class="radio-inline">{!! Form::radio('is_paypal_active', 1, true, ['id' => 'is_paypal_active_yes']) !!} Yes </label>
                        <label class="radio-inline">{!! Form::radio('is_paypal_active', 0, null, ['id' => 'is_paypal_active_no']) !!} No </label>
                    </div>
                    {!! APFrmErrHelp::showErrors($errors, 'is_paypal_active') !!}
                </div>
                </fieldset>
                </div>

                <!-- Stripe -->
                <div class="tab-pane fade" id="stripetab">
                <fieldset>
                <legend>Stripe:</legend>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'stripe_key') !!}">
                    {!! Form::label('stripe_key', 'Stripe Publishable Key', ['class' => 'bold']) !!}                    
                    {!! Form::text('stripe_key', null, array('class'=>'form-control', 'id'=>'stripe_key', 'placeholder'=>'Stripe Publishable Key')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'stripe_key') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'stripe_secret') !!}">
                    {!! Form::label('stripe_secret', 'Stripe Secret', ['class' => 'bold']) !!}                    
                    {!! Form::text('stripe_secret', null, array('class'=>'form-control', 'id'=>'stripe_secret', 'placeholder'=>'Stripe Secret')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'stripe_secret') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_stripe_active') !!}">
                    {!! Form::label('is_stripe_active', 'Is Stripe active?', ['class' => 'bold']) !!}
                    <div class="radio-list">
                        <label class="radio-inline">{!! Form::radio('is_stripe_active', 1, true, ['id' => 'is_stripe_active_yes']) !!} Yes </label>
                        <label class="radio-inline">{!! Form::radio('is_stripe_active', 0, null, ['id' => 'is_stripe_active_no']) !!} No </label>
                    </div>
                    {!! APFrmErrHelp::showErrors($errors, 'is_stripe_active') !!}
                </div>
                </fieldset>
                </div>

                <!-- Razorpay -->
                <div class="tab-pane fade" id="razorpaytab">
                <fieldset>
                <legend>Razorpay:</legend>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'razorpay_key') !!}">
                    {!! Form::label('razorpay_key', 'Razorpay Key', ['class' => 'bold']) !!}                    
                    {!! Form::text('razorpay_key', null, array('class'=>'form-control', 'id'=>'razorpay_key', 'placeholder'=>'Razorpay Key')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'razorpay_key') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'razorpay_secret') !!}">
                    {!! Form::label('razorpay_secret', 'Razorpay Secret', ['class' => 'bold']) !!}                    
                    {!! Form::text('razorpay_secret', null, array('class'=>'form-control', 'id'=>'razorpay_secret', 'placeholder'=>'Razorpay Secret')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'razorpay_secret') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_razorpay_active') !!}">
                    {!! Form::label('is_razorpay_active', 'Is Razorpay active?', ['class' => 'bold']) !!}
                    <div class="radio-list">
                        <label class="radio-inline">{!! Form::radio('is_razorpay_active', 1, true, ['id' => 'is_razorpay_active_yes']) !!} Yes </label>
                        <label class="radio-inline">{!! Form::radio('is_razorpay_active', 0, null, ['id' => 'is_razorpay_active_no']) !!} No </label>
                    </div>
                    {!! APFrmErrHelp::showErrors($errors, 'is_razorpay_active') !!}
                </div>
                </fieldset>
                </div>

                <!-- Paytm -->
                <div class="tab-pane fade" id="paytmtab">
                <fieldset>
                <legend>Paytm:</legend>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paytm_merchant_key') !!}">
                    {!! Form::label('paytm_merchant_key', 'Paytm Merchant Key', ['class' => 'bold']) !!}                    
                    {!! Form::text('paytm_merchant_key', null, array('class'=>'form-control', 'id'=>'paytm_merchant_key', 'placeholder'=>'Paytm Merchant Key')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paytm_merchant_key') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paytm_merchant_id') !!}">
                    {!! Form::label('paytm_merchant_id', 'Paytm Merchant ID', ['class' => 'bold']) !!}                    
                    {!! Form::text('paytm_merchant_id', null, array('class'=>'form-control', 'id'=>'paytm_merchant_id', 'placeholder'=>'Paytm Merchant ID')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paytm_merchant_id') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paytm_website') !!}">
                    {!! Form::label('paytm_website', 'Paytm Website', ['class' => 'bold']) !!}                    
                    {!! Form::text('paytm_website', null, array('class'=>'form-control', 'id'=>'paytm_website', 'placeholder'=>'Paytm Website')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paytm_website') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paytm_industry_type') !!}">
                    {!! Form::label('paytm_industry_type', 'Paytm Industry Type', ['class' => 'bold']) !!}                    
                    {!! Form::text('paytm_industry_type', null, array('class'=>'form-control', 'id'=>'paytm_industry_type', 'placeholder'=>'Paytm Industry Type')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paytm_industry_type') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paytm_channel_id') !!}">
                    {!! Form::label('paytm_channel_id', 'Paytm Channel ID', ['class' => 'bold']) !!}                    
                    {!! Form::text('paytm_channel_id', null, array('class'=>'form-control', 'id'=>'paytm_channel_id', 'placeholder'=>'Paytm Channel ID')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paytm_channel_id') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_paytm_active') !!}">
                    {!! Form::label('is_paytm_active', 'Is Paytm active?', ['class' => 'bold']) !!}
                    <div class="radio-list">
                        <label class="radio-inline">{!! Form::radio('is_paytm_active', 1, true, ['id' => 'is_paytm_active_yes']) !!} Yes </label>
                        <label class="radio-inline">{!! Form::radio('is_paytm_active', 0, null, ['id' => 'is_paytm_active_no']) !!} No </label>
                    </div>
                    {!! APFrmErrHelp::showErrors($errors, 'is_paytm_active') !!}
                </div>
                </fieldset>
                </div>

                <!-- Paystack -->
                <div class="tab-pane fade" id="paystacktab">
                <fieldset>
                <legend>Paystack:</legend>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paystack_key') !!}">
                    {!! Form::label('paystack_key', 'Paystack Key', ['class' => 'bold']) !!}                    
                    {!! Form::text('paystack_key', null, array('class'=>'form-control', 'id'=>'paystack_key', 'placeholder'=>'Paystack Key')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paystack_key') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'paystack_secret') !!}">
                    {!! Form::label('paystack_secret', 'Paystack Secret', ['class' => 'bold']) !!}                    
                    {!! Form::text('paystack_secret', null, array('class'=>'form-control', 'id'=>'paystack_secret', 'placeholder'=>'Paystack Secret')) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'paystack_secret') !!}                                       
                </div>    
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'is_paystack_active') !!}">
                    {!! Form::label('is_paystack_active', 'Is Paystack active?', ['class' => 'bold']) !!}
                    <div class="radio-list">
                        <label class="radio-inline">{!! Form::radio('is_paystack_active', 1, true, ['id' => 'is_paystack_active_yes']) !!} Yes </label>
                        <label class="radio-inline">{!! Form::radio('is_paystack_active', 0, null, ['id' => 'is_paystack_active_no']) !!} No </label>
                    </div>
                    {!! APFrmErrHelp::showErrors($errors, 'is_paystack_active') !!}
                </div>
                </fieldset>
                </div>
            </div>    
        </div>
    </div>
</div>

