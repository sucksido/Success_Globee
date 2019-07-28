@extends('layouts.app')

@section('content')
   
<div class="form" style="width: 100%">
    <div class="form__container">
      
       @foreach($currencies as $currency)
          <div class="form__row">
              <div class="col-lg-5">{{$currency->currencyname($currency->currency)}}</div>
              <div class="col-lg-1">{{ ( $currency->defaultcurrency ? 'Yes' : 'No') }}</div>
              <div class="col-lg-3">{{ date('jS M Y', strtotime($currency->created_at))}}</div>
              <div class="col-lg-3">
                  <a class="btn btn-warning btn-xs col-xs-5"  href="{{url('currency/edit/'.$currency->id)}}">EDIT</a>
                  <a class="btn btn-danger btn-xs col-xs-5 pull-right"  data-toggle="modal" data-target="#myModal" href="">DELETE</a>
              </div>
          </div>
          
      @endforeach
          
            {!! $currencies->render() !!}

        </div>
    </div>    
</div>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete User</h4>
      </div>
      <div class="modal-body">
       Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm">DELETE USER</button>
      </div>
    </div>
  </div>
</div>      
@stop