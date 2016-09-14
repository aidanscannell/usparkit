@extends('layouts.master')

@section('title')
  Reset Password | uSparkit
@stop

@section('content')
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading"><h3>Reset Password</h3></div>
                  <div class="panel-body">



                      @if (session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif

                  		<form id="forgotpassform" class="form-horizontal" method="POST" action="{{ url('/password/email') }}">
                          {{ csrf_field() }}
                  			<div class="form-group has-feedback">
                  				<label for="inputUserName" class="col-sm-3 control-label">E-mail Address <span class="text-danger small">*</span></label>
                  				<div class="col-sm-8 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  					<input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                  					<i class="fa fa-user form-control-feedback"></i>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                  				</div>
                  			</div>
                  			<div class="form-group">
                  				<div class="col-sm-offset-3 col-sm-8">
                  					<button type="submit" id="forgotpassbtn" class="btn btn-group btn-default btn-animated">Send Password Reset Link<i class="fa fa-envelope"></i></button>
                  					<p id="status"></p>
                  				</div>
                  			</div>
                  		</form>
                  </div>
              </div>
          </div>
      </div>
  </div>


@endsection
