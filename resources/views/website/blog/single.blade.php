@extends('layouts/website')

@section('content')
<section class="page-title bg-2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block">
            <h1>Blog</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi, quibusdam.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section class="page-wrapper">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="post post-single">
                      <h2 class="post-title">{{ $post ? $post->post_title: '' }}</h2>
                      <div class="post-meta">
                          <ul>
                            <li>
                              <i class="ion-calendar"></i> {{ date('d M Y', strtotime($post->created_at)) }}
                            </li>
                            <li>
                              <i class="ion-android-people"></i> {{ $post->createdBy->name }}
                            </li>
                            @foreach ($post->tags as $tag)
                              @if ($loop->index < 3)
                                <li>
                                  <a href="#"><i class="ion-pricetags"></i> {{ $tag->tag_name }}</a>
                                </li>
                              @endif
                            @endforeach
                            
                          </ul>
                        </div>
                      <div class="post-thumb">
                      @if ($post->content->mediaUploads->isNotEmpty())
                                        <img src="{{ asset('medias/posts/' . $post->content->mediaUploads->first()->media_name) }}" alt="image" style="width: 400px;"/>
                                      @else
                                        <img src="{{ asset('medias/posts/default.jpg') }}" alt="default image" style="width: 400px;"/>
                                      @endif
                      </div>
                      <div class="post-content post-excerpt">
                          <p>{!! $post->content->content_body !!} </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  
@endsection