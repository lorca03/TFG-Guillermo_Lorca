<div class="modal fade" id="watchlistModal{{$friend->name}}" tabindex="-1" aria-labelledby="watchlistModalLabel{{$friend->name}}" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="background-color:#ecb42d;color:#FFF; border:1px solid white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="watchlistModalLabel{{$friend->name}}">{{'@'.$friend->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php($watchlist= new \App\Models\Watchlist())
                <ul>
                    @foreach($watchlist->registros($friend->id) as $contenido)
                        @php($parts = explode("/",$contenido->contenido))
                        <li>
                            <form method="POST" action="{{route($parts[0],['slug' => Str::slug($parts[2])])}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$parts[1]}}">
                                <button type="submit" class="text-green">
                                    {{$parts[2]}}
                                </button>
                            </form>
                        </li>
                        <hr style="border: none; border-top: 2px dashed white; width: 100%; margin: 20px auto;">
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
