@include('autoload.header')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{url('/insert')}}">
                {{csrf_field()}}
                <legend>Laravel Crud Application</legend>
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div> 
                    @endforeach
                @endif
                    <div class="form-group">
                        <label for="title" class="form-control">Title</label>
                        <input type="text" name="title" class="form-control" id="title" >
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Enter Description" name="description">
                    </div>
                    <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <a href="{{url('/')}}" class="btn btn-sm btn-info">back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @include('autoload.footer')