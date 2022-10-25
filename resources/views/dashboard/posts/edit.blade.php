
@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="h3">No. CAPA : {{ $post->id }}: {{ $post->title }}</h2>
            <h3 class="h4">Author : {{ $post->user->name }} ({{ $post->departement->name }})</h3>
        </div>
        
        
    <div class="col-lg-8">
        <a href="/dashboard/posts" class="btn btn-success mb-3"><span data-feather="arrow-left"></span> Back To All CAPA</a>
        <form method="post" action="/dashboard/posts/{{$post->slug}}" class="mb-3" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="card  mb-2">
                <div class="card-header text-center font-weight-bold">
                    <strong>Upload Bukti Closing CAPA</strong>
                </div>
                <div class="card-body">
                    <input class="mb-1" type="hidden" name="oldImage" value="{{ $post->image }}">               
                    <input type="hidden" name="oldImage" value="{{ $post->image }}">
                    @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}"class="img-preview img-fluid mb-2 col-sm-5 d-block">
                    @else
                        <img class="img-preview img-fluid mb-2 col-sm-5">   
                    @endif

                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                    @error('image')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror

                    <div class="mt-2 mb-2">
                        <label for="prove" class="form-label mt-1">Keterangan:</label>
                        <input type="text" class="form-control @error('prove') is-invalid @enderror" id="prove" name="prove" required autofocus value="{{old('prove', $post->prove)}}">
                        @error('prove')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>                                           
                </div>
                <div class="card-footer text-muted text-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm">Upload</button>
                </div>
            </div>

            <div class="mb-3">
                <label for="source_capa" class="form-label">Referensi (Sumber CAPA)</label>
                <input type="text" class="form-control @error('source_capa') is-invalid @enderror" id="source_capa" name="source_capa" required autofocus value="{{old('source_capa', $post->source_capa)}}">
                @error('source_capa')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{old('title', $post->title)}}">
                @error('title')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="finding" class="form-label">Temuan</label>
                <input type="text" class="form-control @error('finding') is-invalid @enderror" id="finding" name="finding" required autofocus value="{{old('finding', $post->finding)}}">
                @error('finding')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="classification" class="form-label">Classification</label>
                <select class="form-select" name="classification_id">
                    <option value="">Select Classification</option>
                    @foreach ($classifications as $classification)
                        @if( old('classification_id', $post->classification_id) == $classification->id)
                        <option value="{{ $classification->id }}" selected>{{ $classification->name }}</option>
                        @else
                        <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="requirement" class="form-label">Requirement</label>
                <input type="text" class="form-control @error('requirement') is-invalid @enderror" id="requirement" name="requirement" required autofocus value="{{old('requirement', $post->requirement)}}">
                @error('requirement')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gap_analysis" class="form-label">GAP Analysis</label>
                <input type="text" class="form-control @error('gap_analysis') is-invalid @enderror" id="gap_analysis" name="gap_analysis" required autofocus value="{{old('gap_analysis', $post->gap_analysis)}}">
                @error('gap_analysis')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="rootcause" class="form-label">Root Cause</label>
                <select class="form-select" name="rootcause_id">
                <option value="">Select Root Cause</option>
                    @foreach ($rootcauses as $rootcause)
                        @if( old('rootcause_id', $post->rootcause_id) == $rootcause->id)
                        <option value="{{ $rootcause->id }}" selected>{{ $rootcause->name }}</option>
                        @else
                        <option value="{{ $rootcause->id }}">{{ $rootcause->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="corrective_action" class="form-label">Corrective Action</label>
                <input type="text" class="form-control @error('corrective_action') is-invalid @enderror" id="corrective_action" name="corrective_action" required autofocus value="{{old('corrective_action', $post->corrective_action)}}">
                @error('corrective_action')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="preventive_action" class="form-label">Preventive Action</label>
                <input type="text" class="form-control @error('preventive_action') is-invalid @enderror" id="preventive_action" name="preventive_action" required autofocus value="{{old('preventive_action', $post->preventive_action)}}">
                @error('preventive_action')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            
            <!-- <div class="mb-3">    
                <label for="departement" class="form-label">Departement</label>
                <select name="departement_id" id="departement_id" class="form-select">
                    @foreach ($departements as $departement)
                        @if( old('departement_id', $post->departement_id) == $departement->id)
                            <option value="{{ $departement->id }}" selected>{{ $departement->name }}</option>
                        @else
                            <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                        @endif
                    @endforeach
                    

                </select>
            </div>
            
            <div class="mb-3">     
                <label for="user" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-select">
                    <option value="">Select User</option>
                     @if (!empty($users))
                        @foreach ($users as $user)
                            <option {{ ($user->user == $user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div> -->
            
            
            <div class="mb-3">
                <label for="timeline" class="form-label">Timeline</label>
                <input type="date" class="form-control @error('timeline') is-invalid @enderror" id="timeline" name="timeline" required autofocus value="{{old('timeline',optional($post->timeline)->format('Y-m-d') )}}">
                @error('timeline')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
                @error('timeline')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status_id" >
                    @foreach ($statuses as $status)
                    @if( old('status_id', $post->status_id) == $status->id)
                    <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                    @else
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label for="departement" class="form-label">Departement</label>
                <input type="text" class="form-control @error('departement_id') is-invalid @enderror" id="departement_id" name="departement_id" required autofocus value="{{old('departement->name', $post->departement->name)}}" aria-label="Disabled input example" disable readonly required>
                @error('departement_id')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="user" class="form-label">User</label>
                <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required autofocus value="{{old('user->name', $post->user->name)}}" aria-label="Disabled input example" disable readonly required>
                @error('user_id')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
          
            <div class="mb-2 invisible">
                <input type="text" class="form-control @error('departement_id') is-invalid @enderror" id="departement_id" name="departement_id" required autofocus value="{{old('departement_id', $post->departement_id)}}" aria-label="Disabled input example" disable readonly required>
                <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required autofocus value="{{old('user_id', $post->user_id)}}" aria-label="Disabled input example" disable readonly required>
            </div> 
            
            <!-- ini form input yg di hide -->
            <div class="mb-3 invisible">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug" name="slug" aria-label="Disabled input example" disable readonly required value="{{old('slug', $post->slug)}}">
                @error('slug')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <!-- <div class="mb-2">
                <label for="source_capa" class="form-label">Referensi (Sumber CAPA)</label>
                <input type="text" class="form-control @error('source_capa') is-invalid @enderror" id="source_capa" name="source_capa" required autofocus value="{{old('source_capa', $post->source_capa)}}" aria-label="Disabled input example" disable readonly required>
                @error('source_capa')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{old('title', $post->title)}}" aria-label="Disabled input example" disable readonly required>
                @error('title')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="finding" class="form-label">Temuan</label>
                <input type="text" class="form-control @error('finding') is-invalid @enderror" id="finding" name="finding" required autofocus value="{{old('finding', $post->finding)}}" aria-label="Disabled input example" disable readonly required>
                @error('finding')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="classification" class="form-label">Classification</label>
                <input type="text" class="form-control @error('classification_id') is-invalid @enderror" id="classification_id" name="classification_id" required autofocus value="{{old('classification->name', $post->classification->name)}}" aria-label="Disabled input example" disable readonly required>
                @error('classification_id')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            
            <div class="mb-2">
                <label for="requirement" class="form-label">Requirement</label>
                <input type="text" class="form-control @error('requirement') is-invalid @enderror" id="requirement" name="requirement" required autofocus value="{{old('requirement', $post->requirement)}}" aria-label="Disabled input example" disable readonly required>
                @error('requirement')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="gap_analysis" class="form-label">GAP Analysis</label>
                <input type="text" class="form-control @error('gap_analysis') is-invalid @enderror" id="gap_analysis" name="gap_analysis" required autofocus value="{{old('gap_analysis', $post->gap_analysis)}}" aria-label="Disabled input example" disable readonly required>
                @error('gap_analysis')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2 disabled" aria-label="Disabled select example" disable readonly required>
                <label for="rootcause_id" class="form-label">Rootcause</label>
                <input type="text" class="form-control @error('rootcause_id') is-invalid @enderror" id="rootcause_id" name="rootcause_id" required autofocus value="{{old('rootcause->name', $post->rootcause->name)}}" aria-label="Disabled input example" disable readonly required>
                @error('rootcause_id')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="corrective_action" class="form-label">Corrective Action</label>
                <input type="text" class="form-control @error('corrective_action') is-invalid @enderror" id="corrective_action" name="corrective_action" required autofocus value="{{old('corrective_action', $post->corrective_action)}}" aria-label="Disabled input example" disable readonly required>
                @error('corrective_action')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="preventive_action" class="form-label">Preventive Action</label>
                <input type="text" class="form-control @error('preventive_action') is-invalid @enderror" id="preventive_action" name="preventive_action" required autofocus value="{{old('preventive_action', $post->preventive_action)}}" aria-label="Disabled input example" disable readonly required>
                @error('preventive_action')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="timeline" class="form-label">Timeline</label>
                <input type="date" class="form-control @error('timeline') is-invalid @enderror" id="timeline" name="timeline" required autofocus value="{{old('timeline',optional($post->timeline)->format('Y-m-d') ) }}"  aria-label="Disabled input example" disable readonly required>
                @error('timeline')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            
            <div class="mb-2 invisible">
                <input type="text" class="form-control @error('rootcause_id') is-invalid @enderror" id="rootcause_id" name="rootcause_id" required autofocus value="{{old('rootcause_id', $post->rootcause_id)}}" aria-label="Disabled input example" disable readonly required>
                <input type="text" class="form-control @error('classification_id') is-invalid @enderror" id="classification_id" name="classification_id" required autofocus value="{{old('classification_id', $post->classification_id)}}" aria-label="Disabled input example" disable readonly required>
            </div> 
            <div class="mb-2 invisible">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug" name="slug" aria-label="Disabled input example" disable readonly required value="{{old('slug', $post->slug)}}">
                @error('slug')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            
            <div class="mb-2 invisible">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status_id">
                    @foreach ($statuses as $status)
                        @if( old('status_id', $post->status_id) == $status->id)
                        <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                        @else
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div> -->

        </form>    
    </div>

    <!-- pakai fetch API -->
    <script>
       
        // ambil ID yang udah kita buat yaitu title dan slug
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        function changename(){
        document.getElementById('rootcause_id').name = "aku";
        } 

        // disable fungsi upload file kaya di email
        document.addEventListener('trix-file-accept', function(e) {
           e.preventDefault(); 
        });

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            //mengambil data gambar
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            //ketika di load, jalankan sebuah fungtion oFREvent
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

    </script>
@endsection