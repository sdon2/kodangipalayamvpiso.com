<x-vue-layout>

    <div class="container">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.sliders.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="h3">Add Slider</div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="slider_name" placeholder="Slider Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Images</label>
                        <input type="file" name="images[]" multiple>
                    </div>
                </div>
                <div class="col-lg-12 pb-4">
                    <button type="submit" class="btn btn-success button">Save</button>
                </div>
            </div>
        </form>
    </div>

    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/jquery.toast/jquery.toast.min.css') }}">
        <style type="text/css">
            .nk-post-meta {
                margin-bottom: 10px;
            }

            .button {
                margin-bottom: 20px;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/vendor/vue@2.6.12.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.toast/jquery.toast.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    @endpush

</x-vue-layout>
