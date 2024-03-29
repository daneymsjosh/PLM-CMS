@extends('layouts/auth')

@section('title', 'Create Post')

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
            <li class="breadcrumb-item active" aria-current="page">Create Post</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Create Post</h4>

              @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif

              <form method="POST" action="{{ route('posts.store') }}" class="forms-sample" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select name="category" class="form-control">
                    <option disabled selected>Choose Option</option>
                    @if (count($categories) > 0)
                      @foreach ($categories as $category)
                          <option @selected( old('category') == $category->id) value="{{ $category->id }}">{{ $category->post_category_name }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" @if(!auth()->user()->isSuperAdmin()) disabled @endif>
                        <option value="{{ App\Models\PostStatus::ForApproval }}" selected>For Approval</option>
                        @if (auth()->user()->isSuperAdmin())
                          <option value="{{ App\Models\PostStatus::Approved }}" selected>Approved</option>
                        @else
                          <option value="{{ App\Models\PostStatus::ForApproval }}" selected>For Approval</option>
                        @endif
                        @if (count($statuses) > 0)
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->post_status_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    {{-- <textarea id="summernote" name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea> --}}
                    <textarea id="summernote" name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Tags</label>
                  <select name="tags[]" class="form-control" multiple>
                      @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>File upload</label>
                  {{-- <input type="file" name="file" class="form-control"> --}}
                  <input type="file" name="files[]" class="form-control" multiple>
                </div>
                <div class="file-details" style="display: none;">
                  <div class="form-group">
                    <label>Caption Title</label>
                    <input type="text" name="caption_titles[]" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Caption Description</label>
                    <textarea name="caption_descriptions[]" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label>Post Schedule</label>
                  <input type="date" name="schedule" class="form-control">
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <input type="text" name="remarks" class="form-control" placeholder="Remarks from super admin" disabled>
                  </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
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

    $('input[name="files[]"]').on('change', function () {
      displaySelectedFiles(this.files);
    });

    function displaySelectedFiles(files) {
      const selectedFilesList = $('#selectedFilesList');
      const fileDetailsContainer = $('#fileDetailsContainer');

      selectedFilesList.empty();
      fileDetailsContainer.empty();

      for (let i = 0; i < files.length; i++) {
        const listItem = `<li>${files[i].name}</li>`;
        selectedFilesList.append(listItem);

        const fileDetails = `
          <div class="file-details">
            <div class="form-group">
              <label>Media ${i + 1}</label>
              <input type="text" name="media_titles[]" class="form-control">
            </div>
          </div>
        `;

        // Append the new set of file details for each file
        fileDetailsContainer.append(fileDetails);
      }

      // Display the file details container if there are selected files
      fileDetailsContainer.toggle(files.length > 0);
    }
  });
</script>

{{-- <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script> --}}
@endsection