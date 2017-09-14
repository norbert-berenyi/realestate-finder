@extends('layout')

@section('content')

    <div class="container">
        
        <section class="section">

            <div class="columns">
                
                <div class="column is-6 is-offset-3">

                    <div class="content is-clearfix">
                        
                        <h1 class="is-pulled-left">Login</h1>

                    </div>

                    <form method="POST" action="{{ route('login') }}">

                        {{ csrf_field() }}

                        <div class="field">
                        
                            <label class="label">E-mail:</label>
                        
                            <div class="control is-expanded">
                                <input type="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" value="{{ old('email') }}">
                            </div>
                        
                            @if($errors->has('email'))<p class="help is-danger">{{ $errors->first('email') }}</p>@endif
                        
                        </div>

                        <div class="field">
                        
                            <label class="label">Password:</label>
                        
                            <div class="control is-expanded">
                                <input type="password" class="input {{ $errors->has('password') ? 'is-danger' : '' }}" name="password" value="{{ old('password') }}">
                            </div>
                        
                            @if($errors->has('password'))<p class="help is-danger">{{ $errors->first('password') }}</p>@endif
                        
                        </div>

                        <div class="field">
                        
                            <div class="control">

                                <label class="checkbox">

                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>

                                    Remember me

                                </label>

                            </div>

                        </div>

                        <dif class="field">

                            <div class="control">

                                <button class="button is-primary">Login</button>

                            </div>

                        </dif>

                    </form>

                </div>

            </div>

        </section>

    </div>

@endsection
