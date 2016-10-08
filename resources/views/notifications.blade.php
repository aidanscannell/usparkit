@extends('layouts.master')

@section('title')
  Notifications | uSparkit
@stop

@section('content')

  <!-- breadcrumb start -->
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
  <section class="section clearfix">
    <div class="container">
      <div class="row">
        @include('includes.message-block')

        <div class="col-md-4">
          <div class="light-gray-bg p-20" style="margin-bottom:10px;">
            <h3>Friend<span class="text-default"> Requests</span></h3>
            <div class="separator-2"></div>
            <div class="block">

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
            				<p class="small"><i class="fa fa-calendar pr-10"></i>{{ $friendRequest->dateTime }}</p>
            				<p class="margin-clear small">
                      <form method="POST" action="/Accept-Connection">
                        <input type="hidden" value="{{ $friendRequest->user1 }}" name="user1">
                        <input type="hidden" value="{{ $friendRequest->user2 }}" name="user2">
                        <input type="hidden" value="{{ $friendRequest->id }}" name="id">
            					  <button class="btn btn-sm btn-default" type="submit" value="accept" name="submit">Accept</button>
                          or
              					<button class="btn btn-sm btn-default" type="submit" value="reject" name="submit">Reject</button>
                        {{ csrf_field() }}
                      </form>
                    </p>
            			</div>
            			<hr>
            		</div>
              @endforeach
              @if(is_null($friendRequests->first()))
                No friend requests.
              @endif

            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="light-gray-bg p-20" style="margin-bottom:10px;">
            <h3>Mes<span class="text-default">sages</span></h3>
            <div class="separator-2"></div>
            <div class="block">

              @foreach($messages as $message)
                <div class="media margin-clear">
              		<div class="media-left">
              			<div class="overlay-container">
              				<img class="media-object" src="/userz/{{ $message->sender }}/{{ $message->avatar }}" alt="">
              				<a href="/User/{{ $message->sender }}" class="overlay-link small"><i class="fa fa-link"></i></a>
              			</div>
              		</div>
              		<div class="media-body">
              			<h4 class="media-heading">New <span class="text-default">Message</span> From <a href="/User/{{ $message->sender }}">{{ $message->userSpace }}</a></h4>
              			<p class="small"><i class="fa fa-calendar pr-10"></i>{{ $message->dateTime}}</p>
              			<p class="margin-clear small"><a class="btn btn-sm btn-default" href="/Messages/{{ Auth::user()->username }}">Click here to reply</a></p>
              		</div>
              		<hr>
              	</div>
              @endforeach
              @if(is_null($messages->first()))
                No new messages.
              @endif

            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="light-gray-bg p-20" style="margin-bottom:10px;">
            <h3>Not<span class="text-default">ifications</span></h3>
            <div class="separator-2"></div>
            <div class="block">

              @foreach($notifications as $notification)
                <div id="notification{{ $notification->id }}" name="notification">
                  <div class="media margin-clear">
            				<div class="media-left">
            					<div class="overlay-container">
            						<img class="media-object" src="/userz/{{ $notification->initiator }}/{{ $notification->avatar }}" alt="">
            						<a href="/User/{{ $notification->initiator }}" class="overlay-link small"><i class="fa fa-link"></i></a>
            					</div>
            				</div>
            				<div class="media-body">
            					<h4 class="media-heading"><a href="/User/{{ $notification->initiator }}">{{ $notification->userSpace }}</a> posted a new <span class="text-default">{{ $notification->userTypeNotification }}</span></h4>
            					<p class="small"><i class="fa fa-calendar pr-10"></i>{{ $notification->datetime }}</p>
            					<p class="margin-clear small"><a class="btn btn-sm btn-default" id="markAsRead{{ $notification->id }}" name="markAsRead" href="{{ URL::route('selectSponsorshipPage') }}#anchor-{{ $notification->id }}">View Request</a>
            					<a class="btn btn-sm btn-default" id="markAsRead{{ $notification->id }}" name="markAsRead">Mark as Read</a></p>
            				</div>
            				<hr>
            			</div>
          			</div>
                <span id="notificationStatus{{ $notification->id }}"></span>
              @endforeach

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <script>
    var url = '{{ route('markAsRead') }}';
    var token = '{{ Session::token() }}';
  </script>

@stop
