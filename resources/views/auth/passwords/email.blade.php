@extends('layout')

@section('content')

    <section class="section">
        
        <div class="container">
            
            <div class="columns is-multiline">
                
                <div class="column is-6 is-offset-3">

                    <div class="card">
                            
                        <header class="card-header">
                            
                            <p class="card-header-title ">
                                Password reset
                            </p>

                        </header>

                        <div class="card-content">

                            @if (session('status'))

                                <div class="notification is-success">
                                    {{ session('status') }}
                                </div>

                            @endif

                            <form method="POST" action="{{ route('password.email') }}">

                                {{ csrf_field() }}

                                <div class="field">
                                
                                    <label class="label">E-mail:</label>
                                
                                    <div class="control is-expanded">
                                        <input type="text" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" value="{{ old('email') }}">
                                    </div>
                                
                                    @if($errors->has('email'))<p class="help is-danger">{{ $errors->first('email') }}</p>@endif
                                
                                </div>

                                <div class="field">
                                    
                                    <button class="button is-primary">Send password reset link</button>

                                </div>

                            </form>

                        </div>

                    </div><!-- end of .card -->

                </div><!-- end of .column -->

            </div><!-- end of .columns -->

        </div><!-- end of .container -->

    </section>

@endsection