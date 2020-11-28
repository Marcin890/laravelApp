<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
      
    <style>
        h1 {
            text-align: center;
        }
        img {
            max-width: 100%;
            max-height: 90%;
            display: block;
            margin: 0 auto;
        }

    
    </style>
     
</head>
<body>    
                <h1> 
                    {{ $mem->title }}
                </h1>
            
                <div>        
                    <img src="{{ $mem->photos->first()->path ?? null }}" alt="">   
                 </div>
            </div>
        </div>
    </div>
    
</body>
</html>