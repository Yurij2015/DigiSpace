<div class="row justify-content-lg-center">
    <div class="col-sm-12">
        <div class="table-custom-responsive">
            <table class="table-custom table-custom-secondary" aria-label="List of services">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listOfServices as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->title }}</td>
                        <td>{{ $service->details }}</td>
                        <td>
                            @if($service->price)$@endif{{ $service->price }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
