{{-- resources/views/vin/index.blade.php --}}
@extends('layouts.layout')

@section('title', 'Подбор по VIN — AVAMotors')

@push('styles')
    @vite(['resources/css/vin.css'])
@endpush

@section('content')
    <div class="vin-page">
        <div class="vin-hero">
            <h1>🔍 Подбор автозапчастей по VIN</h1>
            <p>Введите VIN номер автомобиля — мы найдем подходящие запчасти</p>
        </div>

        <div class="vin-form-container">
            <form method="POST" action="{{ route('vin.decode') }}">
                @csrf
                <div class="vin-input-group">
                    <input type="text"
                           name="vin"
                           class="vin-input"
                           placeholder="Например: 1HGBH41JXMN109186"
                           maxlength="17"
                           minlength="17"
                           pattern="[A-HJ-NPR-Z0-9]{17}"
                           title="VIN должен состоять из 17 символов (цифры и буквы A-Z, кроме I, O, Q)"
                           oninvalid="this.setCustomValidity('VIN должен содержать ровно 17 символов. Допустимы: A-Z (кроме I,O,Q) и 0-9')"
                           oninput="this.setCustomValidity(''); this.value = this.value.toUpperCase();"
                           autocomplete="off"
                           value="{{ strtoupper(old('vin')) }}">
                    <button type="submit" class="vin-btn">Подобрать запчасти</button>
                </div>
            </form>

            <div class="vin-info">
                <p>📌 VIN — это 17-значный код, который можно найти:</p>
                <p>• На торпедо со стороны водителя<br>
                    • На стойке двери водителя<br>
                    • В свидетельстве о регистрации (СТС)</p>
                <p>Пример: <span class="vin-example">1HGBH41JXMN109186</span></p>
            </div>
        </div>
    </div>
@endsection
