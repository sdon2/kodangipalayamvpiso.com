<x-vue-layout>

    <div class="container">
        <div class="row">
            <div class="nk-gap-4"></div>
            <div class="col-lg-12 pb-4">
                <div class="d-flex no-gutters">
                    <div class="col-8">
                        <label for="scroll_text">Scroll Text</label>
                        <input type="text" class="form-control" name="scroll_text" id="scroll_text"
                            v-model="scroll_text.scroll_text" placeholder="Scroll Text">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 pb-4">
                <button type="button" class="btn btn-success button" v-on:click="save">Save</button>
            </div>
        </div>

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
        <script>
            const asset_url = '{{ asset(null) }}';

            const app = new Vue({
                el: '#app',
                data: {
                    scroll_text: {
                        scroll_text: '',
                    }
                },
                methods: {
                    asset: function(url) {
                        return asset_url + url;
                    },
                    save: function() {
                        axios.get(this.asset('sanctum/csrf-cookie')).then(response => {
                            axios.post('{{ route('admin.scroll-texts.store') }}', this.scroll_text)
                                .then(
                                    response => {
                                        if (response.data.message) {
                                            $.toast({
                                                heading: 'Success',
                                                text: response.data.message,
                                                icon: 'success',
                                                afterHidden: function() {
                                                    window.location.href =
                                                        "{{ route('admin.scroll-texts') }}";
                                                }
                                            });
                                        }
                                    }, error => {
                                        $.toast({
                                            heading: 'Error',
                                            text: error,
                                            icon: 'error',
                                        });
                                    });
                        }, error => {
                            $.toast({
                                heading: 'Error',
                                text: error,
                                icon: 'error',
                            });
                        });
                    }
                },
            });
        </script>
    @endpush

</x-vue-layout>
