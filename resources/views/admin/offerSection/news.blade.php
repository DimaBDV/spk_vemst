<div class="row">
    <div class="col-6 col-md-3">
        <p>
            <i class="fas fa-bullhorn"></i> Тема :
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
            <i class="fas fa-edit"></i> Текст новости :
        </p>
    </div>
    <div class="col-6 col-md-9">
        <p>
            {{ $offer->mainText }}
        </p>
    </div>
</div>