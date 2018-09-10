<!DOCTYPE html>
<html lang="en">
  <head>
    <title>PHP Math Tables</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="highlights.css">
    <link rel="stylesheet" href="custom.css">
    <!-- <link rel="stylesheet" href="darkmode.css"> Needs more testing -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body class="custom-CSS">
    <div class="container">
      <div class="row mt-5">
        <div class="col" id="title">
          <h2>Math Table Generator</h2>
          <p>Select which operator you want to generate the table with then press "Generate"<p>
        </div>
        <div class="col-sm-1 w-100" id="operator-selector">
          <form method="post" action="index.php">
            <div class="form-group">
              <select class="form-control" name="op">
                <option label=" "></option>
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
              </select>
            </div>
          </div>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-outline-dark w-100">Generate</button>
          </div>
        </form>

        <div class="col-sm-3">
          <button class="btn btn-outline-primary w-100" id="php-toggle">Show PHP code</button>
          <!-- <button class="btn btn-outline-primary ml-4" id="dark-mode-toggle">Toggle Dark Mode</button> Needs more testing -->
          <script>
          $("#php-toggle").click(function(){
            $("#php-code").slideToggle();
            $("#php-toggle").toggleClass("active")
            $('#php-toggle').text(function(i, text) {
              if (text === 'Show PHP code') {
                return text === 'Show PHP code' ? 'Hide PHP code' : text;
              } else {
                return text === 'Hide PHP code' ? 'Show PHP code' : text;
              }
            });
          });
          </script>
        </div>
      </div>
    </div>
    <div class="container-fluid row">
      <div class="col-sm-3">
      </div>
      <div class="highlight" id="php-code" style="display: none;">
        <pre class="highlight"><code>      <span class="cp">&lt;?php</span>
      <span class="k">if</span><span class="p">(</span><span class="nb">isset</span><span class="p">(</span><span class="nv">$_POST</span><span class="p">[</span><span class="s1">'op'</span><span class="p">]))</span> <span class="p">{</span>                                                 <span class="c1">// This is executed when the button labeled "Generate" is pressed</span>
        <span class="k">if</span> <span class="p">(</span><span class="nv">$_POST</span><span class="p">[</span><span class="s1">'op'</span><span class="p">]</span> <span class="o">==</span> <span class="s2">""</span><span class="p">)</span> <span class="k">break</span><span class="p">;</span>                                          <span class="c1">// If there is nothing selected, break.</span>
        <span class="nv">$operator</span> <span class="o">=</span> <span class="nv">$_POST</span><span class="p">[</span><span class="s1">'op'</span><span class="p">];</span>                                               <span class="c1">// $operator variable is assigned to the selected operator</span>
        <span class="nx">initializeTable</span><span class="p">(</span><span class="nv">$operator</span><span class="p">);</span>                                             <span class="c1">// Table is initialized with thead row and tbody starts</span>
        <span class="nx">populateTable</span><span class="p">(</span><span class="nv">$operator</span><span class="p">);</span>                                               <span class="c1">// Table is populated with values using for loops and the operator</span>
      <span class="p">}</span>

      <span class="k">function</span> <span class="nf">initializeTable</span><span class="p">(</span><span class="nv">$operator</span><span class="p">)</span> <span class="p">{</span>                                     <span class="c1">// Function that starts table</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;table class="table text-center mt-5"&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>          <span class="c1">// &lt;table&gt; tag starts, with Bootstrap class .table for formatting</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;thead&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>                                       <span class="c1">// &lt;thead&gt; tag starts, Bootstrap adds bold text.</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;tr&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>                                        <span class="c1">// Table header starts.</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;th scope="col"&gt;'</span> <span class="o">.</span> <span class="nv">$operator</span> <span class="o">.</span> <span class="s1">'&lt;/th&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>    <span class="c1">// Operator is passed, table header is closed.</span>
        <span class="k">for</span> <span class="p">(</span><span class="nv">$x</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span> <span class="nv">$x</span> <span class="o">&lt;</span> <span class="mi">11</span><span class="p">;</span> <span class="nv">$x</span><span class="o">++</span><span class="p">)</span> <span class="p">{</span>                                           <span class="c1">// For loop that populates the rest of the headers.</span>
          <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;th&gt;'</span><span class="o">.</span> <span class="nv">$x</span> <span class="o">.</span> <span class="s1">'&lt;/th&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
        <span class="p">}</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;/tr&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>                                       <span class="c1">// Table and thead are closed, body starts</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;/thead&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;tbody&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
      <span class="p">}</span>

      <span class="k">function</span> <span class="nf">populateTable</span><span class="p">(</span><span class="nv">$operator</span><span class="p">)</span> <span class="p">{</span>                                       <span class="c1">// Function that populates table</span>
        <span class="k">for</span> <span class="p">(</span><span class="nv">$x</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span> <span class="nv">$x</span> <span class="o">&lt;</span> <span class="mi">11</span><span class="p">;</span> <span class="nv">$x</span><span class="o">++</span><span class="p">)</span> <span class="p">{</span>                                           <span class="c1">// First for loop is started, functions as columns</span>
          <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;tr&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>                                      <span class="c1">// First row of every column is instantiated as a header value.</span>
          <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;th scope="row"&gt;'</span> <span class="o">.</span> <span class="nv">$x</span> <span class="o">.</span> <span class="s1">'&lt;/th&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
          <span class="k">for</span> <span class="p">(</span><span class="nv">$y</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span> <span class="nv">$y</span> <span class="o">&lt;</span> <span class="mi">11</span><span class="p">;</span> <span class="nv">$y</span><span class="o">++</span><span class="p">)</span> <span class="p">{</span>                                         <span class="c1">// Second for loop starts, functions as the rest of the rows.</span>
            <span class="k">switch</span> <span class="p">(</span><span class="nv">$operator</span><span class="p">)</span> <span class="p">{</span>                                                <span class="c1">// Switch statement that calculates the values of every cell</span>
              <span class="k">case</span> <span class="s1">'+'</span><span class="o">:</span> <span class="nv">$cell</span> <span class="o">=</span> <span class="nv">$x</span> <span class="o">+</span> <span class="nv">$y</span><span class="p">;</span> <span class="k">break</span><span class="p">;</span>                                 <span class="c1">// on a row-by-row basis.</span>
              <span class="k">case</span> <span class="s1">'-'</span><span class="o">:</span> <span class="nv">$cell</span> <span class="o">=</span> <span class="nv">$x</span> <span class="o">-</span> <span class="nv">$y</span><span class="p">;</span> <span class="k">break</span><span class="p">;</span>
              <span class="k">case</span> <span class="s1">'*'</span><span class="o">:</span> <span class="nv">$cell</span> <span class="o">=</span> <span class="nv">$x</span> <span class="o">*</span> <span class="nv">$y</span><span class="p">;</span> <span class="k">break</span><span class="p">;</span>
              <span class="k">case</span> <span class="s1">'/'</span><span class="o">:</span> <span class="nv">$cell</span> <span class="o">=</span> <span class="nv">$x</span> <span class="o">/</span> <span class="nv">$y</span><span class="p">;</span> <span class="k">break</span><span class="p">;</span>
              <span class="p">}</span>
              <span class="k">if</span> <span class="p">(</span><span class="nv">$operator</span> <span class="o">==</span> <span class="s1">'/'</span> <span class="o">&amp;&amp;</span> <span class="nv">$y</span> <span class="o">!=</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span>                                <span class="c1">// Some logic is added, if divided, round to the nearest 3 decimals</span>
                <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;td&gt;'</span> <span class="o">.</span> <span class="nb">number_format</span><span class="p">((</span><span class="nx">float</span><span class="p">)</span><span class="nv">$cell</span><span class="p">,</span> <span class="mi">4</span><span class="p">,</span> <span class="s1">'.'</span><span class="p">,</span> <span class="s1">''</span><span class="p">)</span> <span class="o">.</span> <span class="s1">'&lt;/td&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
              <span class="p">}</span>
              <span class="k">elseif</span> <span class="p">(</span><span class="nv">$operator</span> <span class="o">==</span> <span class="s1">'/'</span> <span class="o">&amp;&amp;</span> <span class="nv">$y</span> <span class="o">==</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span>                            <span class="c1">// If divided by 0, populate cell with error statement</span>
                <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;td&gt;&lt;code&gt;error&lt;/code&gt;&lt;/td&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
              <span class="p">}</span>
              <span class="k">else</span> <span class="p">{</span>                                                            <span class="c1">// If not a division and denominator is not 0, populate cell with</span>
              <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;td&gt;'</span> <span class="o">.</span> <span class="nv">$cell</span> <span class="o">.</span> <span class="s1">'&lt;/td&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>              <span class="c1">// $cell variable</span>
              <span class="p">}</span>
          <span class="p">}</span>
          <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;/tr&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
        <span class="p">}</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;/tbody&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
        <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;/table&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>                                        <span class="c1">// Table, tr and tbody are closed.</span>
        <span class="k">if</span> <span class="p">(</span><span class="nv">$operator</span> <span class="o">==</span> <span class="s1">'/'</span><span class="p">)</span> <span class="p">{</span>                                                 <span class="c1">// Alert that explains why some cells display error if division is</span>
          <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;div class="alert alert-danger mt-5" role="alert"&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>      <span class="c1">// selected.</span>
          <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'Numbers can\'t be divided by 0. If this is the case, the cell will default to &lt;code&gt;error&lt;/code&gt;. Numbers are rounded at four decimal places.'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
          <span class="k">echo</span> <span class="s2">"</span><span class="se">\t\t</span><span class="s2">"</span> <span class="o">.</span> <span class="s1">'&lt;/div&gt;'</span> <span class="o">.</span> <span class="s2">"</span><span class="se">\n</span><span class="s2">"</span><span class="p">;</span>
        <span class="p">}</span>
      <span class="p">}</span>

      <span class="cp">?&gt;</span></code></pre>
    </div>
