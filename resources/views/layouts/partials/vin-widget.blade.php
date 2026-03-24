{{-- resources/views/layouts/partials/vin-widget.blade.php --}}
@if(Route::currentRouteName() !== 'vin.index')
    <div class="vin-widget">
        <form method="POST" action="{{ route('vin.decode') }}" class="vin-widget-form">
            @csrf
            <input type="text"
                   name="vin"
                   placeholder="Введите VIN для подбора запчастей"
                   maxlength="17"
                   pattern="[A-HJ-NPR-Z0-9]{17}"
                   class="vin-widget-input">
            <button type="submit" class="vin-widget-btn">🔍 Подобрать</button>
        </form>
    </div>
@endif
