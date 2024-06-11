<x-vue-layout>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style: none">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.events.store') }}" id="form">
            @csrf
            <div class="row">
                <div class="nk-gap-4"></div>
                <div class="col-lg-12 pb-4">
                    <h1 v-html="event.title">Title</h1>
                    <div class="nk-post-meta"><span v-html="eventDate">{{ date('Y') }}</span></div>
                </div>
                <div class="col-lg-4 pb-4">
                    <label for="event_date">Event Date</label>
                    <input type="date" class="form-control" name="event_date" id="event_date"
                        v-model="event.event_date">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pb-4">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" v-model="event.title"
                        placeholder="Event Title">
                </div>
                <div class="col-lg-12 pb-4">
                    <label for="froala-editor">Content</label>
                    <!-- START: Post -->
                    <div class="nk-blog-post nk-blog-post-single">
                        <!-- START: Post Text -->
                        <textarea class="nk-post-text" name="content" id="froala-editor" v-model="event.content"></textarea>
                        <!-- END: Post Text -->
                    </div>
                    <!-- END: Post -->
                    <div class="nk-gap-1"></div>
                </div>
                <div class="col-lg-12 pb-4">
                    <div class="dropbox w-100">
                        <input type="file" id="event_images" multiple name="event_images[]"
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
                    <button type="post" class="btn btn-success button">Publish</button>
                </div>
                <div class="border p-2" v-if="preview_list.length > 0">
                    <p>Preview:</p>
                    <div class="row">
                        <template>
                            <div class="col-3" style="position: relative;" v-for="item, index in preview_list"
                                :key="index">
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
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/vendor/froala-editor-3.2.6/css/froala_editor.pkgd.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/vendor/froala-editor-3.2.6/css/plugins.pkgd.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/jquery.toast/jquery.toast.min.css') }}">
        <style type="text/css">
            .nk-post-meta {
                margin-bottom: 10px;
            }

            .button {
                margin-bottom: 20px;
            }

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

        <script src="{{ asset('assets/vendor/froala-editor-3.2.6/js/froala_editor.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/froala-editor-3.2.6/js/plugins.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/froala-editor-3.2.6/js/froala_kg.js') }}"></script>
        <script src="{{ asset('assets/vendor/transliteration.I.js') }}"></script>
        <script>
            let editor;

            const asset_url = '{{ asset(null) }}';

            let formData = new FormData(document.getElementById('form'));

            const STATUS_INITIAL = 0,
                STATUS_SAVING = 1,
                STATUS_SUCCESS = 2,
                STATUS_FAILED = 3;

            const app = new Vue({
                el: '#app',
                data: {
                    currentStatus: null,
                    preview_list: [],
                    fileCount: 0,
                    event: {
                        event_date: moment().format('YYYY-MM-DD'),
                        title: 'Event',
                        content: 'Edit your content here!',
                        event_images: [],
                    }
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
                    previewImages: function() {
                        var input = document.getElementById('event_images');
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
                        var input = document.getElementById('event_images');
                        var files = Array.from(input.files);

                        files.splice(index, 1);
                        this.preview_list.splice(index, 1);

                        var updated = new DataTransfer();
                        files.forEach(file => updated.items.add(file));

                        document.getElementById('event_images').files = updated.files;
                    },
                },
                computed: {
                    eventDate: function() {
                        return moment(this.event_date).format('MMMM DD, YYYY');
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
                    },
                },
                mounted() {
                    this.reset();
                },
            });

            editor = new FroalaEditor('#froala-editor', {
                key: froala_license,
                attribution: false,
                charCounterCount: true,
                pluginsEnabled: [
                    //'align', 'charCounter', 'codeBeautifier', 'codeView', 'colors', 'draggable', 'embedly', 'emoticons', 'entities', 'file', 'fontAwesome', 'fontFamily', 'fontSize', 'fullscreen', 'image', 'imageTUI', 'imageManager', 'inlineStyle', 'inlineClass', 'lineBreaker', 'lineHeight', 'link', 'lists', 'paragraphFormat', 'paragraphStyle', 'quickInsert', 'quote', 'save', 'table', 'url', 'video', 'wordPaste'
                    'align', 'codeBeautifier', 'colors', 'draggable', 'entities', 'fontFamily', 'fontSize', 'image',
                    'imageManager', 'inlineStyle', 'inlineClass', 'lineBreaker', 'lineHeight', 'link', 'lists',
                    'paragraphFormat', 'paragraphStyle', 'quickInsert', 'quote', 'table', 'url', 'wordPaste'
                ],
                imageUploadURL: '{{ route('image.upload') }}',
                imageManagerLoadURL: '{{ route('image.list') }}',
                imageManagerDeleteURL: '{{ route('image.delete') }}',
            });
        </script>
    @endpush

</x-vue-layout>
