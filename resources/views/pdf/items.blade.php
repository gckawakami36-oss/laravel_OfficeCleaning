<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>商品一覧</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .price {
            text-align: right;
        }
        .status {
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>商品一覧</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>メモ</th>
                <th class="price">価格</th>
                <th class="status">販売状況</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->memo }}</td>
                <td class="price">¥{{ number_format($item->price) }}</td>
                <td class="status">{{ $item->is_selling ? '販売中' : '停止中' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        出力日時: {{ date('Y年m月d日 H:i') }}
    </div>
</body>
</html>
