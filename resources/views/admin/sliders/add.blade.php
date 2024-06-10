<x-vue-layout>

    <div class="container mt-4">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.sliders.store') }}" id="form"
            v-on:sumit="upload">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="h3">Add Slider</div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="slider_name" placeholder="Slider Name" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="dropbox">
                        <input type="file" id="images" multiple name="images[]"
                            v-on:change="filesChange($event.target.name, $event.target.files); fileCount = $event.target.files.length; previewImages($event)"
                            accept="image/*" class="input-file">
                        <p v-if="isInitial">
                            Drag your file(s) here to begin<br> or click to browse
                        </p>
                        <p v-if="isSaving">
                            Uploading <span v-text="fileCount"></span> files...
                        </p>
                    </div>
                </div>
                <div class="col-lg-12 pb-4">
                    <button type="submit" class="btn btn-success button">Save</button>
                </div>
                <div class="border p-2 mt-3" v-if="preview_list.length > 0">
                    <p>Preview:</p>
                    <div class="row">
                        <template>
                            <div class="col-3" style="position: relative;" v-for="item, index in preview_list" :key="index">
                                <a href="#" class="remove-btn" v-on:click="removeImage(index, $event)">
                                    <i class="fa fa-remove" title="Remove Photo"></i>
                                </a>
                                <img :src="item" class="img-fluid py-2" />
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/jquery.toast/jquery.toast.min.css') }}">
        <style type="text/css">
            .remove-btn {
                float: left;
                position: absolute;
                top: 20px;
                padding: 3px 5px;
                left: 25px;
                color: #ffffff;
                background: #cc0000;
                border-radius: 50%;
                font-size: 10px;
            }

            .remove-btn:hover {
                color: #cc0000;
                background: #ffffff;
            }

            .nk-post-meta {
                margin-bottom: 10px;
            }

            .button {
                margin-bottom: 20px;
            }

            .dropbox {
                outline: 2px dashed grey;
                /* the dash box */
                outline-offset: -10px;
                background: lightcyan;
                color: dimgray;
                padding: 10px 10px;
                min-height: 200px;
                margin-bottom: 20px;
                /* minimum height */
                position: relative;
                cursor: pointer;
            }

            .input-file {
                opacity: 0;
                /* invisible but it's there! */
                width: 100%;
                height: 200px;
                position: absolute;
                cursor: pointer;
            }

            .dropbox:hover {
                background: lightblue;
                /* when mouse over to the drop zone, change color */
            }

            .dropbox p {
                font-size: 1.2em;
                text-align: center;
                padding: 50px 0;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/vendor/vue@2.6.12.js') }}"></script>
        <script src="{{ asset('assets/vendor/jquery.toast/jquery.toast.min.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <script>
            const asset_url = '{{ asset(null) }}';

            let formData = new FormData(document.getElementById('form'));

            const STATUS_INITIAL = 0,
                STATUS_SAVING = 1,
                STATUS_SUCCESS = 2,
                STATUS_FAILED = 3;

            const app = new Vue({
                el: '#app',
                data: {
                    slider_name: null,
                    currentStatus: null,
                    preview_list: [],
                    fileCount: 0,
                },
                methods: {
                    reset() {
                        // reset form to initial state
                        this.currentStatus = STATUS_INITIAL;
                        this.uploadError = null;
                    },
                    upload() {

                        formData = new FormData(document.getElementById('form'));

                        // upload data to the server
                        this.currentStatus = STATUS_SAVING;

                        this.save(formData)
                            .then(x => {
                                this.currentStatus = STATUS_SUCCESS;
                            })
                            .catch(err => {
                                this.uploadError = err.response;
                                this.currentStatus = STATUS_FAILED;
                            });
                    },
                    filesChange(fieldName, fileList) {
                        if (!fileList.length) return;

                        // append the files to FormData
                        Array
                            .from(Array(fileList.length).keys())
                            .map(x => {
                                formData.append(fieldName, fileList[x], fileList[x].name);
                            });
                    },
                    asset: function(url) {
                        return asset_url + url;
                    },
                    save: function(formData) {
                        return axios.get(this.asset('sanctum/csrf-cookie')).then(response => {
                            return axios.post('{{ route('admin.sliders.store') }}', formData).then(
                                response => {
                                    if (response.data.message) {
                                        $.toast({
                                            heading: 'Success',
                                            text: response.data.message,
                                            icon: 'success',
                                            afterHidden: function() {
                                                window.location.href =
                                                    "{{ route('admin.pages') }}";
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
                    },
                    previewImages: function() {
                        var input = document.getElementById('images');
                        var count = input.files.length;
                        var index = 0;
                        if (input.files) {
                            while (count--) {
                                var reader = new FileReader();
                                reader.onload = (e) => {
                                    this.preview_list.push(e.target.result);
                                }
                                reader.readAsDataURL(input.files[index]);
                                index++;
                            }
                        }
                    },
                    removeImage: function(index, event) {
                        event.preventDefault();
                        var input = document.getElementById('images');
                        var files = Array.from(input.files);

                        files.splice(index, 1);
                        this.preview_list.splice(index, 1);

                        var updated = new DataTransfer();
                        files.forEach(file => updated.items.add(file));

                        document.getElementById('images').files = updated.files;
                    },
                },
                computed: {
                    createdAt() {
                        return this.created_at.format('MMMM DD, YYYY');
                    },
                    isInitial() {
                        return this.currentStatus === STATUS_INITIAL;
                    },
                    isSaving() {
                        return this.currentStatus === STATUS_SAVING;
                    },
                    isSuccess() {
                        return this.currentStatus === STATUS_SUCCESS;
                    },
                    isFailed() {
                        return this.currentStatus === STATUS_FAILED;
                    }
                },
                mounted() {
                    this.reset();
                },
            });
        </script>
    @endpush

</x-vue-layout>
