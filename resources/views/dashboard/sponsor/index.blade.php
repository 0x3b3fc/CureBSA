@include('dashboard.layouts.header')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sponsor List <a href="{{ route('sponsor.create') }}"
                                                                          class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right">Add
                    Sponsor</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sponsors as $sponsor)
                        <tr>
                            <td>
                                <img src="/storage/images/sponsors/{{ $sponsor->logo }}" style="width: 70px;"
                                     alt="Sponsor Logo">
                            </td>
                            <td>
                                <div class="container">
                                    <div class="row">
                                        <a href="{{ route('sponsor.edit',$sponsor->id) }}"
                                           class="btn btn-warning">Edit</a>
                                        <div class="col-12 col-md-6">
                                            <form action="{{ route('sponsor.destroy',$sponsor->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@include('dashboard.layouts.footer')
