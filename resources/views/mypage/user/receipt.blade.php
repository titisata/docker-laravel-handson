<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>URATABI</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">

        <!-- bootstrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- bootstrap icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>
    <script>
        $(document).ready(function(){
            var menu = document.getElementById("@yield('menu')");
            menu.classList.add("active");
        });
    </script>
    <style>
        body {
        margin-top: 50px;
        background-color: #fff;
        font-family: Arial, sans-serif;
        font-size: 14px;
        letter-spacing: 0.01em;
        color: #39464e;
        }

        .small{
            font-size:8px;
        }
       
    </style>
</head>
<body>
<div class="container">
    <h3 class="text-center mb-4">注文番号{{ $id }}の領収書</h3>
    <div class="d-flex justify-content-between">
        <p><span class="fw-bold">発行日：</span>20{{ $now }}</p>
        <p>___________________様</p>
    </div>
    <p><span class="fw-bold">注文日：</span>20{{ $date->format('y年m月d日') }}</p>
    <p><span class="fw-bold">注文番号：</span>{{ $id }}</p>
    <p><span class="fw-bold">ご請求額：</span><span class="small">税込</span>{{ number_format($price) }}円<span class="small ms-1">(但し、クレジット利用)</span></p>

    <table class="table mb-5">
        <thead>
            <tr>
            <th scope="col">注文商品</th>
            <th scope="col">価格</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reserved_experiences->where('payment_id', $id) as $reserved_experience)
                <tr>
                    <td>
                        <div class="d-flex flex-column">
                            <p class="mb-1">{{ App\Models\ExperienceFolder::where('id',$reserved_experience->experience->experience_folder_id)->first()->name }}
                            {{ $reserved_experience->experience->name }}</p>  
                            <p class="mb-1">提供会社：{{ $reserved_experience->partner->name }}</p>
                        </div>
                    </td>
                    <td>
                        <p><span class="small">税込</span>{{ number_format($reserved_experience->sum_price()) }}円</p>
                    </td>     
                </tr>
            @empty
            @endforelse
            
                    
            @forelse ($ordered_goods->where('payment_id', $id) as $one_ordered_goods)
                <tr>
                    <td>
                        <p class="mb-1">
                            {{ App\Models\GoodsFolder::where('id',$one_ordered_goods->goods->goods_folder_id)->first()->name }}
                            {{ $one_ordered_goods->goods->name }}
                        </p>
                        <p class="mb-1">販売会社：{{ $one_ordered_goods->partner->name }}</p>
                        
                    </td>
                    
                    <td>
                        <p><span class="small">税込</span>{{ number_format($one_ordered_goods->total_price)}}円</p> 
                    </td>
                </tr>
                
            @empty

            @endforelse
                    
        </tbody>
    </table>

    @forelse ($ordered_goods->where('payment_id', $id) as $one_ordered_goods)

    @if($loop->last)
    <div class="border p-3">
        <p class="fw-bold">お届け先情報：</p>
        <p>{{ $one_ordered_goods->to_name}}様</p>
        <p>〒{{ $one_ordered_goods->to_postal_code}}</p>
        <p>{{App\Models\User::$prefs[$one_ordered_goods->to_pref_id]}}　{{ $one_ordered_goods->to_city }}{{ $one_ordered_goods->to_town }}　{{ $one_ordered_goods->to_building }}</p>
    </div>
    @endif
    @empty

    @endforelse





    <div class="d-flex justify-content-between align-items-center flex-row mt-5">
        <p class="text-gray-color ms-4 small" style="padding-left:2rem">Copyright© {{ $site_masters->site_name}} All rights reserved.</p>
        <p class="text-gray-color ms-4 ms-0 me-4 mb-0 pb-3" style="padding-right:2rem;padding-left:2rem;"><small>Powered by  <img src="/images/rogo.png" alt="" style="width:140px"></small></p>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