</div>
<footer class="footer">
  <div class="container">
    <span><small>The contents of this website are © Julio Corzo under the terms of the <a style="text-decoration: underline; color: black;" href="https://github.com/juliocorzo/bootstrapped/blob/master/LICENSE.txt" target="_blank">MIT License.</a></small></span>
  </div>
</footer>
<div class="container mb-5">
      <?php
      if(isset($_POST['op'])) {                                                 // This is executed when the button labeled "Generate" is pressed
        if ($_POST['op'] == "") break;                                          // If there is nothing selected, break.
        $operator = $_POST['op'];                                               // $operator variable is assigned to the selected operator
        initializeTable($operator);                                             // Table is initialized with thead row and tbody starts
        populateTable($operator);                                               // Table is populated with values using for loops and the operator
      }

      function initializeTable($operator) {                                     // Function that starts table
        echo "\t\t" . '<table class="table text-center mt-4">' . "\n";          // <table> tag starts, with Bootstrap class .table for formatting
        echo "\t\t\t" . '<thead>' . "\n";                                       // <thead> tag starts, Bootstrap adds bold text.
        echo "\t\t\t\t" . '<tr>' . "\n";                                        // Table header starts.
        echo "\t\t\t\t\t" . '<th scope="col">' . $operator . '</th>' . "\n";    // Operator is passed, table header is closed.
        for ($x = 0; $x < 11; $x++) {                                           // For loop that populates the rest of the headers.
          echo "\t\t\t\t\t" . '<th>'. $x . '</th>' . "\n";
        }
        echo "\t\t\t\t" . '</tr>' . "\n";                                       // Table and thead are closed, body starts
        echo "\t\t\t" . '</thead>' . "\n";
        echo "\t\t\t" . '<tbody>' . "\n";
      }

      function populateTable($operator) {                                       // Function that populates table
        for ($x = 0; $x < 11; $x++) {                                           // First for loop is started, functions as columns
          echo "\t\t\t\t" . '<tr>' . "\n";                                      // First row of every column is instantiated as a header value.
          echo "\t\t\t\t\t" . '<th scope="row">' . $x . '</th>' . "\n";
          for ($y = 0; $y < 11; $y++) {                                         // Second for loop starts, functions as the rest of the rows.
            switch ($operator) {                                                // Switch statement that calculates the values of every cell
              case '+': $cell = $x + $y; break;                                 // on a row-by-row basis.
              case '-': $cell = $x - $y; break;
              case '*': $cell = $x * $y; break;
              case '/': $cell = $x / $y; break;
              }
              if ($operator == '/' && $y != 0) {                                // Some logic is added, if divided, round to the nearest 3 decimals
                echo "\t\t\t\t\t" . '<td>' . number_format((float)$cell, 4, '.', '') . '</td>' . "\n";
              }
              elseif ($operator == '/' && $y == 0) {                            // If divided by 0, populate cell with error statement
                echo "\t\t\t\t\t" . '<td><code>error</code></td>' . "\n";
              }
              else {                                                            // If not a division and denominator is not 0, populate cell with
              echo "\t\t\t\t\t" . '<td>' . $cell . '</td>' . "\n";              // $cell variable
              }
          }
          echo "\t\t\t\t" . '</tr>' . "\n";
        }
        echo "\t\t\t" . '</tbody>' . "\n";
        echo "\t\t" . '</table>' . "\n";                                        // Table, tr and tbody are closed.
        if ($operator == '/') {                                                 // Alert that explains why some cells display error if division is
          echo "\t\t" . '<div class="alert alert-danger mt-5" role="alert">' . "\n";      // selected.
          echo "\t\t\t" . 'Numbers can\'t be divided by 0. If this is the case, the cell will default to <code>error</code>. Numbers are rounded at four decimal places.' . "\n";
          echo "\t\t" . '</div>' . "\n";
        }
      }

      ?>
    </div>
  </body>
</html>
