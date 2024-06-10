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
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.announcements.store') }}">
            @csrf
            <div class="row">
                <div class="nk-gap-4"></div>
                <div class="col-lg-12 pb-4">
                    <h1 v-html="announcement.title">Title</h1>
                    <div class="nk-post-meta"><span v-html="announcementDate">{{ date('Y') }}</span></div>
                </div>
                <div class="col-lg-4 pb-4">
                    <label for="annoucement_date">Announcement Date</label>
                    <input type="date" class="form-control" name="announcement_date" id="annoucement_date"
                        v-model="announcement.announcement_date">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pb-4">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title"
                        v-model="announcement.title" placeholder="Announcement Title">
                </div>
                <div class="col-lg-12 pb-4">
                    <label for="froala-editor">Content</label>
                    <!-- START: Post -->
                    <div class="nk-blog-post nk-blog-post-single">
                        <!-- START: Post Text -->
                        <textarea class="nk-post-text" name="content" id="froala-editor" v-model="announcement.content"></textarea>
                        <!-- END: Post Text -->
                    </div>
                    <!-- END: Post -->
                    <div class="nk-gap-1"></div>
                </div>
                <div class="col-lg-12 pb-4">
                    <button type="post" class="btn btn-success button">Publish</button>
                </div>
                <div class="col-lg-8 pb-4">
                    <label for="announcement_file">Attachment</label>
                    <input type="file" name="announcement_file" id="announcement_file"
                        v-model="announcement.announcement_file">
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
                    announcement: {
                        announcement_date: moment().format('YYYY-MM-DD'),
                        title: 'Announcement',
                        content: 'Edit your content here!',
                        announcement_file: null,
                    }
                },
                methods: {
                    asset: function(url) {
                        return asset_url + url;
                    },
                },
                computed: {
                    announcementDate: function() {
                        return moment(this.announcement_date).format('MMMM DD, YYYY');
                    }
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
