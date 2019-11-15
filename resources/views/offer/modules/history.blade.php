<div class="card shadow-sm">
    <div class="card-body">

        {{-- Заголовок --}}
        <div class="container-fluid">
            <div class="text-center h3">
                <i class="fas fa-history"></i>
                Ожидают публикации
            </div>
        </div>
        <hr/>

        {{-- Тело --}}

        @include('offer.modules.waitingList.list')
    </div>
</div>