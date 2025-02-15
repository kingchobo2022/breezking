@extends('admin.admin_dashboard')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/skins/ui/oxide/content.min.css">    
@endsection

@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/blog') }}">Blog</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Edit Blog</h6>

          <form class="forms-sample" method="post" action="{{ url('admin/blog/edit/'. $blog->id ) }}">
            @csrf
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Title <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <input type="text" name="title" value="{{ $blog->title }}" class="form-control" placeholder="Enter Title" required id="getTitle">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Slug <span style="color: red"> *</span>
              <a id="ConvertSlug" style="cursor: pointer">Convert Slug</a>
              </label>
              <div class="col-sm-9">
                <input type="text" name="slug" value="{{ $blog->slug }}" id="getSlug" class="form-control" placeholder="Enter Slug" required>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Description <span style="color: red"> *</span></label>
              <div class="col-sm-9">
                <textarea name="description" class="form-control tinymce_editor" placeholder="Enter Descrption">{{ $blog->description }}</textarea>
              </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">Update</button>
            <a href="{{ url('admin/blog') }}" class="btn btn-secondary">Back</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js"></script>    

<script>
tinymce.init({
  selector: '.tinymce_editor',
  height: '500px',
  skin: 'oxide-dark',
  content_css: 'dark',
  toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | forecolor backcolor'
});

document.getElementById('ConvertSlug').addEventListener("click", function(){
  const title = document.getElementById('getTitle').value;
  const slug = document.getElementById('getSlug');

  slug.value = title.toLowerCase().replace(/ /g, "-").replace(/[^\w-]+/g, "");
});
</script>

@endsection