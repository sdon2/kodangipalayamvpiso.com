<x-vue-layout>

    <div class="container">
        <div class="row">
            <div class="nk-gap-4"></div>
            <div class="col-lg-12 pb-4">
                <h1 v-html="page.title">Title</h1>
                <div class="nk-post-meta"><span v-html="createdAt">{{ date('Y') }}</span></div>
            </div>
            <div class="col-lg-12 pb-4">
                <div class="d-flex no-gutters">
                    <div class="col-8">
                        <label for="page_title">Title</label>
                        <input type="text" class="form-control" name="title" id="page_title" v-model="page.title"
                            placeholder="Post Title">
                    </div>
                    <div class="col-4">
                        <label for="show_in_menu">Show in Menu</label>
                        <div class="px-2">
                            <input type="checkbox" class="mr-4" name="show_in_menu" id="show_in_menu"
                                v-model="page.show_in_menu">
                            <input type="text" name="menu_order" id="menu_order" v-model="page.menu_order"
                                placeholder="Menu Order" v-if="page.show_in_menu" style="width:100px">
                            <input type="text" name="menu_icon" id="menu_icon" v-model="page.menu_icon"
                                placeholder="Menu Icon" v-if="page.show_in_menu" style="width:150px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 pb-4">
                <label for="page_description">Description</label>
                <input type="text" class="form-control" name="desciprion" id="page_description"
                    v-model="page.description" placeholder="Post Description">
            </div>
            <div class="col-lg-12 pb-4">
                <template v-if="page.src_image.id === 0">
                    <label for="featured-image">Featured Image</label>
                    <input type="file" class="d-block" name="featured-image" v-on:change="handleFile($event)" />
                </template>
                <template v-else>
                    <button type="button" v-on:click="removeImage()" class="btn btn-danger">Remove Image</button>
                </template>
            </div>
            <div class="col-lg-12 pb-4">
                <label for="froala-editor">Content</label>
                <!-- START: Post -->
                <div class="nk-blog-post nk-blog-post-single">
                    <!-- START: Post Text -->
                    <textarea class="nk-post-text" id="froala-editor" v-model="page.content"></textarea>
                    <!-- END: Post Text -->
                </div>
                <!-- END: Post -->
                <div class="nk-gap-1"></div>
            </div>
            <div class="col-lg-12 pb-4">
                <button type="button" class="btn btn-success button" v-on:click="publish">Publish</button>
            </div>
            <div v-if="page.src_image.id !== 0" class="pb-4">
                <img class="img-fluid" :src="page.src_image.file" alt="Featured image">
            </div>
        </div>

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

            const app = new Vue({
                el: '#app',
                data: {
                    created_at: moment(),
                    page: {
                        id: '{{ $page->id }}',
                        title: '{{ $page->title }}',
                        keywords: '',
                        description: '{{ $page->description }}',
                        content: {!! json_encode($page->content) !!},
                        show_in_menu: {{ $page->show_in_menu ? 'true' : 'false' }},
                        menu_order: {{ $page->menu_order ?: 'null' }},
                        menu_icon: '{{ $page->menu_icon }}',
                        featured_image: null,
                        src_image: {
                            id: {{ $page->getMedia('featured-images')->first() ? $page->getMedia('featured-images')->first()->id : '0' }},
                            file: '{{ $page->getFirstMedia('featured-images') ? $page->getFirstMedia('featured-images')->getUrl('featured-images') : '' }}',
                        },
                    }
                },
                methods: {
                    asset: function(url) {
                        return asset_url + url;
                    },
                    makeFormData: function() {
                        var keys = Object.keys(this.page);
                        var formData = new FormData();
                        keys.forEach(key => {
                            if (typeof this.page[key] === 'boolean') {
                                this.page[key] = this.page[key] ? 1 : 0;
                            }
                            if (this.page[key] !== null) {
                                formData.append(key, this.page[key]);
                            }
                        });
                        return formData;
                    },
                    publish: function() {
                        if (editor) {
                            this.page.content = editor.html.get();
                            var data = this.makeFormData();
                            axios.get(this.asset('sanctum/csrf-cookie')).then(response => {
                                axios.post('{{ route('admin.pages.update', ['id' => $page->id]) }}',
                                    data, {
                                        headers: {
                                            'Content-Type': 'multipart/form-data'
                                        }
                                    }).then(
                                    response => {
                                        if (response.data.message) {
                                            $.toast({
                                                heading: 'Success',
                                                text: response.data.message,
                                                icon: 'success',
                                                afterShown: function() {
                                                    setTimeout(function() {
                                                        window.location.href =
                                                            "{{ route('admin.pages') }}";
                                                    }, 1000);
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
                        } else {
                            console.error('Editor initialization failed.');
                        }
                    },
                    handleFile: function($event) {
                        if ($event.target.files[0]) {
                            this.page.featured_image = $event.target.files[0];
                        } else {
                            this.page.featured_image = null;
                        }
                    },
                    removeImage: function() {
                        axios.get(this.asset('sanctum/csrf-cookie')).then(response => {
                            axios.post(
                                '{{ route('admin.pages.remove-image', ['id' => $page->id]) }}').then(
                                response => {
                                    if (response.data.message) {
                                        $.toast({
                                            heading: 'Success',
                                            text: response.data.message,
                                            icon: 'success',
                                            afterShown: function() {
                                                setTimeout(function() {
                                                    window.location.href =
                                                        "{{ route('admin.pages.edit', ['id' => $page->id]) }}";
                                                }, 1000);
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
                computed: {
                    createdAt: function() {
                        return this.created_at.format('MMMM DD, YYYY');
                    }
                }
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

            function onLoad() {
                //
            }

            google.setOnLoadCallback(onLoad);
        </script>
    @endpush

</x-vue-layout>
