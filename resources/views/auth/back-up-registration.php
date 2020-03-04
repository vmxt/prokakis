@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div align="center" class="card-header"> 
                    <img src="public/images/smallLogo2.png" class="css-class" alt="Prokakis Logo"> <br /> <br /> <h3>CREATE ACCOUNT</h3> 
                </div>

                <div class="card-body">

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                          {{ session()->get('message') }}
                        </div>
                      @endif

                    <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group row">
                            <div class="col-md-12"> ACCOUNT INFORMATION </div>
                    </div>

                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} row">

                                    <div class="col-md-6">
                                            <input id="firstname" type="text" class="form-control" name="firstname" placeholder="First Name" value="{{ old('firstname') }}" required
                                            autofocus>

                                            @if ($errors->has('firstname'))
                                            <span class="help-block">
                                                                <strong>{{ $errors->first('firstname') }}</strong>
                                                            </span>
                                        @endif

                                    </div>

                                    <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}" required
                                            autofocus>

                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                                            <strong>{{ $errors->first('lastname') }}</strong>
                                                        </span>
                                    @endif
                                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} row">

                                <div class="col-md-12">
                                  <input id="phone" type="text" class="form-control" name="name" placeholder="Phone" value="{{ old('phone') }}" required
                                         autofocus>

                                  @if ($errors->has('phone'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                  @endif
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                                 <div class="col-md-12">
                                   <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>

                                   @if ($errors->has('email'))
                                     <span class="help-block">
                                                         <strong>{{ $errors->first('email') }}</strong>
                                                     </span>
                                   @endif
                                 </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                                 <div class="col-md-12">
                                   <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                                   @if ($errors->has('password'))
                                     <span class="help-block">
                                                         <strong>{{ $errors->first('password') }}</strong>
                                                     </span>
                                   @endif
                                 </div>
                        </div>

                        <div class="form-group row">

                                 <div class="col-md-12">
                                   <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation"
                                          required>
                                 </div>
                        </div>


                        <div class="form-group row">
                                <div class="col-md-12"> COMPANY INFORMATION </div>
                        </div>

                        <div class="form-group row">

                                 <div class="col-md-12">
                                   <input id="company_name" type="text" class="form-control" placeholder="Company Name" name="company_name"
                                          required>
                                 </div>
                        </div>

                        <div class="form-group row">

                                 <div class="col-md-12">
                                   <input id="company_website" type="text" class="form-control" placeholder="Company Website" name="company_website"
                                          required>
                                 </div>
                        </div>

                        <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                I have read and agreed to Prokakis <a href=""> Terms of Use </a> and <a href="">Privacy Policy</a>
                                            </label>
                                        </div>
                                    </div>
                        </div>


                        <div class="form-group row">
                                <div class="col-md-12"> <center>
                                  <button type="submit" class="btn btn-primary">
                                    Create Account
                                  </button>
                                </center>
                                </div>
                        </div>

                        <div class="form-group row">
                                <div class="col-md-12"><center> ------------------- Or sign up with social media -------------------</center> </div>
                        </div>

                        <div class="form-group row">
                                <div class="col-md-12">
                                    <center>

                                            <img src="public/images/crafted1.png" usemap="#socialmap" class="css-class" alt="alt text">
                                    </center>
                                </div>
                       </div>
                    
                    
                    <map name="socialmap" border="1">
                    <area shape="rect" coords="0,0,115,36" alt="Facebook" href="facebook.com">
                    <area shape="rect" coords="120,0,225,36" alt="Twitter" href="twitter.com">
                    <area shape="rect" coords="235,0,330,36" alt="Google" href="google.com"> 
                   </map>


                    </form>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection
