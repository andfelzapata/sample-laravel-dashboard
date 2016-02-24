<h1 class="form-group-header-h1">Payment Options</h1>
<div class="row well">
    @foreach($payments as $payment)
    <form method="POST" class="payment-form">
        <div class="col-xs-12">
            <label class="payment-toggle">
                <a  class="payment-name" data-toggle="collapse" aria-expanded="false" aria-controls="sprintf('collapse%d',$payment->id)" href="{{ sprintf('#collapse%d',$payment->id) }}">{{ $payment->name}}</a>
            </label>
            <div class="collapse" id="{{ sprintf('collapse%d',$payment->id) }}">
                <div class="form-group">
                    {{ Form::hidden('id',$payment->id,array('class'=>'payment-field')) }}
                    <label><span>Card Number</span><input class="form-control payment-field" name="card_number" type="text" maxlength="20" size="20" data-stripe="number" value="{{ $payment->card_number }}"/></label>
                </div>
                <div class="form-group">
                    <label><span>CVC</span><input class="form-control" type="text" maxlength="4" size="4" data-stripe="cvc" value="{{ $payment->cvc }}"/></label>
                </div>    
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12"><label><span>Expiration (MM/Year)</span></label></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1 p-r-0"><input class="form-control payment-field" name="exp_month" maxlength="2" type="text" size="2" data-stripe="exp-month" value="{{ $payment->exp_month }}"/></div>
                        <div class="col-xs-1 no-gutter"><input class="form-control payment-field" name="exp_year" maxlength="4" type="text" size="4" data-stripe="exp-year" value="{{ $payment->exp_year }}"/></div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::button('update',array('class'=>'btn btn-success payment-submit','type'=>'submit')) }}
                    {{ Form::hidden('submit') }}
                </div>
            </div>
        </div>
    </form>    
    @endforeach
</div>
