@extends('admin.admin_dashboard')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/skins/ui/oxide/content.min.css">    
@endsection

@section('admin')
<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('admin/blog') }}">Blog</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Blog</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Add Blog</h6>

          
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Title</label>
              <div class="col-sm-9">
                {{ $blog->title }}
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Slug </span>
              <a id="ConvertSlug" style="cursor: pointer">Convert Slug</a>
              </label>
              <div class="col-sm-9">
                {{ $blog->slug }}
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Description</label>
              <div class="col-sm-9">
                {!! $blog->description !!}
              </div>
            </div>
            
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