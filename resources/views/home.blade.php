@extends('includes.master')

@section('title')
    Parts Europe
@endsection

@section('content')
<div class="content">

    @include('includes.notifications')

    <section class="section">
        <div class="container">
            <div class="jumbotron">
                <h1 class="display-4">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>

                <form action="{{ route('vehicles.import') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="vehicles_list" name="vehicles_list">
                                    <label class="custom-file-label" for="vehicles_list">Choose vehicles file</label>
                                </div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </div>
                </form>

                <form action="{{ route('parts.import') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="parts_list" name="parts_list">
                                <label class="custom-file-label" for="parts_list">Choose parts file</label>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>

                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <p class="lead">
                  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p>
            </div>
        </div>
    </section>

</div>
@endsection
