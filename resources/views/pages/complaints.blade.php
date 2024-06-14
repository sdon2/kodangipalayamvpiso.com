<x-guest-layout>

    @section('title', __($page->title))

    <x-slot name="keywords">
        {{ $page->keywords }}
    </x-slot>

    <x-slot name="description">
        {{ $page->description }}
    </x-slot>

    @push('content')
        <div class="container pt-4">
            <div class="h2">{{ __('Make a complaint') }}</div>
        </div>

        <div class="container pt-4">
            {!! $page->content !!}
        </div>

        @if (Session::has('success'))
            <div class="container">
                <div class="my-4 py-4 alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            </div>
        @elseif (Session::has('error'))
            <div class="container">
                <div class="my-4 py-4 alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            </div>
        @endif

        @if (!Session::has('success') && !Session::has('error'))
            <div class = "container pt-4">
                <form method="POST" action="{{ route('complaint.receive') }}">
                    @csrf
                    <div class="controls">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }} *</label>
                                    <input id="name" type="text" name="name" class="form-control"
                                        placeholder="{{ __('Please enter your name') }} *" required value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="phone">{{ __('Phone Number') }} *</label>
                                    <input id="phone" type="text" name="phone" class="form-control"
                                placeholder="{{ __('Please enter your phone number') }} *" required value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">{{ __('Complaint Message') }} *</label>
                                    <textarea id="message" name="message" class="form-control" rows="4" required
                                        placeholder="{{ __('Please enter your complaint message') }} *">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send  pt-2 btn-block               "
                                    value="{{ __('Send Message') }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    @endpush

    @push('styles')
        <style>
            .invalid-feedback {
                display: block;
            }
        </style>
    @endpush

</x-guest-layout>
