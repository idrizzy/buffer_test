@include('autoload.header')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <legend>Laravel Crud Application</legend>
                    @if(session('info'))
                    <div class="alert alert-success"> {{session('info')}}</div>
                    @endif
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        @if(count($articles) > 0)
                            @foreach($articles->all() as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>{{$article->title}}</td>
                                <td>{{$article->description}}</td>
                                <td>
                                <a class="btn btn-primary btn-sm" href='{{url("/read/{$article->id}")}}'>Read</a>
                                <a class="btn btn-info btn-sm" href='{{url("/update/{$article->id}")}}'>Edit</a>
                                <a class="btn btn-danger btn-sm" href='{{url("/delete/{$article->id}")}}'>Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @include('autoload.footer')