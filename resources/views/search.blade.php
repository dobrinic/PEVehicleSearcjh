@extends('front.includes.master', ['bodyBgClass' => 'search'])

@section('title')
    Search | The Norwegian Standard
@endsection

@section('keywords')
    {{ config('seo.keywords') }}
@endsection

@section('description')
    {{ config('seo.description') }}
@endsection

@section('content')
<div class="content">

    @include('front.includes.advertisement.advert-top'){{-- Only on desktop --}}

    {!! BreakingNews::generate() !!}

    <div class="category-header">

        @include('front.includes.advertisement.advert-between-mobile'){{-- Only on mobile --}}

        {{-- Tag Header --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-wrapper">
                        <form action="{{ route('search.show') }}" method="GET" class="search-wrapper" id="searchForm">
                            <input class="category-title" type="text" name="query" id="query" value="{{ $search ?? '' }}" placeholder="Type the search term">
                            <input type="hidden" name="sort" id="sort" value="published_at">
                            <input type="hidden" name="filter" id="filter" value="all">
                            <button class="btn search-button">
                                <img class="hide-mobile" src="{{ asset('img/icons/search_white.svg') }}">
                                SEARCH
                            </button>
                        </form>
                    </div>
                    @if ($articles->isNotEmpty() && $search !== false)
                        <div class="row subcategory-menu">
                            <div class="col-lg-12">
                                <ul class="nav">
                                    <div class="d-flex">
                                        <li class="nav-item sort-by">
                                            <span>Sort by</span>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownSortBy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span id="dropdownSortBySelected">Latest</span>
                                                    &nbsp;
                                                    <img src="{{ asset('img/icons/arrow_down.svg') }}" width="10" class="arrow-dropdown">
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownSortBy">
                                                    <a href="javascript:;" class="dropdown-item" data-filter="published_at">Latest</a>
                                                    <a href="javascript:;" class="dropdown-item" data-filter="view_count">Most popular</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item filter-by">
                                            <span>Filter by</span>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownFilterBy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span id="dropdownFilterBySelected">All news</span>
                                                    &nbsp;
                                                    <img src="{{ asset('img/icons/arrow_down.svg') }}" width="10" class="arrow-dropdown">
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownFilterBy">
                                                    <a href="javascript:;" class="dropdown-item"  data-filter="all">All news</a>
                                                    @foreach ($categories as $category)
                                                        <a href="javascript:;" class="dropdown-item" data-filter="{{ $category->id }}">{{ str_replace(' and ', '&', $category->name) }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="nav-item article-count">
                                        {{ $articles->total() }}
                                        results
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="article-count only-mobile">
                            {{ $articles->total() }}
                            results
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- End Tag Header --}}

    @if ($articles->isNotEmpty() && $search !== false)
    <section class="main-section">
        <div class="container">
            <div class="row">
                <div class="main-content">
                    <div class="row-custom">
                        <div class="col-lg-12">
                            <ul id="append-articles" class="list-group list-group-flush">
                                @foreach ($articles as $key => $article)
                                    <li class="list-group-item">
                                        <a href="{{ route('article.show', [$article->template->slug, $article]) }}">
                                            <div class="row">
                                                <div class="col-8 list-group-item-headline">
                                                    <h5 class="article-title">{{ $article->template->title }}</h5>
                                                    <div class="short-content">{{ $article->template->short_content }}</div>
                                                    <div class="card-category">
                                                        <span style="{{ $article->published_at->diffInMinutes() < 31 ? 'color: '.$article->category->getCategoryColorBySlug($article->category->parentCategory->slug) : '' }}">{{ $article->published_at->diffForHumans() }}</span>
                                                        <span> &#8212; </span>
                                                        {{ $article->category->parentCategory->name }}
                                                    </div>
                                                </div>
                                                <div class="col-4 list-group-item-image">
                                                    <div class="card-img-container">
                                                        <img class="list-img-right" src="{{ $article->image()->path }}" alt="{{ $article->template->cover_alt ?? $article->image()->title }}">
                                                        {{-- article icon --}}
                                                        @if ($article->getTypeIcon())
                                                            <div class="icon-type" style="background-image:url({{ asset($article->getTypeIcon()) }})"></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        @includeWhen(++$key % 5 == 0,'front.includes.advertisement.advert-between-mobile'){{-- Only on mobile --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{-- Only on mobile --}}
                    <div class="see-all-mobile">
                        <a class="load-more-articles-button see-all-link">
                            <span>LOAD MORE STORIES</span>
                            <img src="{{ asset('img/icons/arrow_down.svg') }}" class="arrow-dropdown">
                        </a>
                    </div>
                    {{-- Only on desktop --}}
                    <div class="article-paginator">
                        <button class="load-more-articles-button">
                            LOAD MORE ARTICLES
                            <img src="{{ asset('img/icons/arrow_down.svg') }}" class="arrow-dropdown">
                        </button>
                    </div>
                </div>
                {{-- BEGIN SIDEBAR --}}
                <aside class="sidebar">
                    @include('front.includes.advertisement.advert-sidebar')
                    <div class="sidebar-header">
                        <h5 class="sidebar-title">MOST POPULAR</h5>
                        <a href="{{ route('most-popular.show') }}" class="see-all-link">SEE ALL
                            <img src="{{ asset('img/icons/arrow_more.svg') }}">
                        </a>
                    </div>
                    <div class="list-group-parent">
                        <ul class="list-group list-group-flush">
                            @foreach ($most_popular_articles as $key => $article)
                                <li class="list-group-item">
                                    <a href="{{ route('article.show', [$article->template->slug, $article]) }}">
                                        <div class="list-group-item-headline">
                                            <span class="ordinal-number">{{ ++$key.'. ' }}</span>
                                            <div class="article-info">
                                                <h5 class="article-title">{{ $article->template->title }}</h5>
                                                <span class="category-name">{{ $article->category->name }}</span>
                                            </div>
                                        </div>
                                        <div class="list-group-item-image">
                                            <div class="card-img-container">
                                                <img class="list-img-right" src="{{ $article->image()->path }}" alt="{{ $article->template->cover_alt ?? $article->image()->title }}">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @include('front.includes.advertisement.advert-sidebar')
                </aside>
                {{-- END SIDEBAR --}}
            </div>
            @include('front.includes.advertisement.advert-top')
            @include('front.includes.advertisement.advert-between-mobile'){{-- Only on mobile --}}
            <hr>
        </div>
    </section>
    @else
        @if ($search !== false)
            <h4 class="text-center font-weight-normal font-italic mb-5">We're sorry, we couldn't find any results for <span class="font-weight-bold">&quot;{{ $search }}&quot;</span></h4>
            {{-- TODO ispisati tekst kada nema članaka --}}
        @endif
    @endif

</div>
@endsection

@if ($search !== false)
@push('scripts')
<script src="{{ asset('js/front/functions.js') }}"></script>
<script>

    $(document).ready(function () {
        var query = GetURLParameter('query');
        var sort = GetURLParameter('sort');
        var filter = GetURLParameter('filter');

        // Set form hidden fields
        SetFormInputFilters('#searchForm', sort, filter);

        var loadMoreArticlesPageNumber = 2;
        $('.load-more-articles-button').click(function(){
            $.ajax({
                type : 'GET',
                url: "{{ route('search.show') }}?query="+query+"&sort="+sort+"&filter="+filter+"&page=" + loadMoreArticlesPageNumber,
                success : function(data){
                    loadMoreArticlesPageNumber += 1;
                    if(data.html.length !== 0){
                        $('#append-articles').append(data.html);
                    }
                    if(data.more === false){
                        $('.load-more-articles-button').html('NO MORE ARTICLES').css('justify-content', 'space-around').attr("disabled", "disabled");
                    }
                },error: function(data){

                },
            });
        });

        // Set dropdown filters
        SetDropdownFilter('#dropdownSortBy', '#dropdownSortBySelected', '#searchForm', '#sort');
        SetDropdownFilter('#dropdownFilterBy', '#dropdownFilterBySelected', '#searchForm', '#filter');

    });

</script>
@endpush
@endif
