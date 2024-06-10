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
        <form method="POST" enctype="multipart/form-data"
            action="{{ route('admin.announcements.update', ['id' => $announcement->id]) }}">
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
                    <button type="submit" class="btn btn-success button">Publish</button>
                </div>
                @if ($announcement->getFirstMediaUrl('announcement-files'))
                    <div class="col-lg-2 pb-4">
                        <label for="announcement_file">Attachment:</label>
                        <a href="{{ $announcement->getFirstMediaUrl('announcement-files') }}" target="_blank">Download</a>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" v-on:click="removeAttachment()" class="button">Delete</button>
                    </div>
                @else
                    <div class="col-lg-8 pb-4">
                        <label for="announcement_file">Attachment</label>
                        <input type="file" name="announcement_file" id="announcement_file"
                            v-model="announcement.announcement_file">
                    </div>
                @endif
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
                        announcement_date: '{{ \Carbon\Carbon::parse($announcement->announcement_date)->format('Y-m-d') }}',
                        title: '{{ $announcement->title }}',
                        content: {!! json_encode($announcement->content) !!},
                        announcement_file: null,
                    }
                },
                methods: {
                    asset: function(url) {
                        return asset_url + url;
                    },
                    removeAttachment: function() {
                        axios.get(this.asset('sanctum/csrf-cookie')).then(response => {
                            axios.post(
                                '{{ route('admin.announcements.remove-attachment', ['id' => $announcement->id]) }}',
                                this.announcement).then(
                                response => {
                                    if (response.data.message) {
                                        $.toast({
                                            heading: 'Success',
                                            text: response.data.message,
                                            icon: 'success',
                                            afterHidden: function() {
                                                window.location.href =
                                                    "{{ route('admin.announcements.edit', ['id' => $announcement->id]) }}";
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
