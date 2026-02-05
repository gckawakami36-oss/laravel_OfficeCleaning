<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>商品詳細</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
        }
        h1 {
            text-align: center;
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .item-info {
            margin-top: 30px;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .item-row {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .item-label {
            display: table-cell;
            width: 30%;
            font-weight: bold;
            background-color: #f2f2f2;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .item-value {
            display: table-cell;
            width: 70%;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>商品詳細</h1>
    
    <div class="item-info">
        <div class="item-row">
            <div class="item-label">ID</div>
            <div class="item-value">{{ $item->id }}</div>
        </div>
        
        <div class="item-row">
            <div class="item-label">商品名</div>
            <div class="item-value">{{ $item->name }}</div>
        </div>
        
        <div class="item-row">
            <div class="item-label">価格</div>
            <div class="item-value">¥{{ number_format($item->price) }}</div>
        </div>
        
        <div class="item-row">
            <div class="item-label">メモ</div>
            <div class="item-value">{{ $item->memo ?? 'なし' }}</div>
        </div>
        
        <div class="item-row">
            <div class="item-label">販売状況</div>
            <div class="item-value">{{ $item->is_selling ? '販売中' : '停止中' }}</div>
        </div>
        
        <div class="item-row">
            <div class="item-label">作成日時</div>
            <div class="item-value">{{ $item->created_at->format('Y年m月d日 H:i') }}</div>
        </div>
        
        <div class="item-row">
            <div class="item-label">更新日時</div>
            <div class="item-value">{{ $item->updated_at->format('Y年m月d日 H:i') }}</div>
        </div>
    </div>
    
    <div class="footer">
        出力日時: {{ date('Y年m月d日 H:i') }}
    </div>
</body>
</html>
