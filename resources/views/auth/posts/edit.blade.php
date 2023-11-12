@extends('layouts/auth')

@section('title', 'Edit Post')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
    
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Manage Post </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Edit Post</h4>

              @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif

              <form method="POST" action="{{ route('auth.posts.update', $post->id) }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $post->post_title }}" required>
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select name="category" class="form-control">
                    <option disabled selected>Choose Option</option>
                    @if (count($categories) > 0)
                      @foreach ($categories as $category)
                        <option @if(old('category', $post->post_category_id) == $category->id) selected @endif value="{{ $category->id }}">{{ $category->post_category_name }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control" @if(!auth()->user()->isSuperAdmin()) disabled @endif>
                    <option value="{{ App\Models\PostStatus::ForApproval }}" selected>For Approval</option>
                      @if (count($statuses) > 0)
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" @if(old('status', $post->post_status_id) == $status->id) selected @endif>{{ $status->post_status_name }}</option>
                        @endforeach
                      @endif
                  </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    {{-- <textarea id="summernote" name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea> --}}
                    <textarea id="summernote" name="description" class="form-control" cols="30" rows="10">{{ $post->content->content_body }}</textarea>
                </div>
                <div class="form-group">
                  <label>Tags</label>
                  <select name="tags[]" class="form-control" multiple>
                      @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @if(in_array($tag->id, $post->tags->pluck('id')->toArray())) selected @endif>{{ $tag->tag_name }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>File upload</label>
                  @if($post->content->mediaUpload)
                    <p>{{ $post->content->mediaUpload->media_name }}</p>
                    <input type="file" name="file" class="form-control">
                  @else
                    <input type="file" name="file" class="form-control">
                  @endif
                </div>
                <div class="form-group">
                  <label>Post Schedule</label>
                  {{-- <input type="date" class="form-control" value="{{ $post->created_at->format('Y-m-d') }}"> --}}
                  <input type="date" name="schedule" class="form-control" value="{{ $post->schedule_posting }}" required>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    @if(auth()->user()->isSuperAdmin())
                        <input type="text" name="remarks" class="form-control" placeholder="Remarks from super admin">
                    @else
                        <input type="text" class="form-control" value="{{ $post->remarks }}" disabled>
                    @endif
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
      $('select[name="tags[]"]').select2();
  });
</script>

{{-- <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script> --}}
@endsection