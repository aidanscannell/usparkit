@extends('layouts.master')

@section('title')
  Notifications | uSparkit
@stop

@section('head')
  <script src="/src/js/main.js"></script>
  <script src="/src/js/ajax.js"></script>
@stop

@section('content')

  <!-- breadcrumb start -->
  <!-- ================ -->
  <div class="breadcrumb-container">
    <div class="container">
      <ol class="breadcrumb">
        <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="/">Home</a></li>
        <li class="active">Notifications</li>
      </ol>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- section start -->
  <!-- ================ -->
  <section class="section clearfix">
    <div class="container">
      <div class="row">
        @include('includes.message-block')

        <div class="col-md-4">
          <div class="light-gray-bg p-20" style="margin-bottom:10px;">
            <h3>Friend<span class="text-default"> Requests</span></h3>
            <div class="separator-2"></div>
            <div class="block">
              <?php //echo $friendRequest; ?>

              @foreach ($friendRequests as $friendRequest)
                <div class="media margin-clear">
            			<div class="media-left">
            				<div class="overlay-container">
            					<img class="media-object" src="/userz/{{ $friendRequest->user1 }}/{{ $friendRequest->avatar }}" alt="">
            					<a href="/User/{{ $friendRequest->user1 }}" class="overlay-link small"><i class="fa fa-link"></i></a>
            				</div>
            			</div>
            			<div class="media-body">
            				<h4 class="media-heading">New <span class="text-default">Friend Request</span> From <a href="/User/{{ $friendRequest->user1 }}">{{ $friendRequest->userSpace }}</a></h4>
            				<p class="small"><i class="fa fa-calendar pr-10"></i>{{ $friendRequest->day }} {{ $friendRequest->monthName }} {{ $friendRequest->time }}</p>
            				<p class="margin-clear small">
                      <form method="POST" action="/Accept-Connection">
                        <input type="hidden" value="{{ $friendRequest->user1 }}" name="user1">
                        <input type="hidden" value="{{ $friendRequest->user2 }}" name="user2">
                        <input type="hidden" value="{{ $friendRequest->id }}" name="id">
            					  <button class="btn btn-sm btn-default" type="submit">Accept</button>
                        {{ csrf_field() }}
                      </form>
              					 or
                      <form method="POST" action="/Reject-Connection">
                        <input type="hidden" value="{{ $friendRequest->user1 }}" name="user1">
                        <input type="hidden" value="{{ $friendRequest->user2 }}" name="user2">
                        <input type="hidden" value="{{ $friendRequest->id }}" name="id">
              					<button class="btn btn-sm btn-default" type="submit">Reject</button>
                        {{ csrf_field() }}
                      </form>
                    </p>
            			</div>
            			<hr>
            		</div>
              @endforeach

            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="light-gray-bg p-20" style="margin-bottom:10px;">
            <h3>Mes<span class="text-default">sages</span></h3>
            <div class="separator-2"></div>
            <div class="block">
              <?php //echo $newMessage; ?>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="light-gray-bg p-20" style="margin-bottom:10px;">
            <h3>Not<span class="text-default">ifications</span></h3>
            <div class="separator-2"></div>
            <div class="block">
              <?php //echo $notification_list; ?>

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <script type="text/javascript" src="/src/js/notifications.js"></script>
@stop
