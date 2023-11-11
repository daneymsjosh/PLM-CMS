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
  
  <div class="page-wrapper">
      <div class="container">
          <div class="row">
              <div class="col-md-8">
                  @foreach ($posts as $post)
                    <div class="post">
                      <div class="post-media post-thumb">
                          <a href="#">
                              <img src="{{ $post->content->mediaUpload ? asset('images/posts/' . $post->content->mediaUpload->media_name) : asset('images/posts/default.jpg') }}" style="width:70%">
                          </a>
                      </div>
                      <h3 class="post-title"><a href="#">{{ $post->post_title }}</a></h3>
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
                      <div class="post-content">
                          <p>{!! Str::limit($post->content->content_body, 200) !!} </p>
                          <a href="{{ route('website.posts.show', $post->id) }}" class="btn btn-main">Continue Reading</a>
                      </div>
                    </div>
                  @endforeach
  <div class="text-center">
      <ul class="pagination post-pagination">
          <li><a href="#">Prev</a>
          </li>
          <li class="active"><a href="#">1</a>
          </li>
          <li><a href="#">2</a>
          </li>
          <li><a href="#">3</a>
          </li>
          <li><a href="#">4</a>
          </li>
          <li><a href="#">5</a>
          </li>
          <li><a href="#">Next</a>
          </li>
      </ul>
  </div>
                </div>
                <div class="col-md-4">
                  <aside class="sidebar">
      <!-- Widget Latest Posts -->
      <div class="widget widget-latest-post">
          <h4 class="widget-title">Latest Posts</h4>
          <div class="media">
              <a class="pull-left" href="blog-single.html">
                  <img class="media-object" src="{{ asset('assets/website/images/blog/post-thumb.jpg')}}" alt="Image">
              </a>
              <div class="media-body">
                  <h4 class="media-heading"><a href="blog-single.html">Introducing Swift for Mac</a></h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, officia.</p>
              </div>
          </div>
          <div class="media">
              <a class="pull-left" href="blog-single.html">
                  <img class="media-object" src="{{ asset('assets/website/images/blog/post-thumb-2.jpg')}}" alt="Image">
              </a>
              <div class="media-body">
                  <h4 class="media-heading"><a href="blog-single.html">Welcome to Themefisher Family</a></h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, officia.</p>
              </div>
          </div>
          <div class="media">
              <a class="pull-left" href="blog-single.html">
                  <img class="media-object" src="{{ asset('assets/website/images/blog/post-thumb-3.jpg')}}" alt="Image">
              </a>
              <div class="media-body">
                  <h4 class="media-heading"><a href="blog-single.html">Warm welcome from swift</a></h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, officia.</p>
              </div>
          </div>
          <div class="media">
              <a class="pull-left" href="blog-single.html">
                  <img class="media-object" src="{{ asset('assets/website/images/blog/post-thumb-4.jpg')}}" alt="Image">
              </a>
              <div class="media-body">
                  <h4 class="media-heading"><a href="blog-single.html">Introducing Swift for Mac</a></h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, officia.</p>
              </div>
          </div>
      </div>
      <!-- End Latest Posts -->
  
      <!-- Widget Category -->
      <div class="widget widget-category">
          <h4 class="widget-title">Categories</h4>
          <ul class="widget-category-list">
              <li><a href="#">Animals</a>
              </li>
              <li><a href="#">Landscape</a>
              </li>
              <li><a href="#">Portrait</a>
              </li>
              <li><a href="#">Wild Life</a>
              </li>
              <li><a href="#">Video</a>
              </li>
          </ul>
      </div> <!-- End category  -->
  
      <!-- Widget tag -->
      <div class="widget widget-tag">
          <h4 class="widget-title">Tag Cloud</h4>
          <ul class="widget-tag-list">
              <li><a href="#">Animals</a>
              </li>
              <li><a href="#">Landscape</a>
              </li>
              <li><a href="#">Portrait</a>
              </li>
              <li><a href="#">Wild Life</a>
              </li>
              <li><a href="#">Video</a>
              </li>
          </ul>
      </div> <!-- End tag  -->
  
      
  
  
  
  
  
  </aside>
                </div>
          </div>
      </div>
  </div>
@endsection