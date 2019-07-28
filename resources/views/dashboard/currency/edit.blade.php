@extends('layouts.app')

@section('content')
    <div class="form">
        <h1 class="form__title">Edit a Currency</h1>
        <div class="form__container">
             {!! Form::Model('') !!}
           
          

             <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">Currency Name</label>
                {!! Form::text('currency_name', $currency->currency_name, [ 'placeholder'=>'Currency Name', 'class' => 'col-xs-12 col-md-7', 'required' => 'required']) !!}
            </div>

            <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">Default Currency?</label>
                <select name="currency_status">
                    <option>Select Option</option>
                    <option value="1" <?php echo ($currency->defaultcurrency ? 'selected=selected': "") ?> > Yes</option>
                    <option value="0" <?php echo (!$currency->defaultcurrency ? 'selected=selected': "") ?> >No</option>
                </select>
            </div>
           
           
            
            <div class="form__row">
              <input type="submit" name="UPDATE" value="UPDATE" class="btn btn-danger col-md-offset-4">               
            </div>
           
            {!! Form::Close() !!}
        </div>
    </div>    

       
@stop