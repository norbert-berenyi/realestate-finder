@extends('layout')

@section('content')

    <section class="section">
        
        <div class="container">
            
            <div class="columns is-multiline">
                
                <div class="column is-6 is-offset-3">

                    <div class="card">
                            
                        <header class="card-header">
                            
                            <p class="card-header-title ">
                                Reset password
                            </p>

                        </header>

                        <div class="card-content">

                             <form method="POST" action="{{ url('password/reset') }}">

                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="field">
                                
                                    <label class="label">E-mail:</label>
                                
                                    <div class="control is-expanded">
                                        <input type="text" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                
                                    @if($errors->has('email'))<p class="help is-danger">{{ $errors->first('email') }}</p>@endif
                                
                                </div>

                                <div class="field">
                                
                                    <label class="label">Password:</label>
                                
                                    <div class="control is-expanded">
                                        <input type="password" class="input {{ $errors->has('password') ? 'is-danger' : '' }}" name="password">
                                    </div>
                                
                                    @if($errors->has('password'))<p class="help is-danger">{{ $errors->first('password') }}</p>@endif
                                
                                </div>

                                <div class="field">
                                
                                    <label class="label">Confirm Password:</label>
                                
                                    <div class="control is-expanded">
                                        <input type="password" class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}" name="password_confirmation">
                                    </div>
                                
                                    @if($errors->has('password_confirmation'))<p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>@endif
                                
                                </div>

                                <div class="field">
                                    
                                    <button class="button is-primary">Reset Password</button>

                                </div>

                        </div>

                    </div><!-- end of .card -->

                </div><!-- end of .column -->

            </div><!-- end of .columns -->

        </div><!-- end of .container -->

    </section>

@endsection
