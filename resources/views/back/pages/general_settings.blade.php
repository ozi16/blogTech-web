@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')
@section('content')
    
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Settings</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Settings
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="pd-20 card-box mb-4">
    @livewire('admin.settings')
</div>

@endsection

{{-- @push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputFile = document.querySelector('input[type="file"][name="site_logo"]');
        const previewImage = document.querySelector('#preview-site-logo');

        inputFile.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                // Periksa tipe file
                const allowedExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!allowedExtensions.includes(file.type)) {
                    alert('Invalid file type. Only JPG, JPEG, and PNG are allowed.');
                    inputFile.value = ''; // Reset input file
                    return;
                }

                // Baca file dan tampilkan preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush --}}


@push('script')
    <script>
        $('input[type="file"][name="site_logo"]').ijaboViewers({
            preview:"#preview-site-logo",
            imageShape:'rectangular',
            allowedExtensions:['png','jpg'],
            onErrorShape:function(message,element){
                alert(message);
            },
            onInvalidType: function(message,element){
                alert(message);
            },
            onSuccess:function(message, element){}
        })

        $('#updateLogoForm').submit(function(e){
            e.preventDefault();
            var form = this;
            var inputVal = $(form).find('input[type="file"]').val();
            var errorElement = $(form).find('span.text-danger');
            errorElement.text('');

            if(inputVal.length > 0){
$.ajax({
    url:$(form).attr('action'),
    method:$(form).attr('method'),
    data:new FormData(form),
    processData:false,
    dataType:'json',
    contentType:false,
    beforeSend:function(){},
    success:function(data){
        if(data.success == 1){
            $(form)[0].reset();
            $().notifa([
            vers:2,
            cssClass:'success',
            html:data.message,
            delay:3000
            ]);
            $('img.site_logo').each(function(){
                $(this).attr('src','/'+data.image_path);
            });
        }else{
            $().notifa({
                vers:2,
                cssClass:'error',
                html:data.message,
                delay:3000
            })
        }
    }
})
            }else{
                errorElement.text('please, select an image file');
            }
        });
    </script>
@endpush
