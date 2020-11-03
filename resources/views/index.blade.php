@extends('layout.template')

@section('title', 'Home')

@section('content')

    <div class="container">
        <div class="jumbotron text-center">
            <h1><strong style="color: #3490dc">Welcome to LavTweetz <i class="fa fa-twitter"></i></strong></h1>
            <p class="small-text">LavTweetz is a little twitter API written to remind its developer about the knowledge he has with Laravel after chances with Node.JS</p>
        </div>

            <div>
               {!! Form::open(['method'=>'Post', 'action'=>'TweetController@store', 'file'=>true]) !!}

                    @if(session('tweet'))
                        <div class="alert alert-success">{{ session('tweet')}}</div>
                    @endif

                    <div class="form-group">
                        {!! Form::textarea('message', null, ['class'=>'form-control', 'cols'=>4,'rows'=>4, 'autofocus', 'placeholder'=>"What's happening?"]) !!}

                        @error('message')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::file('file[]', ['class'=>'form-control ', 'accept'=>'image/*','id'=>'inpFile', 'multiple'])!!}

                                @error('file')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="image-preview" id="imagePreview">
                                <img width="100" class="img-thumbnail image-preview__image" src="" alt=""> 
                                <span class="image-preview__default-text"> </span>
                            </div>
                        </div>


                    </div>


                
                    <div class="form-group">
                        {!! Form::submit('Submit Tweet', ['class'=>'btn btn-primary']) !!}
                    </div>
               {!! Form::close() !!}
            </div>



            <div class="container mt-3">
               <!-- Tweets -->
                <ul class="list-group" id="items">
                    <p class="lead">Tweetz <i class="fa fa-twitter"></i></p>
                        @if(!empty($data))
                            @foreach($data as $key => $tweet)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Obtaining images -->
                                            @if(!empty($tweet['extended_entities']['media']))
                                                @foreach($tweet['extended_entites']['media'] as $img)
                                                <img src="{{$img['media_url_https']}}"  class="img-thumbnail" width="150" alt="">
                                                @endforeach
                                             @else
                                             <img src="/images/img_place.png" class="img-thumbnail" width="150" alt="">
                                             @endif

                                        </div>

                                        <div class="col-md-8">
                                            <strong>Hello</strong>                           
                                            - {{$tweet['text']}}.

                                            <a class="btn btn-success" href="javascript:void(0)"><i class="fa fa-repeat"></i> {{$tweet['retweet_count']}} Retweets</a>

                                            <a class="btn btn-warning" href="javascript:void(0)"><i class="fa fa-heart"></i>  {{$tweet['favorite_count']}} Likes</a>

                                            <a class="btn btn-info text-white" href="javascript:void(0)"><i class="fa fa-envelope"></i> 11 Comments</a>
                                        </div>

                                    </div>
                                
                                </li> 
                            @endforeach


                        @else
                            <div class="alert alert-danger"><strong>OOPS!</strong> No Tweetz to display</div>
                        @endif

                       
                       


                </ul>

            

            </div>


            
    </div>



    
<!-- SCRIPTING FOR PREVIEWING IMAGE BEFORE UPLOADING  -->
<script>

const inpFile = document.getElementById('inpFile');
const previewContainer = document.getElementById('imagePreview');
const previewImage = document.querySelector('.image-preview__image');
const previewDefault = document.querySelector('.image-preview__default-text');

inpFile.addEventListener('change',function(){
    const file = this.files[0];

    if(file){
        const reader = new FileReader();
        previewDefault.style.display = 'none';
        previewImage.style.display = 'block';

        reader.addEventListener('load',function(){
            previewImage.setAttribute('src',this.result);
            previewImage.style.width = '130px';
        });
        reader.readAsDataURL(file)
    }else{
        previewDefault.style.display = 'block';
        previewImage.style.display = 'none';
        previewImage.setAttribute('src',"");
    }
})
</script>
@stop








