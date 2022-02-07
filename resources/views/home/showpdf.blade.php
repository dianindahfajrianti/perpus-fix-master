<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="\assets\js\pdf.worker.js"></script>
</head>
<body>
    <h1>PDF.js Previous/Next example</h1>
    <input type="text" id="search_txt" onchange="search()">
<style>
#the-canvas {
  border: 1px solid black;
  direction: ltr;
}
</style>
    <div>
      <button id="prev">Previous</button>
      <button id="next">Next</button>
      &nbsp; &nbsp;
      <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
    </div>
    
    <canvas id="the-canvas"></canvas> 
    <script>
        const worker = require('pdfjs-dist/build/pdf.worker');
        var url = '/assets/test.pdf';
    </script>
    <script src="/assets/test.js"></script>

</body>
</html>