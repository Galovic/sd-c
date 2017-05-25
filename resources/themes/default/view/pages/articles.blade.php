@extends('theme::layouts.main')

@section('content')

  {{--  <!-- BREADCRUMB -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><a href="#">{{ $title }}</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /BREADCRUMB -->--}}



<!-- Start full width filter -->
<div class="fullwidth-filter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Start portfolio filter -->
                <div id="js-filters-masonry" class="cbp-l-filters-button">
                    <div data-filter="*" class="cbp-filter-item-active cbp-filter-item">
                        Vše<div class="cbp-filter-counter"></div>
                    </div>
                    <?php $prev = array(); ?>
                    @foreach($articles as $article)

                        @foreach($article->categories as $category)
                            @if($category->name != 'Vše')
                                @if(in_array($category->name,$prev))

                                @else
                                        <div data-filter=".{{ $category->name }}" class="cbp-filter-item">
                                            {{ $category->name }}
                                        </div>
                                @endif
                            @endif
                                <?php if(!in_array($category->name,$prev)){ array_push($prev,$category->name);} ?>
                        @endforeach

                    @endforeach



                </div>
                <!-- End portfolio filter -->
            </div>
        </div>
    </div>
</div>
<!-- End full width filter -->

<!-- Start contain wrapper -->
<div class="contain-wrapp">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Start portfolio -->
                <div id="js-grid-masonry" class="cbp">
                    <!-- Start project 1 -->
                    @foreach($articles as $article)
                    <div class="cbp-item  @foreach($article->categories as $category){{ $category->name . ' ' }}@endforeach">
                        <a href="{{ $article->full_url }}" class="cbp-caption" rel="nofollow">
                            <div class="cbp-caption-defaultWrap">
                                <img src="{{ $article->image_url }}" alt="" />
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-zoom">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-title">{{ $article->title }}</div>
                                        <div class="cbp-l-caption-desc">{{ $article->perex }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <!-- End project -->
                </div>
                @if(!$articles->count())
                    <h4> <em>{{ $context->trans('articles.no_articles') }}</em> </h4>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End contain wrapper -->

<div class="clearfix"></div>

   {{-- <!-- CONTAIN -->
    <div class="container">
        <div class="row">

            <h2 class="text-center">Články</h2>

            <div class="list-group">
                @foreach($articles as $article)
                    <a href="{{ $article->full_url }}" class="list-group-item">
                        <img src="{{ $article->thumbnail_url }}" width="100">
                        <div style="display: inline-block;">
                            <strong>{{ $article->title }}</strong>
                            <p>
                                {{ $article->perex }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            @if(!$articles->count())
                <h4> <em>{{ $context->trans('articles.no_articles') }}</em> </h4>
            @endif

        </div>
    </div>--}}

@endsection