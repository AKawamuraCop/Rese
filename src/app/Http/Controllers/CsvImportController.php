<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Exception;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Genre;

class CsvImportController extends Controller
{
    public function getCsvImport()
    {
        return view('csvImport');
    }

    // CSVヘッダーの定義（項目名）
    public function csvHeader(): array
    {
        return [
            '店舗名',
            '店舗概要',
            '画像URL',
            '地域',
            'ジャンル',
        ];
    }

    // CSVデータの取得
public function getCsvData(Request $request)
{
    $file = $request->file('csvFile');

    // CSVファイルかどうかを確認
    if ($file->getClientOriginalExtension() != 'csv') {
        throw new Exception('CSVファイルのみが許可されています。');
    }

    $data = [];
    if (($handle = fopen($file, 'r')) !== false) {
        $rowNumber = 0;

        // ヘッダー行を読み込み
        $header = fgetcsv($handle);
        $rowNumber++;

        // ヘッダーの確認
        if ($header !== $this->csvHeader()) {
            throw new Exception("Error: ヘッダーが一致しません（{$rowNumber}行目）");
        }

        // CSVの内容を読み込んで配列に保存（空行をスキップ）
        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;
            // 空行をスキップ
            if (empty(array_filter($row))) {
                continue;
            }

            $data[] = $row;
        }
        fclose($handle);
    }

    return $data;
}

// CSVデータの挿入処理
public function postCsvImport(Request $request)
{
    try {
        // CSVデータを取得
        $csvData = $this->getCsvData($request);

        $errors = [];
            // 各行を検証
            foreach ($csvData as $rowIndex => $row) {
                // 空のセルがないかをチェック
                $this->validateEmptyCells($row, $rowIndex, $errors);
            }
            // エラーがあれば戻り値としてエラーメッセージを表示
            if (!empty($errors)) {
                return redirect()->back()->withErrors(['errors' => $errors]);
            }

        // 各CSVデータを処理
        foreach ($csvData as $index => $row) {
            // 行番号を計算（ヘッダーを考慮して2行目以降からスタート）
            $rowNumber = $index + 2;


            // 各行のバリデーション
            $this->validateCsvRow($row, $rowNumber);

            // 画像を保存
            $imagePath = $this->storeImage($row[2]);

            // restaurantsテーブルにデータを挿入
            $restaurant = Restaurant::create([
                'name' => $row[0],
                'description' => $row[1],
                'image' => $imagePath,
            ]);

            // areaの処理
            $areaName = $row[3];
            $areaData = $this->getAreaDataByName($areaName);

            // areaテーブルにデータを挿入
            $area = Area::firstOrCreate([
                'number' => $areaData['number'],
                'name' => $areaData['name'],
                'restaurant_id' => $restaurant->id,
            ]);

            // genreの処理
            $genreName = $row[4];
            $genreData = $this->getGenreDataByName($genreName);

            // genreテーブルにデータを挿入
            $genre = Genre::firstOrCreate([
                'number' => $genreData['number'],
                'name' => $genreData['name'],
                'restaurant_id' => $restaurant->id,
            ]);
        }

        return redirect()->back()->with('success', 'CSVインポートが成功しました');
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}


    private function getAreaDataByName($areaName)
    {
        $areaMap = [
            '東京都' => ['number' => 1, 'name' => '東京'],
            '大阪府' => ['number' => 2, 'name' => '大阪'],
            '福岡県' => ['number' => 3, 'name' => '福岡'],
            // 他のエリアも追加できます
        ];

        // areaMapの中にエリア名が存在すれば対応するnumberとnameを返す
        if (array_key_exists($areaName, $areaMap)) {
            return $areaMap[$areaName];
        }

        // 該当するエリアがない場合、デフォルトで空の配列を返す（エラーハンドリング）
        throw new Exception("エリア名「{$areaName}」が正しくありません");
    }

    private function getGenreDataByName($genreName)
    {
        $genreMap = [
            'イタリアン' => ['number' => 1, 'name' => 'イタリアン'],
            'ラーメン' => ['number' => 2, 'name' => 'ラーメン'],
            '居酒屋' => ['number' => 3, 'name' => '居酒屋'],
            '寿司' => ['number' => 4, 'name' => '寿司'],
            '焼肉' => ['number' => 5, 'name' => '焼肉'],
            // 他のジャンルも追加できます
        ];

        // genreMapの中にジャンル名が存在すれば対応するnumberとnameを返す
        if (array_key_exists($genreName, $genreMap)) {
            return $genreMap[$genreName];
        }

        // 該当するジャンルがない場合、デフォルトで空の配列を返す（エラーハンドリング）
        throw new Exception("ジャンル名「{$genreName}」が正しくありません");
    }

private function storeImage($image)
{
    try {
        // URLから画像を取得
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            // URLから画像を取得
            $imageContents = @file_get_contents($image);

            // 画像が正常に取得できなかった場合
            if ($imageContents === false) {
                throw new Exception("画像URLからのダウンロードに失敗しました: {$image}");
            }

            // 拡張子を取得
            $extension = pathinfo(parse_url($image, PHP_URL_PATH), PATHINFO_EXTENSION);

            // 拡張子を検証（jpeg, jpg, pngのみ）
            if (!in_array(strtolower($extension), ['jpeg', 'jpg', 'png'])) {
                throw new Exception("画像形式が無効です: {$extension} (許可: jpeg, png)");
            }

            // 新しいファイル名を生成
            $newFileName = uniqid() . '.' . $extension;

            // ストレージに画像を保存
            $storagePath = Storage::put('public/images/' . $newFileName, $imageContents);

             // ストレージのURLを返す
            if ($storagePath) {
                // 保存したパスを返す（storageのURLに変換）
                return Storage::url('images/' . $newFileName);
            } else {
                throw new Exception("画像の保存に失敗しました");
            }
        }

        // 他の処理（ファイルがローカルの場合など）

    } catch (Exception $e) {
        throw new Exception("画像の保存中にエラーが発生しました: {$e->getMessage()}");
    }
}

