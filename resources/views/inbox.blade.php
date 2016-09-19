@extends('layouts.master')

@section('title')
  Messages | uSparkit
@stop

@section('head')

@stop

@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="/">Home</a></li>
          <li class="active">Messages</li>
        </ol>
      </div>
    </div>
    <!-- breadcrumb end -->

    <section class="main-container">
      <div class="container">

        <div class="row">
          <!-- main start -->

          <!-- sidebar start -->
          <aside class="col-md-5 col-xs-12">
            <div class="sidebar">
              <div class="block clearfix">
                  <?php //include_once("php_includes/privateMessage.php"); ?>
              </div>
            </div>
          </aside>
          <!-- sidebar end -->

          <div class="col-md-7 col-xs-12">
            <!-- comments start -->
            <!-- ================ -->
            <h3 class="title">Your Messages </h3>
            <div class="separator-2"></div>
            <?php //echo $mail; ?>

            <!-- Nav tabs -->
						<ul class="nav nav-tabs style-1" role="tablist">
							<li class="active"><a href="#htab1" role="tab" data-toggle="tab"><i class="fa fa-home pr-10"></i>Received</a></li>
							<li><a href="#htab2" role="tab" data-toggle="tab"><i class="fa fa-user pr-10"></i>Sent</a></li>
						</ul>
            <div class="tab-content">

              <div class="tab-pane fade in active" id="htab1">

                @foreach($messages as $message)
                  <div id="status{{ $message->inbox_id }}" style="padding-top:10px;">
                    <div class="comment clearfix p-20 light-gray-bg">
        							<div class="comment-avatar">
        								<a href="/User/{{ $message->sender }}"><img class="img-circle" src="/userz/{{ $message->sender }}/{{ $message->avatar }}" alt="{{ $message->sender }}"></a>
        							</div>
        							<header>
        								<h3>Subject: {{ $message->subject }}</h3>
        								<div class="comment-meta">
                          From
                          <a href="/User/{{ $message->sender }}">{{ $message->sender }}</a>
                          | {{ $message->senttime }}
                        </div>
        							</header>
        							<div class="comment-content">
        								<div class="comment-body clearfix">
        									<p>{{ $message->message }}</p>
        									<a class="btn-sm-link link-dark pull-right" onclick="toggleElement('comments{{ $message->inbox_id }}')"><i class="fa fa-reply"></i> View Replies</a>
        									<a class="btn-sm-link link-dark pull-left" onclick="deletePm('{{ $message->inbox_id }}','status{{ $message->inbox_id }}','{{ $message->sender }}','message')" id="deleteBtn{{ $message->inbox_id }}"><i class="fa fa-close"></i> Delete</a>
        									<p id="pm_{{$message->inbox_id}}"> </p>
        								</div>
        							</div>
        							<div id="comments{{$message->inbox_id}}" style="display:none;">

                        @foreach($replies as $reply)
                          @if($reply->messageID == $message->inbox_id)
                            <!-- comment start -->
                    				<div class="comment clearfix" id="status{{ $reply->inbox_id }}">
                    					<div class="comment-avatar">
                                @if($reply->sender == Auth::user()->username)
                    						  <img class="img-circle" src="/userz/{{ Auth::user()->username }}/{{ Auth::user()->avatar }}" alt="{{ $reply->sender}}">
                                @else
                                  <img class="img-circle" src="/userz/{{ $reply->sender}}/{{ $reply->avatar }}" alt="{{ $reply->sender}}">
                                @endif
                    					</div>
                    					<header>
                    						<div class="comment-meta">From <a href="/User/{{ $reply->sender }}">{{ $reply->sender}}'.$reply_sender_space.'</a> | {{ $reply->senttime }}</div>
                    					</header>
                    					<div class="comment-content">
                    						<div class="comment-body clearfix">
                    							<p>{{ $reply->message }}</p>
                    							<a class="btn-sm-link link-dark pull-left" onclick="deletePm('{{ $reply->inbox_id }}','status{{ $reply->inbox_id }}','{{ $reply->inbox_id }}','reply')" id="deleteBtn{{ $reply->inbox_id }}"><i class="fa fa-close"></i> Delete</a>
                    						</div>
                    					</div>
                    				</div>
                    				<!-- comment end -->
                          @endif
                        @endforeach


        								<div id="newReply{{$message->inbox_id}}"></div>

        								<div class="p-20 light-gray-bg" id="replyForm{{$message->inbox_id}}" >
        							    <h2 class="title">Reply</h2>
        							    <form id="form{{$message->inbox_id}}" name="form" method="post" class="form" role="form" action="[[~[[*id]]]]" enctype="multipart/form-data">
        							      <div class="form-group has-feedback">
        							        <label for="message{{$message->inbox_id}}">Message</label>
        							        <textarea class="form-control" rows="4" id="message{{$message->inbox_id}}" placeholder="" required></textarea>
        							        <i class="fa fa-envelope-o form-control-feedback"></i>
        							      </div>
        							      <button id="replyBtn2{{$message->inbox_id}}" type="button" class="btn btn-default" onclick="replyToPm('{{$message->inbox_id}}','{{ Auth::user()->username }}','message{{$message->inbox_id}}','replyBtn2{{$message->inbox_id}}','{{$message->sender}}')">Reply</button>
        							    </form>
        							  </div>
        							</div>
        						</div>
      						</div>
                @endforeach

              </div>
              <div class="tab-pane fade" id="htab2">

                @foreach($messagesSender as $message)
                  <div id="status{{ $message->inbox_id }}" style="padding-top:10px;">
                    <div class="comment clearfix p-20 light-gray-bg">
                      <div class="comment-avatar">
                        <a href="/User/{{ $message->sender }}"><img class="img-circle" src="/userz/{{ Auth::user()->username }}/{{ Auth::user()->avatar }}" alt="{{ $message->sender }}"></a>
                      </div>
                      <header>
                        <h3>Subject: {{ $message->subject }}</h3>
                        <div class="comment-meta">
                          From
                          <a href="/User/{{ $message->sender }}">{{ $message->sender }}</a>
                          | {{ $message->senttime }}
                        </div>
                      </header>
                      <div class="comment-content">
                        <div class="comment-body clearfix">
                          <p>{{ $message->message }}</p>
                          <a class="btn-sm-link link-dark pull-right" onclick="toggleElement('comments{{ $message->inbox_id }}')"><i class="fa fa-reply"></i> View Replies</a>
                          <a class="btn-sm-link link-dark pull-left" onclick="deletePm('{{ $message->inbox_id }}','status{{ $message->inbox_id }}','{{ $message->sender }}','message')" id="deleteBtn{{ $message->inbox_id }}"><i class="fa fa-close"></i> Delete</a>
                          <p id="pm_{{$message->inbox_id}}"> </p>
                        </div>
                      </div>
                      <div id="comments{{$message->inbox_id}}" style="display:none;">

                        @foreach($repliesSender as $reply)
                          @if($reply->messageID == $message->inbox_id)
                            <!-- comment start -->
                            <div class="comment clearfix" id="status{{ $reply->inbox_id }}">
                              <div class="comment-avatar">
                                @if($reply->sender == Auth::user()->username)
                                  <img class="img-circle" src="/userz/{{ Auth::user()->username }}/{{ Auth::user()->avatar }}" alt="{{ $reply->sender}}">
                                @else
                                  <img class="img-circle" src="/userz/{{ $reply->sender}}/{{ $reply->avatar }}" alt="{{ $reply->sender}}">
                                @endif
                              </div>
                              <header>
                                <div class="comment-meta">From <a href="/User/{{ $reply->sender }}">{{ $reply->sender}}'.$reply_sender_space.'</a> | {{ $reply->senttime }}</div>
                              </header>
                              <div class="comment-content">
                                <div class="comment-body clearfix">
                                  <p>{{ $reply->message }}</p>
                                  <a class="btn-sm-link link-dark pull-left" onclick="deletePm('{{ $reply->inbox_id }}','status{{ $reply->inbox_id }}','{{ $reply->inbox_id }}','reply')" id="deleteBtn{{ $reply->inbox_id }}"><i class="fa fa-close"></i> Delete</a>
                                </div>
                              </div>
                            </div>
                            <!-- comment end -->
                          @endif
                        @endforeach


                        <div id="newReply{{$message->inbox_id}}"></div>

                        <div class="p-20 light-gray-bg" id="replyForm{{$message->inbox_id}}" >
                          <h2 class="title">Reply</h2>
                          <form id="form{{$message->inbox_id}}" name="form" method="post" class="form" role="form" action="[[~[[*id]]]]" enctype="multipart/form-data">
                            <div class="form-group has-feedback">
                              <label for="message{{$message->inbox_id}}">Message</label>
                              <textarea class="form-control" rows="4" id="message{{$message->inbox_id}}" placeholder="" required></textarea>
                              <i class="fa fa-envelope-o form-control-feedback"></i>
                            </div>
                            <button id="replyBtn2{{$message->inbox_id}}" type="button" class="btn btn-default" onclick="replyToPm('{{$message->inbox_id}}','{{ Auth::user()->username }}','message{{$message->inbox_id}}','replyBtn2{{$message->inbox_id}}','{{$message->sender}}')">Reply</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach

              </div>

            </div>


          </div>

        </div>

      </div>
    </section>

    <script src="/src/js/inbox.js" type="text/javascript"></script>

@endsection
