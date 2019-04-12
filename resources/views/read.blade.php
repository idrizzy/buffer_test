@include('autoload.header')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <legend>Read Article</legend>
                    <p class="lead">{{ $articles->title}}</p>
                    <p class="lead">{{ $articles->description}}</p>
                </div>
            </div>
        </div>
    </div>
    
    @include('autoload.footer')