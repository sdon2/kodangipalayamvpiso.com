<section class="mx-auto mt-4" style="background: #06973d;">

    <footer class="pt-3" style="color: #ffffff">
        <div class="container text-center pb-4">
            <div class="col-12">
                <small>
                    Contents Owned and Updated by {{ config('app.name') }}<br>
                    Designed &amp; Developed by SVP Infotech, Tiruppur.<br>
                    Last updated on {{ \Carbon\Carbon::parse(\App\Models\Page::latest('updated_at')->first()->updated_at)->format('d/m/Y h:i A') }}<br>
                </small>
            </div>
        </div>
    </footer>

</section>
