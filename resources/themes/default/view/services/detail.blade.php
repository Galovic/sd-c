@extends('theme::layouts.main')

@section('content')

    <!-- BREADCRUMB -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                <ol class="breadcrumb">
                    <li><a href="#">Články</a></li>
                    <li><a href="{{ $service->full_url }}">{{ $service->title }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /BREADCRUMB -->

<div class="container">
    <div class="row">
        <div class="col-md-12">

    <div class="cbp-l-project-title">{{ $service->title }}</div>



        <div class="cbp-l-project-container">
            <div class="cbp-l-project-desc">


                {!! $service->text !!} </div>
            <div class="cbp-l-project-details pull-right">
                <h5>Project detail :</h5>
                <ul class="cbp-l-project-details-list">

                    <li><strong>Datum</strong>{{ $service->publish_at->format('j.n.Y H:i') }}</li>
                    <li><strong>Categories</strong>&bull; <?php
                        foreach($service->categories as $category){
                            echo $category->name . ' &bull; ';
                        }
                        ?></li>
                </ul>

            </div>
        </div>



        <br><br><br>

        </div>
    </div>
</div>
    {{--<!-- CONTAIN -->
    <div class="container">
        <div class="row">

            <div class="blog-post">
                <h2 class="blog-post-title">{{ $article->title }}</h2>
                <p class="blog-post-meta">{{ $article->publish_at->format('j.n.Y H:i') }}</p>

                <p>{{ $article->perex }}</p>
                <hr>
                {!! $article->text !!}
                <hr>
                @foreach($article->tags as $tag)
                <a href="{{ route('homepage', [
                    'url' => $articlesPageUrl,
                    'tag' => $tag->name
                ]) }}" class="label label-info">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
    </div>--}}

@endsection