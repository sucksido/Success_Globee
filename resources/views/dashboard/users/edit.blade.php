@extends('layouts.app')

@section('content')
    <div class="form">
        <h1 class="form__title">Edit a User</h1>
        <div class="form__container">
             {!! Form::Model('') !!}
           
          

             <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">First Name</label>
                {!! Form::text('firstname', $user->firstname, [ 'placeholder'=>'First Name', 'class' => 'col-xs-12 col-md-7 validate[required] text-input']) !!}
            </div>
            <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">Surname Name</label>
                {!! Form::text('lastname', $user->lastname, [ 'placeholder'=>'Surname', 'class' => 'col-xs-12 col-md-7 validate[required] text-input']) !!}
            </div>
             <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">Email</label>
                {!! Form::text('email', $user->email, [ 'placeholder'=>'Surname', 'class' => 'col-xs-12 col-md-7 validate[required] text-input']) !!}
            </div>
           
            
            <div class="form__row">
              <input type="submit" name="UPDATE" value="UPDATE" class="btn btn-danger col-md-offset-4">               
            </div>
           
            {!! Form::Close() !!}
        </div>
    </div>    

       
@stop