<div class="row">
    <div class="col-6 col-md-3">
        <p>
            <i class="fas fa-clipboard"></i> Раздел сайта :
        </p>
    </div>
    <div class="col-6 col-md-9">
        <p>
            {{ $offer->theme }}
        </p>
    </div>
</div>

<div class="row">
    <div class="col-6 col-md-3">
        <p>
            <i class="fas fa-link"></i> URL
        </p>
    </div>
    <div class="col-6 col-md-9">
        <p>
            <a href="{{ $offer->url }}" target="_blank">{{ $offer->url }}</a>
        </p>
    </div>
</div>