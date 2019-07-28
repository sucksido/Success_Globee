@extends('layouts.app')

@section('content')
    <div class="form">
        <h1 class="form__title">Add a User</h1>
        <div class="form__container">
             {!! Form::Model('') !!}
           
          

             <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">First Name</label>
                {!! Form::text('firstname', "", [ 'placeholder'=>'First Name', 'class' => 'col-xs-12 col-md-7', 'required' => 'required']) !!}
            </div>
            <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">Surname Name</label>
                {!! Form::text('lastname', "", [ 'placeholder'=>'Surname', 'class' => 'col-xs-12 col-md-7', 'required' => 'required']) !!}
            </div>
             <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">Email</label>
                {!! Form::Email('email', "", [ 'placeholder'=>'Email', 'class' => 'col-xs-12 col-md-7', 'required' => 'required']) !!}
            </div>

             <div class="form__row">
                <label class="form__row--label col-xs-12 col-md-4">Password</label>
                {!! Form::password('password', "", [ 'placeholder'=>'Password', 'class' => 'col-xs-12 col-md-7', 'required' => 'required']) !!}
            </div>
           
            
            <div class="form__row">
              <input type="submit" name="UPDATE" value="SAVE" class="btn btn-danger col-md-offset-4">               
            </div>
           
            {!! Form::Close() !!}
        </div>
    </div>    

       
@stop