// 空欄セルのチェック
private function validateEmptyCells($row, $rowIndex, &$errors)
{
    foreach ($row as $colIndex => $cell) {
        if (empty($cell)) {
            $errors[] = "行 " . ($rowIndex + 1) . "、列 " . ($colIndex + 1) . " に空欄があります。";
        }
    }
}

    // CSVの行データのバリデーション
    private function validateCsvRow(array $row, int $lineNumber)
    {
        // nameのバリデーション
        if (mb_strlen($row[0]) > 50) {
            throw new Exception("Error: {$lineNumber}行目の名前が50文字を超えています");
        }

        // descriptionのバリデーション
        if (mb_strlen($row[1]) > 400) {
            throw new Exception("Error: {$lineNumber}行目の説明が400文字を超えています");
        }

        // 画像形式のバリデーション
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        if (filter_var($row[2], FILTER_VALIDATE_URL)) {

            $context = stream_context_create([
                'http' => [
                'ignore_errors' => true
                ]
            ]);
            // URLから画像を取得し、MIMEタイプを確認
            $imageContents = @file_get_contents($row[2], false, $context);

            if ($imageContents === false) {
                throw new Exception("Error: {$lineNumber}行目の画像URLからのダウンロードに失敗しました: {$row[2]}");
            }

            // MIMEタイプを取得
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $imageContents);
            finfo_close($finfo);

            // MIMEタイプが許可されているか確認
            if (!in_array($mimeType, $allowedMimeTypes)) {
                throw new Exception("Error: {$lineNumber}行目の画像形式が無効です: {$mimeType} (許可: jpeg, png)");
            }
        } else {
            throw new Exception("Error: {$lineNumber}行目の画像が無効です (ファイルまたはURLが存在しません)");
        }


        // areaのバリデーション
        $validAreas = ['東京都', '大阪府', '福岡県'];
        if (!in_array($row[3], $validAreas)) {
            throw new Exception("Error: {$lineNumber}行目のエリア名「{$row[3]}」が無効です");
        }

        $validGenres = ['イタリアン', 'ラーメン', '居酒屋','寿司','焼肉'];
        if (!in_array($row[4], $validGenres)) {
            throw new Exception("Error: {$lineNumber}行目のエリア名「{$row[4]}」が無効です");
        }
    }
}
