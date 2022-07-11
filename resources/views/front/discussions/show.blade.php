<x-app-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>


<!--// Mini Header \\-->
<div class="wm-mini-header">
    <span class="wm-blue-transparent"></span>
     <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wm-mini-title">
                       <h1>Forum</h1>
                </div>
                <div class="wm-breadcrumb">
                      <ul>
                           <li><a href="{{ route('home') }}">Accueil</a></li>
                           <li><a href="{{ route('discussions.index') }}">Forum</a></li>
                           <li>Discussion</li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>
  <!--// Mini Header \\-->

<!--// Main Content \\-->
<div class="wm-main-content">

    <!--// Main Section \\-->
    <div class="wm-main-section">
        <div class="container">
            <div class="row">
                <aside class="col-md-3">
                    <div class="widget widget_categories">
                        <div class="wm-widget-title">
                            <h2>Chaines</h2>
                        </div>
                        <ul>
                            <li><a href="{{ route('discussions.index') }}" class="nav-link nav-link-faded has-icon {{ empty(request()->query('channel')) ? 'active' : '' }}">Toutes les chaines</a></li>
                            @foreach ($channels as $channel)
                                <li><a href="{{ route('discussions.index') }}?channel={{ $channel->slug }}" class="nav-link nav-link-faded has-icon {{ (request()->query('channel') == $channel->slug ) ? 'active' : '' }}">{{ $channel->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget_tags">
                        <div class="wm-widget-title">
                            <h2>Categories</h2>
                        </div>
                        <div class="tags">
                            @foreach ($categories as $categorie)
                                <a href="{{ route('CategorieFormations', $categorie->slug) }}">{{ $categorie->nom }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="widget widget_latestnews">
                        <div class="wm-widget-title">
                            <h2>Formations recentes</h2>
                        </div>
                        <ul>
                            @foreach ($nouveautes as $nouveaute)
                                <li>
                                    <figure>
                                        <a href="{{ route('formations.show', $nouveaute->slug) }}"><img src="{{ asset('storage/'.$nouveaute->photo_url) }}" alt="" style="height: 70px !important; width:70px !important;"></a>
                                    </figure>
                                    <div class="wm-latestnews">
                                        <h5><a href="{{ route('formations.show', $nouveaute->slug) }}">{{ $nouveaute->nom }}</a></h5>
                                        <p>{{ Str::substr($nouveaute->description, 0, 100) }} ...</p>
                                        <time datetime="2008-02-14 20:00">{{ $nouveaute->created_at->format('d/m/Y') }}</time>
                                        <a href="{{ route('formations.show', $nouveaute->slug) }}"><i class="fas fa-folder-open"></i></i>21</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>

                <div class="col-md-9">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="wm-blog-single">
                        <figure class="wm-detail-thumb">
                            <img src="{{ asset('storage/'.$discussion->photo_url) }}" style="height: 345px !important; width: 848px !important;" alt="">
                        </figure>
                        <div class="wm-blog-author">
                            <div class="wm-blogauthor-left">
                                <img src="{{ asset('storage/'.$discussion->author->photo_url) }}" style="height: 60px !important; width: 60px !important;" alt="">
                                <a class="wm-authorpost" href="">Publié par: <span> {{ $discussion->author->nom_utilisateur }} </span></a>
                            </div>
                        </div>
                        <ul class="wm-blog-post-option">
                            <li>
                                <time datetime="2008-02-14 20:00">{{ $discussion->created_at->format('d/m/Y') }}</time>
                            </li>
                            <li>
                                <a>
                                    <i class="fas fa-comment"></i> {{ count($discussion->replies) }} Reponses
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="fas fa-folder-open"></i>{{ $discussion->channel->name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="wm-detail-editore">
                        {!! $discussion->content !!}
                    </div>
                    <div class="wm-author-detail" style="margin-top: 30px !important;">
                        <figure>
                            <a href="#"><img src="{{ asset('storage/'.$discussion->author->photo_url) }}" style="height: 131px !important; width: 131px !important;" alt=""></a>
                        </figure>
                        <div class="wm-author-text">
                            <h5><a href="#">{{ $discussion->author->nom_utilisateur }} - {{ $discussion->author->getRoleNames()->first() }}</a></h5>
                        </div>
                    </div>
                    <div class="wm-postreviews">
                        <div class="wm-widgettitle">
                            <h2><span>Reponses</span></h2>
                        </div>
                           <ul>

                            @if ($discussion->bestReply)
                                <li style="background-color: rgba(237,237,237,1) !important;">
                                    <div class="thumblist">
                                        <ul>
                                            <li>
                                                <h4><a href="#">{{ $discussion->bestReply->owner->nom_utilisateur }} - {{ $discussion->bestReply->owner->getRoleNames()->first() }}</a></h4>
                                                <figure><a href="blog-detail.html"><img src="{{ asset('storage/' .$discussion->bestReply->owner->photo_url) }}" style="height: 62px !important; width: 62px !important;" alt=""></a></figure>
                                                <div class="wm-reviews-text">
                                                    <div class="row">
                                                        <span style="float: left !important;">{{ $discussion->bestReply->created_at->diffForHumans() }}</span>
                                                        <h4 style="float: right !important;">Meilleure reponse</h4>
                                                    </div>
                                                    <p>{!! $discussion->bestReply->content !!}</p>
                                                    <br>
                                                    <button class="btn {{ auth()->user() && $discussion->bestReply->isLikedBy(auth()->user()) ? 'text-white' : '' }}" onclick="document.getElementById('like').submit()">
                                                        <span class="fa fa-thumbs-up"></span> {{ $discussion->bestReply->likeCount() }}
                                                    </button>
                                                    <button class="btn {{ auth()->user() && $discussion->bestReply->isDislikedBy(auth()->user()) ? 'text-white' : '' }}" onclick="document.getElementById('dislike').submit()">
                                                        <span class="fa fa-thumbs-down ml-2"></span> {{ $discussion->bestReply->dislikeCount() }}
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @auth
                                @if($discussion->bestReply)
                                    <form action="{{ $discussion->bestReply->isLikedBy(auth()->user()) ? route('likes.dislike', $discussion->bestReply->id) : route('likes.like',  $discussion->bestReply->id) }}" method="POST" id="like">
                                        @csrf
                                        @if($discussion->bestReply->isLikedBy(auth()->user()) || $discussion->bestReply->isDislikedBy(auth()->user()))
                                            @method('delete')
                                        @endif
                                    </form>

                                    <form action="{{ $discussion->bestReply->isDislikedBy(auth()->user()) ? route('likes.undislike', $discussion->bestReply->id) : route('likes.dislike', $discussion->bestReply->id) }}" method="POST" id="dislike">
                                        @csrf
                                        @if($discussion->bestReply->isdislikedBy(auth()->user()) || $discussion->bestReply->isLikedBy(auth()->user()))
                                            @method('delete')
                                        @endif
                                    </form>
                                @endif
                            @endauth

                            @foreach ($replies as $reply)
                                <li>
                                    <div class="thumblist">
                                        <ul>
                                            <li>
                                                <h4><a href="#">{{ $reply->owner->nom_utilisateur }}</a></h4>
                                                <figure><a><img src="{{ asset('storage/' .$reply->owner->photo_url) }}" style="height: 62px !important; width: 62px !important;" alt=""></a></figure>
                                                <div class="wm-reviews-text">
                                                    <div class="row">
                                                        <span style="float: left !important;">{{ $reply->created_at->diffForHumans() }}</span>
                                                        @if(auth()->user() && auth()->user()->id == $discussion->user_id)
                                                            @if ($discussion->bestReply === $reply->id)
                                                                <h4 style="float: right !important;">Meilleure reponse</h4>
                                                            @else
                                                                <form action="{{ route('BestReply', [$discussion->slug, $reply->id]) }}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success" style="float: right !important;">Choisir Meilleure reponse</button>
                                                                </form>
                                                                @role('admin')
                                                                    <form action="{{ route('admin.replies.destroy', $reply) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-danger btn-sm" style="color: white !important;">Supprimer</button>
                                                                    </form>
                                                                @endrole
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <p>{!! $reply->content !!}</p>
                                                    <br>
                                                    <button class="btn text-primary {{ auth()->user() && !$reply->isLikedBy(auth()->user()) ? 'text-secondary' : '' }}" onclick="document.getElementById('like{{$reply->id}}').submit()">
                                                        <span class="fa fa-thumbs-up"></span> {{ $reply->likeCount() }}
                                                    </button>
                                                    <button class="btn text-primary {{ auth()->user() && !$reply->isdislikedBy(auth()->user()) ? 'text-secondary' : '' }}" onclick="document.getElementById('dislike{{$reply->id}}').submit()">
                                                        <span class="fa fa-thumbs-down ml-2"></span> {{ $reply->dislikeCount() }}
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @auth
                        <form action="{{ $reply->isLikedBy(auth()->user()) ? route('likes.unlike', $reply->id) : route('likes.like', $reply->id) }}" method="POST" id="like{{$reply->id}}">
                            @csrf
                            @if($reply->isLikedBy(auth()->user()) || $reply->isDislikedBy(auth()->user()))
                                @method('delete')
                            @endif
                        </form>

                        <form action="{{ $reply->isDislikedBy(auth()->user()) ? route('likes.undislike', $reply->id) : route('likes.dislike', $reply->id) }}" method="POST" id="dislike{{$reply->id}}">
                            @csrf
                            @if($reply->isDislikedBy(auth()->user()))
                                @method('delete')
                            @endif
                        </form>
                    @endauth
                            @endforeach
                        </ul>
                       </div>
                    <div class="wm-form">
                        <div class="wm-widgettitle">
                            <h2> Repondre a <span>la discussion</span></h2>
                        </div>
                        <form action="{{ route('discussions.replies.store', $discussion->slug) }}" method="POST">
                            @csrf
                            <ul>
                                <textarea name="content" id="editor">
                                </textarea>
                                <li class="wm-full-form">
                                    <input type="submit" value="Repondre">
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// Main Section \\-->

    <!--// Main Section \\-->
</div>
<!--// Main Content \\-->

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
</x-app-layout>
<script>
