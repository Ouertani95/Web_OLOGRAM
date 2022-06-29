<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>Web-OLOGRAM Results</title>
    <style type="text/css">
        html {
            overflow: auto;
        }
          
        html,
        body,
        div,
        iframe {
            margin: 0px;
            padding: 0px;
            height: 100%;
            border: none;
        }
          
        iframe {
            display: block;
            width: 100%;
            border: none;
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
</head>
  
<body>
    <iframe src="http://localhost:7775/?file=/pygtftk_results/{{ $id }}/{{ $file }}"
            frameborder="0" 
            marginheight="0" 
            marginwidth="0" 
            width="100%" 
            height="100%" 
            scrolling="auto">
    </iframe>
  
</body>
  
</html>