@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/feedback.css') }}">
@endsection

@section('content')
@if (session('msg'))
<div class="flash_message">
    {{ session('msg') }}
</div>
@endif
<div class="container">
    <div class="review-wrapper">
        <div class="left-section">
            <h2 class="title-feedback">今回のご利用はいかがでしたか？</h2>
            <div class="restaurant-card">
                @if($restaurant->image)
                    <div class="restaurant-image">
                        <img src="{{ preg_match('/^http/', $restaurant->image) ? $restaurant->image : asset($restaurant->image) }}" alt="Restaurant Image" class="restaurant-card__image">
                    </div>
                @else
                    <div class="image-default">
                        <i class="fa-solid fa-image"></i>
                    </div>
                @endif
                <div class= "restaurant-info">
                    <h1 class="restaurant-title">{{ $restaurant->name }}</h1>
                    <div class="restaurant-tag">
                        @foreach($restaurant->areas as $area)
                            <span class="tag">#{{ $area->name }}</span>
                        @endforeach
                        @foreach($restaurant->genres as $genre)
                            <span class="tag">#{{ $genre->name }}</span>
                        @endforeach
                    </div>
                    <form class="details-form" action="/restaurant/detail" method="get">
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <input type="hidden" name="route" value="list">
                        <button class="details-button">詳しくみる</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="right-section">
                <form class="review-form" action= "/feedback" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                <input type="hidden" name="feedback_id" value="{{ $feedback ? $feedback->id : '' }}">
                <h3>体験を評価してください</h3>
                <div class="rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" value="{{ $i }}" id="rating-{{ $i }}"
                            {{ old('rating', $feedback ? $feedback->rating : '') == $i ? 'checked' : '' }}>
                            <label for="rating-{{ $i }}">★</label>
                        @endfor
                </div>
                <p class="error-message">
                    @error('rating')
                        {{ $message }}
                    @enderror
                </p>
                <h3>口コミを投稿</h3>
                <textarea class="review-area" name="comment" placeholder="カジュアルな雰囲気が好きなおすすめのスポット">{{ old('comment', $feedback ? $feedback->comment : '') }}</textarea>
                <div class="char-count">
                    <span id="char-count">0/400</span><span class="count-max">(最高文字数)</span>
                </div>
                <p class="error-message">
                    @error('comment')
                        {{ $message }}
                    @enderror
                </p>
                <h3>画像の追加</h3>
                <div class="form-group">
                    <div class="image-upload-area">
                        <label for="image">
                            <p class="upload-click">クリックして写真を追加</p>
                            <p class="upload-drop">またはドラッグアンドドロップ</p>
                            <div class="image-preview"></div> <!-- プレビュー表示領域 -->
                        <input type="file" id="image" name="image" accept="image/jpeg,image/png" style="display: none;">
                    </div>
                        </label>
                </div>
                 @if($feedback && $feedback->image)
                    <div class="uploaded-image">
                        <p>現在の画像:</p>
                        <img src="{{ asset($feedback->image) }}" alt="Uploaded Image" class="current-image">
                    </div>
                @endif
                <p class="error-message">
                    @error('image')
                        {{ $message }}
                    @enderror
                </p>

                <button class="submit-button">{{ $feedback ? '口コミを更新' : '口コミを投稿' }}</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropArea = document.querySelector('.image-upload-area');
        const fileInput = document.querySelector('#image');
        const previewContainer = document.querySelector('.image-preview');

        // ハイライトを追加
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropArea.classList.add('highlight');
            });
        });

        // ハイライトを削除
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                dropArea.classList.remove('highlight');
            });
        });

        // ファイルのドロップ
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            const files = e.dataTransfer.files;
            if (files.length) {
                fileInput.files = files;
                const file = files[0];
                showPreview(file);
            }
        });

        // クリックしてファイル選択
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                showPreview(file);
            }
        });

        // プレビューの表示
        const showPreview = (file) => {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const imgPreview = document.createElement('img');
                    imgPreview.src = e.target.result;
                    imgPreview.alt = 'Uploaded Image Preview';
                    imgPreview.classList.add('preview-image'); // CSSクラスを適用

                // 古いプレビューを削除して新しいプレビューを追加
                    const previewContainer = document.querySelector('.image-preview');
                    previewContainer.innerHTML = ''; // クリア
                    previewContainer.appendChild(imgPreview);
                };
                reader.readAsDataURL(file);
            }
        };
    });

    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.querySelector('.review-area');
        const charCount = document.getElementById('char-count');

        // Update the character count
        function updateCharCount() {
            const currentLength = textarea.value.length;
            charCount.textContent = `${currentLength}/400`;
        }

        // Listen for input events to update the count
        textarea.addEventListener('input', updateCharCount);

        // Initialize the count when the page loads
        updateCharCount();
    });
</script>
@endsection
