@extends('layouts.app')

@section('content')
    <div class="form">
        <h1 class="form__title">Set a Default Currency</h1>
        <div class="form__container">
             {!! Form::Model('') !!}
          
            <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">Currency </label>
                {!! Form::select('currency', $supportedcurrencies, $currency, array( 'required' => 'required ')) !!}
            </div>
                       
            <div class="form__row">
              <input type="submit" name="UPDATE" value="SAVE" class="btn btn-danger col-md-offset-4">               
            </div>
           
            {!! Form::Close() !!}
        </div>
    </div>    

       
@stop