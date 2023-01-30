@include('dashboard.layouts.header')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <!-- new sponsor card-->
            <div class="card mb-4">
                <div class="card-header">Update Sponsor</div>
                <div class="card-body">
                    <form action="{{ route('sponsor.update',$sponsor->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="small mb-1" for="logo">Logo <span class="text-danger">*</span></label>
                            <input class="form-control" id="logo" name="logo" type="file" placeholder="Select Logo">
                        </div>
                        <button class="btn btn-primary" type="submit">Update Sponsor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.layouts.footer')
