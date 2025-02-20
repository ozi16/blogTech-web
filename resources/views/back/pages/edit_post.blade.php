@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Edit Post</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Post
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <a href="{{route('admin.posts')}}" class="btn btn-primary">View all post</a>
        </div>
    </div>
</div>


    <form action="{{route('admin.update_post',['post_id'=>$post->id])}}" method="POST" autocomplete="off" enctype="multipart/form-data" id="updatePostForm" >
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-box mb-2 mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><b>Title</b>:</label>
                            <input type="text" class="form-control" name="title" value="{{$post->title}}" placeholder="Enter Post Title">
                            <span class="text-danger error-text title_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Content</b>:</label>
                            <textarea name="content" id="content" cols="30" class="ckeditor form-control" placeholder="Enter Post content here ">{!!$post->content!!}</textarea>
                            <span class="text-danger error-text content_error"></span>
                        </div>  
                    </div>
                </div>
                <div class="card card-box mb-2">
                    <div class="card-header weight-500">SEO</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><b>Post meta keyword</b>: <small>(Separated by comma )</small></label>
                            <input name="meta_keywords" value="{!!$post->meta_keywords!!}" cols="30" rows="10" class="form-control" placeholder="Enter post meta keywords" id=""></input>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Post meta description</b>:</label>
                            <textarea name="meta_description"  cols="30" rows="10" class="form-control" placeholder="Enter Post meta description">{!!$post->meta_description!!}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-box mb-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><b>Post Category</b>:</label>
                            <select name="category" id="" class="custom-select form-control">
                                {!!$categories_html !!}
                            </select>
                            <span class="text-danger error-text category_error"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><b>Post Feature Image</b>:</label>
                            <input type="file" name="featured_image" class="form-control-file form-control" height="auto" id="featured_image_input">
                            <span class="text-danger error-text featured_image_error"></span>
                        </div>
                        <div class="d-block mb-3" style="max-width: 250px" >
                            <img src="{{ asset('/images/posts/' . $post->featured_image) }}" alt="" id="feature_image_preview" style="max-width:100%" height="auto" >
                        </div>
                        <div class="form-group">
                            <label for=""><b>Tags</b>:</label>
                            <input type="text" class="form-control" name="tags" data-role="tagsinput" value="{!!$post->tags!!}">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for=""><b>Visibility</b>:</label>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="visibility" id="customRadio1" class="custom-control-input" value="1" {{$post->visibility == 1 ? 'checked' : ''}}>
                                <label for="customRadio1" class="custom-control-label" >Public</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="visibility" id="customRadio2" class="custom-control-input" value="0" {{$post->visibility == 0 ? 'checked' : ''}}>
                                <label for="customRadio2" class="custom-control-label" >Private</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <button class="btn btn-primary" type="submit">Update Post</button>
        </div>
    </form>

@endsection

@push('stylesheets')
    <link rel="stylesheet" href="/back/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/ckeditor/contents.css">
@endpush


@push('script')

<script src="/back/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js "></script>
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content',{
        filebrowserBrowseUrl: '/elfinder/ckeditor'
    } );
</script>


<script>
    // Menangkap input file
    document.getElementById('featured_image_input').addEventListener('change', function(event) {
        const input = event.target;
        const preview = document.getElementById('feature_image_preview');

        // Cek apakah ada file yang dipilih
        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Validasi tipe file (hanya gambar)
            const allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedExtensions.includes(file.type)) {
                alert('Hanya file dengan format JPEG, JPG, atau PNG yang diizinkan!');
                input.value = ''; // Reset input
                preview.style.display = 'none';
                return;
            }

            // Membaca file menggunakan FileReader
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result; // Atur URL hasil pembacaan ke elemen img
                preview.style.display = 'block'; // Tampilkan gambar
            };
            reader.readAsDataURL(file); // Membaca file sebagai Data URL
        } else {
            // Jika tidak ada file yang dipilih, sembunyikan gambar
            preview.src = '';
            preview.style.display = 'none';
        }
    }); 

    // UPDATE A POST
    $('#updatePostForm').on('submit', function(e) {
    e.preventDefault();
    var form = this;
    var content = CKEDITOR.instances.content.getData();
    var formdata = new FormData(form);
        formdata.append('content',content);

    $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $(form).find('span.error-text').text(''); // Hapus pesan error sebelumnya
        },
        success: function(data) {
            if (data.status == 1) {
                // Reset form jika berhasil
                $(form)[0].reset();
                // CKEDITOR.instances.content.setData('');
                // $('img#featured_image_preview').attr('src', ''); // Hapus preview gambar
                // $('input[name="tags"]').tagsinput('removeAll'); // Hapus semua tag dari input

                // Tampilkan SweetAlert sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2500,
                    showConfirmButton: false
                });
            }
        },
        error: function(data) {
            // Tampilkan pesan error di bawah inputan
            $.each(data.responseJSON.errors, function(prefix, val) {
                $(form).find('span.' + prefix + '_error').text(val[0]); // Isi pesan error pada elemen span
            });
        }
    });
});

</script>
@endpush


