<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>INCIPIENT</title>
  <link rel="icon" type="image/jpeg" href="images/incipientlogo.jpeg">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #000;
      color: #fff;
    }

    .navbar-brand span {
      color: #0d6efd;
    }

    .navbar .nav-link, .navbar .btn {
      color: white !important;
      font-weight: 500;
    }

    .sidebar {
      position: sticky;
      top: 0;
      height: 100vh;
      background-color: #e6f2ff;
      overflow-y: auto;
      padding-top: 20px;
      width: 220px;
      flex-shrink: 0;
      border-right: 2px solid #ccc;
    }

    .sidebar a {
      padding: 12px 20px;
      text-decoration: none;
      font-size: 16px;
      font-family: 'Roboto', sans-serif;
      color: #003366;
      font-weight: 500;
      display: block;
      transition: background-color 0.2s ease-in-out;
      border-left: 4px solid transparent;
    }

    .sidebar a:hover {
      background-color: #d6eaff;
      border-left: 4px solid #007bff;
      color: #007bff;
    }

    .main {
      padding: 20px;
      flex-grow: 1;
    }

    .section {
      background-color: rgba(255, 255, 255, 0.05);
      padding: 20px;
      margin-bottom: 20px;
      border-left: 4px solid #1ab2ff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .section h1 {
      color: #1ab2ff;
    }

    .code-box {
      background-color: #272822;
      color: #f8f8f2;
      padding: 15px;
      border-radius: 4px;
      font-family: monospace;
      white-space: pre-wrap;
      margin-top: 10px;
      display: none;
    }

    .try-btn {
      background-color:  #0ab274;
      margin-left: 10px;
      text-decoration: none;
      display: inline-block;
    }

    .try-btn:hover {
      background-color: #038c5a;
    }

    #intro {
      padding-top: 5px;
    }

    #padding {
      padding: 20px;
      border-radius: 10px;
      background-color: #f5f5f5;
      color: #000;
    }

    html {
      scroll-behavior: smooth;
    }

    footer.footer {
      background-color: #111;
      color: #ccc;
      text-align: center;
      padding: 15px 0;
      margin-top: 20px;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }
    }
  </style>

  <script>
    function toggleCode(id) {
      var codeBlock = document.getElementById(id);
      codeBlock.style.display = codeBlock.style.display === "block" ? "none" : "block";
    }
  </script>
</head>
<body>
  <!-- Navbar -->
  <?php include 'layout/nav.php'; ?>

  <div class="d-flex">
    <div class="sidebar">
      <a href="#intro">Introduction</a>
      <a href="#variables">Variables</a>
      <a href="#datatypes">Data Types</a>
      <a href="#operators">Operators</a>
      <a href="#controlstatements">Control Statements</a>
      <a href="#loops">Loops</a>
      <a href="#functions">Functions</a>
      <a href="#arrays">Arrays</a>
      <a href="#strings">Strings</a>
      <a href="#pointers">Pointers</a>
      <a href="#structures">Structures</a>
      <a href="#file-handling">File Handling</a>
      <a href="#dynamic-memory">Dynamic Memory Allocation</a>
    </div>

    <div class="main">
      <!-- Example Section Template -->
      <div id="intro" class="section">
        <h1><i>Introduction to C</i></h1>
        <div id="padding">
          <h4>What is C?</h4>
          <p>
            C is a general-purpose, high-level programming language. It was developed in the early 1970s by Dennis Ritchie at Bell Labs.
            It provides low-level access to memory, simple keywords, and a clean style, making it one of the most powerful and efficient programming languages.
          </p>
        
          <h4>Why Learn C?</h4>
          <ul>
            <li>C is the foundation of many modern languages like C++, Java, and Python.</li>
            <li>It’s widely used in systems programming like operating systems and embedded systems.</li>
            <li>It’s fast, efficient, and gives you control over memory and system resources.</li>
            <li>Learning C makes it easier to understand how computers work internally.</li>
          </ul>
        
          <h4>History</h4>
          <p>
            C was developed in 1972 at Bell Labs by Dennis Ritchie to develop the UNIX operating system. It was influenced by earlier languages like B and BCPL.
            Over the years, it has become one of the most used languages in the world.
          </p>
        
          <h4>Where is C used?</h4>
          <ul>
            <li>Operating systems (Windows, UNIX/Linux)</li>
            <li>Embedded systems</li>
            <li>Device drivers</li>
            <li>Game development</li>
            <li>Compilers and interpreters</li>
          </ul>
        
          <h4>Example C Program</h4>
          <p>This simple program prints "Hello, World!" to the screen.</p>
        
          <button class="btn" onclick="toggleCode('introCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="introCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            printf("Hello, World!");
            return 0;
        }
          </div>
        
          <h4>Explanation</h4>
          <ul>
            <li><code>#include &lt;stdio.h&gt;</code> – This is a header file that lets us use the <code>printf</code> function.</li>
            <li><code>int main()</code> – The main function where the program starts running.</li>
            <li><code>printf()</code> – Used to print text to the screen.</li>
            <li><code>return 0;</code> – Ends the function and returns 0 to the system.</li>
          </ul>
        
          <p>Congratulations! You've just seen your first C program.</p>
        
            </div>
      </div>
        

      <div id="variables" class="section">
        
        <h1><i>Variables & Constants</i></h1>
        <div id="padding">
        
          
          <h4>What are Variables?</h4>
          <p>
            Variables are like containers that store data in a C program. Before you can use a variable, you must declare it with a specific data type.
          </p>
        
          <h5>Example:</h5>
          <ul>
            <li><code>int age = 25;</code> → Stores an integer value</li>
            <li><code>float price = 9.99;</code> → Stores a decimal number</li>
            <li><code>char grade = 'A';</code> → Stores a single character</li>
          </ul>
        
          <button class="btn" onclick="toggleCode('varCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="varCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int age = 25;
            float price = 9.99;
            char grade = 'A';
        
            printf("Age: %d\\n", age);
            printf("Price: %.2f\\n", price);
            printf("Grade: %c\\n", grade);
            return 0;
        }
          </div>
        
          <h4>What are Constants?</h4>
          <p>
            Constants are values that do not change during the execution of the program. You can use the <code>const</code> keyword to define them.
          </p>
        
          <h5>Example:</h5>
          <p><code>const float PI = 3.1416;</code></p>
        
          <button class="btn" onclick="toggleCode('constCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="constCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            const float PI = 3.1416;
            printf("Value of PI: %.4f", PI);
            return 0;
        }
          </div>
        
          <h4>Summary:</h4>
          <ul>
            <li>Variables store changeable values.</li>
            <li>Constants store fixed values.</li>
            <li>Always declare the type before using a variable or constant.</li>
          </ul>
        
              <button class="btn" onclick="toggleCode('code1')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
        <div id="code1" class="code-box">
          int age = 25;
          float height = 5.9;
          char grade = 'A';
        </div>
      </div>
      </div>

      <div id="datatypes" class="section">
        
        <h1><i>Data Types in C</i></h1>
        <div id="padding">

          <h4>What are Data Types?</h4>
          <p>
            Data types define the type of data a variable can store. C supports several basic data types, and each type has a different size and format.
          </p>
        
          <h4>Basic Data Types</h4>
          <table border="1" cellpadding="8" cellspacing="0">
            <tr>
              <th>Data Type</th>
              <th>Description</th>
              <th>Example</th>
            </tr>
            <tr>
              <td><code>int</code></td>
              <td>Stores integers (whole numbers)</td>
              <td><code>int age = 20;</code></td>
            </tr>
            <tr>
              <td><code>float</code></td>
              <td>Stores decimal numbers (single precision)</td>
              <td><code>float price = 10.50;</code></td>
            </tr>
            <tr>
              <td><code>double</code></td>
              <td>Stores decimal numbers (double precision)</td>
              <td><code>double pi = 3.141592;</code></td>
            </tr>
            <tr>
              <td><code>char</code></td>
              <td>Stores a single character</td>
              <td><code>char grade = 'A';</code></td>
            </tr>
          </table>
        
          <h4>Example Program:</h4>
          <button class="btn" onclick="toggleCode('datatypeCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="datatypeCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int age = 20;
            float price = 10.5;
            double pi = 3.141592;
            char grade = 'A';
        
            printf("Age: %d\\n", age);
            printf("Price: %.2f\\n", price);
            printf("PI: %.6f\\n", pi);
            printf("Grade: %c\\n", grade);
            return 0;
        }
          </div>
        
          <h4>Advanced Data Types</h4>
          <ul>
            <li><code>short</code>, <code>long</code> – Variations of <code>int</code> with smaller/larger ranges</li>
            <li><code>unsigned</code> – Only stores non-negative values</li>
            <li><code>long double</code> – More precision than <code>double</code></li>
          </ul>
        
          <h4>Summary</h4>
          <ul>
            <li>Use <code>int</code> for whole numbers.</li>
            <li>Use <code>float</code> or <code>double</code> for decimal numbers.</li>
            <li>Use <code>char</code> for characters.</li>
            <li>Use <code>unsigned</code> when values can’t be negative (like age, count).</li>
          </ul>
        
        
        <p>Data types define what kind of data a variable can hold. Common types in C include:</p>
        <ul>
          <li><strong>int</strong> - Integer numbers</li>
          <li><strong>float</strong> - Decimal numbers</li>
          <li><strong>char</strong> - Single characters</li>
        </ul>
        </div>
      </div>

      <div id="operators" class="section">
        <h1><i>Operators in C</i></h1>
        <div id="padding">
          <h4>What are Operators?</h4>
          <p>
            Operators are symbols that perform operations on variables and values. In C, operators are classified into several types: arithmetic, relational, logical, bitwise, and more.
          </p>
        
          <h4>Arithmetic Operators</h4>
          <p>Arithmetic operators perform basic mathematical operations:</p>
          <ul>
            <li><code>+</code> → Addition</li>
            <li><code>-</code> → Subtraction</li>
            <li><code>*</code> → Multiplication</li>
            <li><code>/</code> → Division</li>
            <li><code>%</code> → Modulus (remainder)</li>
          </ul>
        
          <h5>Example:</h5>
          <button class="btn" onclick="toggleCode('arithCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="arithCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int x = 10, y = 3;
            printf("Sum: %d\\n", x + y);
            printf("Difference: %d\\n", x - y);
            printf("Product: %d\\n", x * y);
            printf("Quotient: %d\\n", x / y);
            printf("Remainder: %d\\n", x % y);
            return 0;
        }
          </div>
        
          <h4>Relational Operators</h4>
          <p>Relational operators compare two values and return a boolean value (true or false):</p>
          <ul>
            <li><code>==</code> → Equal to</li>
            <li><code>!=</code> → Not equal to</li>
            <li><code>></code> → Greater than</li>
            <li><code><</code> → Less than</li>
            <li><code>>=</code> → Greater than or equal to</li>
            <li><code><=</code> → Less than or equal to</li>
          </ul>
        
          <h5>Example:</h5>
          <button class="btn" onclick="toggleCode('relatCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="relatCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int x = 10, y = 20;
            printf("x == y: %d\\n", x == y);
            printf("x != y: %d\\n", x != y);
            printf("x > y: %d\\n", x > y);
            return 0;
        }
          </div>
        
          <h4>Logical Operators</h4>
          <p>Logical operators are used to combine conditional statements:</p>
          <ul>
            <li><code>&&</code> → Logical AND</li>
            <li><code>||</code> → Logical OR</li>
            <li><code>!</code> → Logical NOT</li>
          </ul>
        
          <h5>Example:</h5>
          <button class="btn" onclick="toggleCode('logiCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="logiCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int x = 10, y = 20;
            if (x > 5 && y > 10) {
                printf("Both conditions are true\\n");
            }
            if (x < 5 || y > 10) {
                printf("At least one condition is true\\n");
            }
            return 0;
        }
          </div>
        
          <h4>Assignment Operators</h4>
          <p>Assignment operators are used to assign values to variables:</p>
          <ul>
            <li><code>=</code> → Simple assignment</li>
            <li><code>+=</code> → Add and assign</li>
            <li><code>-=</code> → Subtract and assign</li>
            <li><code>*=</code> → Multiply and assign</li>
            <li><code>/=</code> → Divide and assign</li>
            <li><code>%=</code> → Modulus and assign</li>
          </ul>
        
          <h5>Example:</h5>
          <button class="btn" onclick="toggleCode('assignCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="assignCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int x = 10;
            x += 5;  // x = x + 5
            printf("x after +=: %d\\n", x);
            x -= 3;  // x = x - 3
            printf("x after -=: %d\\n", x);
            return 0;
        }
          </div>
        
          <h4>Summary</h4>
          <ul>
            <li>Use arithmetic operators for mathematical operations.</li>
            <li>Use relational operators to compare values.</li>
            <li>Use logical operators to combine conditions.</li>
            <li>Use assignment operators to assign and modify values in variables.</li>
          </ul>
        
        
        <button class="btn" onclick="toggleCode('code2')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
        <div id="code2" class="code-box">
            int a = 10, b = 5;
            int sum = a + b;
            printf("%d", sum); // Output: 15
        </div> 
      </div>
      </div>

      <div id="controlstatements" class="section">
        <h1><i>Control Statements</i></h1>
        <div id="padding">
        <h4>What are Control Statements?</h4>
        <p>
          Control statements in C are used to control the flow of execution in a program. These statements help us make decisions, loop over code, and repeat actions.
        </p>
      
        <h4>if Statement</h4>
        <p>
          The <code>if</code> statement allows you to execute a block of code only if a specified condition is true.
        </p>
      
        <h5>Example:</h5>
        <button class="btn" onclick="toggleCode('ifCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="ifCode" class="code-box">
      #include &lt;stdio.h&gt;
      
      int main() {
          int age = 18;
          if (age >= 18) {
              printf("You are an adult\\n");
          }
          return 0;
      }
        </div>
      
        <h4>else Statement</h4>
        <p>
          The <code>else</code> statement allows you to specify a block of code to execute if the condition in the <code>if</code> statement is false.
        </p>
      
        <h5>Example:</h5>
        <button class="btn" onclick="toggleCode('elseCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="elseCode" class="code-box">
      #include &lt;stdio.h&gt;
      
      int main() {
          int age = 16;
          if (age >= 18) {
              printf("You are an adult\\n");
          } else {
              printf("You are a minor\\n");
          }
          return 0;
      }
        </div>
      
        <h4>switch Statement</h4>
        <p>
          The <code>switch</code> statement allows you to check a variable against several values. It’s a more readable alternative to multiple <code>if-else</code> statements.
        </p>
      
        <h5>Example:</h5>
        <button class="btn" onclick="toggleCode('switchCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="switchCode" class="code-box">
      #include &lt;stdio.h&gt;
      
      int main() {
          int day = 3;
          switch(day) {
              case 1:
                  printf("Monday\\n");
                  break;
              case 2:
                  printf("Tuesday\\n");
                  break;
              case 3:
                  printf("Wednesday\\n");
                  break;
              default:
                  printf("Invalid day\\n");
          }
          return 0;
      }
        </div>
      
        <h4>Summary</h4>
        <ul>
          <li>The <code>if</code> statement is used to execute code based on a condition.</li>
          <li>The <code>else</code> statement is used to execute code if the condition in the <code>if</code> statement is false.</li>
          <li>The <code>switch</code> statement is a cleaner alternative to multiple <code>if-else</code> statements when checking for specific values.</li>
        </ul>
        </div>
      </div>
      

      <div id="loops" class="section">
        <h1><i>Loops in C</i></h1>
        <div id="padding">
        <h4>What are Loops?</h4>
        <p>
          Loops are used to execute a block of code repeatedly as long as a certain condition is true. C provides three main types of loops: <code>for</code>, <code>while</code>, and <code>do-while</code>.
        </p>
      
        <h4>for Loop</h4>
        <p>
          The <code>for</code> loop is used when you know in advance how many times you want to execute a statement or a block of statements.
        </p>
      
        <h5>Syntax:</h5>
        <pre><code>for(initialization; condition; update) {
          // code to run
      }</code></pre>
      
        <h5>Example:</h5>
        <button class="btn" onclick="toggleCode('forLoopCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="forLoopCode" class="code-box">
      #include &lt;stdio.h&gt;
      
      int main() {
          for(int i = 1; i <= 5; i++) {
              printf("Count: %d\\n", i);
          }
          return 0;
      }
        </div>
      
        <h4>while Loop</h4>
        <p>
          The <code>while</code> loop executes a block of code as long as the condition is true. It's commonly used when the number of iterations is not known in advance.
        </p>
      
        <h5>Example:</h5>
        <button class="btn" onclick="toggleCode('whileLoopCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="whileLoopCode" class="code-box">
      #include &lt;stdio.h&gt;
      
      int main() {
          int i = 1;
          while(i <= 5) {
              printf("Count: %d\\n", i);
              i++;
          }
          return 0;
      }
        </div>
      
        <h4>do-while Loop</h4>
        <p>
          The <code>do-while</code> loop is similar to the <code>while</code> loop, except the condition is evaluated after the loop has executed. This means the code block will run at least once.
        </p>
      
        <h5>Example:</h5>
        <button class="btn" onclick="toggleCode('doWhileCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="doWhileCode" class="code-box">
      #include &lt;stdio.h&gt;
      
      int main() {
          int i = 1;
          do {
              printf("Count: %d\\n", i);
              i++;
          } while(i <= 5);
          return 0;
      }
        </div>
        
        <h4>Summary</h4>
        <ul>
          <li>Use a <code>for</code> loop when the number of iterations is known.</li>
          <li>Use a <code>while</code> loop when the number of iterations is not known beforehand.</li>
          <li>Use a <code>do-while</code> loop when you need the loop body to run at least once.</li>
        </ul>
        </div>
      </div>
      

      <div id="functions" class="section">
        <h1><i>Functions in C</i></h1>
        <div id="padding">
          <h4>What is a Function?</h4>
          <p>
            A function is a block of code that performs a specific task. You can call a function whenever you need it, instead of repeating the same code.
          </p>
          <p>
            Functions help make programs easier to understand, manage, and debug.
          </p>
        
          <h4>Types of Functions</h4>
          <ul>
            <li><strong>Library Functions</strong>: Built-in functions in C (e.g., <code>printf()</code>, <code>scanf()</code>).</li>
            <li><strong>User-defined Functions</strong>: Functions you create to perform specific tasks.</li>
          </ul>
        
          <h4>Syntax of a Function</h4>
          <pre><code>return_type function_name(parameters) {
            // body of the function
        }</code></pre>
        
          <h4>Example: A Simple Function</h4>
          <p>This example defines a function to add two numbers:</p>
          <button class="btn" onclick="toggleCode('funcCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="funcCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        // Function declaration
        int add(int a, int b);
        
        // Main function
        int main() {
            int result = add(5, 3);  // Function call
            printf("Sum: %d\\n", result);
            return 0;
        }
        
        // Function definition
        int add(int a, int b) {
            return a + b;
        }
          </div>
        
          <h4>Function with No Parameters and No Return</h4>
          <p>This function just prints a message:</p>
          <button class="btn" onclick="toggleCode('funcVoidCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="funcVoidCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        void greet() {
            printf("Hello, welcome to C programming!\\n");
        }
        
        int main() {
            greet();  // Calling the function
            return 0;
        }
          </div>
        
          <h4>Why Use Functions?</h4>
          <ul>
            <li>To break a program into smaller, manageable parts</li>
            <li>To avoid code repetition</li>
            <li>To improve readability and maintainability</li>
          </ul>
        
          <h4>Function Components</h4>
          <ul>
            <li><strong>Function Declaration</strong>: Tells the compiler about the function’s name, return type, and parameters.</li>
            <li><strong>Function Definition</strong>: Contains the actual code to execute.</li>
            <li><strong>Function Call</strong>: Executes the function from <code>main()</code> or another function.</li>
          </ul>
        
        </div>
        
      </div>

      <div id="arrays" class="section">
        <h1><i>Arrays in C</i></h1>
        
        
        <div id="padding">
          <h4>What is an Array?</h4>
          <p>
            An array is a collection of variables of the same type stored at continuous memory locations. Instead of declaring multiple variables, you can use an array to store multiple values in a single variable.
          </p>
        
          <h4>Why Use Arrays?</h4>
          <ul>
            <li>To store multiple values of the same type efficiently.</li>
            <li>To simplify loops and repetitive tasks.</li>
          </ul>
        
          <h4>Declaring an Array</h4>
          <pre><code>data_type array_name[size];</code></pre>
          <p>Example: <code>int numbers[5];</code> — creates an array that can hold 5 integers.</p>
        
          <h4>Accessing Array Elements</h4>
          <p>Each element in the array is accessed using its index (starts from 0).</p>
          <p>Example: <code>numbers[0] = 10;</code></p>
        
          <h4>Example: Initialize and Print Array</h4>
          <button class="btn" onclick="toggleCode('arrayCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="arrayCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int numbers[5] = {10, 20, 30, 40, 50};
        
            for(int i = 0; i < 5; i++) {
                printf("Element %d = %d\\n", i, numbers[i]);
            }
        
            return 0;
        }
          </div>
        
          <h4>Change Array Values</h4>
          <p>You can update an array value using its index:</p>
          <pre><code>numbers[2] = 100;</code></pre>
        
          <h4>Summary</h4>
          <ul>
            <li>Arrays hold multiple values of the same data type.</li>
            <li>Indexing starts from 0.</li>
            <li>Use loops to access or modify array elements efficiently.</li>
          </ul>
        
        </div>
      </div>

      <div id="strings" class="section">
        <h1><i>Strings in C</i></h1>
        <div id="padding">
          <h4>What is a String?</h4>
          <p>
            In C, a string is a collection of characters stored in an array and terminated by a null character <code>'\0'</code>. Strings are used to store and manipulate text.
          </p>
        
          <h4>Declaring and Initializing Strings</h4>
          <p>You can declare a string using a character array:</p>
          <pre><code>char str[20] = "Hello";</code></pre>
          <p>or:</p>
          <pre><code>char str[] = {'H', 'e', 'l', 'l', 'o', '\0'};</code></pre>
        
          <h4>Printing a String</h4>
          <p>You can use <code>printf()</code> to display a string:</p>
        
          <button class="btn" onclick="toggleCode('printStrCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="printStrCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            char greeting[20] = "Hello, World!";
            printf("%s\\n", greeting);
            return 0;
        }
          </div>
        
          <h4>Reading a String from User</h4>
          <p>Use <code>scanf()</code> or <code>gets()</code> to read input from the user:</p>
        
          <button class="btn" onclick="toggleCode('inputStrCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="inputStrCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            char name[30];
            printf("Enter your name: ");
            scanf("%s", name);  // Note: This reads only one word
            printf("Hello, %s!\\n", name);
            return 0;
        }
          </div>
        
          <h4>Common String Functions</h4>
          <p>To use these functions, include <code>&lt;string.h&gt;</code>.</p>
          <ul>
            <li><code>strlen(str)</code>: Returns the length of the string.</li>
            <li><code>strcpy(dest, src)</code>: Copies one string to another.</li>
            <li><code>strcat(str1, str2)</code>: Concatenates two strings.</li>
            <li><code>strcmp(str1, str2)</code>: Compares two strings.</li>
          </ul>
        
          <h5>Example: String Functions</h5>
          <button class="btn" onclick="toggleCode('strFuncCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="strFuncCode" class="code-box">
        #include &lt;stdio.h&gt;
        #include &lt;string.h&gt;
        
        int main() {
            char str1[20] = "Hello";
            char str2[20] = "World";
            char result[40];
        
            strcpy(result, str1);   // copy str1 into result
            strcat(result, str2);   // concatenate str2 to result
        
            printf("Combined String: %s\\n", result);
            printf("Length: %lu\\n", strlen(result));
            
            return 0;
        }
          </div>
        
          <h4>Summary</h4>
          <ul>
            <li>Strings are character arrays ending with <code>'\0'</code>.</li>
            <li>Use <code>scanf()</code> or <code>gets()</code> to read strings.</li>
            <li>Common functions for strings are in <code>&lt;string.h&gt;</code>.</li>
          </ul>
        </div>
        </div>
        

        <div id="pointers" class="section">
          <h1><i>Pointers in C</i></h1>
          <div id="padding">
          <h4>What is a Pointer?</h4>
          <p>
            A pointer is a variable that stores the memory address of another variable. Pointers are used for dynamic memory, arrays, and efficient function calls.
          </p>
        
          <h4>Declaring a Pointer</h4>
          <pre><code>data_type *pointer_name;</code></pre>
          <p>Example: <code>int *ptr;</code></p>
        
          <h4>Assigning Address to a Pointer</h4>
          <pre><code>int a = 10;
        int *ptr = &a;  // ptr stores the address of variable a</code></pre>
        
          <h4>Accessing Value Using Pointer</h4>
          <p>
            Use the <code>*</code> (dereference) operator to get the value at the address stored in the pointer.
          </p>
          <pre><code>printf("%d", *ptr);  // prints value of a</code></pre>
        
          <h4>Example: Basic Pointer</h4>
          <button class="btn" onclick="toggleCode('pointerCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="pointerCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int a = 10;
            int *ptr = &a;
        
            printf("Address of a: %p\\n", ptr);
            printf("Value of a using pointer: %d\\n", *ptr);
        
            return 0;
        }
          </div>
        
          <h4>Pointer and Arrays</h4>
          <p>
            The name of an array is also a pointer to its first element. So, you can access array elements using pointers.
          </p>
        
          <h4>Example: Pointer with Array</h4>
          <button class="btn" onclick="toggleCode('pointerArrayCode')">Show Code</button>
          <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
            </svg>
          </a>
        
          <div id="pointerArrayCode" class="code-box">
        #include &lt;stdio.h&gt;
        
        int main() {
            int numbers[] = {10, 20, 30};
            int *ptr = numbers;
        
            for(int i = 0; i < 3; i++) {
                printf("Element %d: %d\\n", i, *(ptr + i));
            }
        
            return 0;
        }
          </div>
        
          <h4>Summary</h4>
          <ul>
            <li>A pointer holds the memory address of another variable.</li>
            <li>Use <code>*</code> to access the value (dereferencing).</li>
            <li>Use <code>&</code> to get the address of a variable.</li>
            <li>Pointers are powerful for arrays, functions, and dynamic memory.</li>
          </ul>
          </div>
      </div>
      
      <div id="structures" class="section">
        <h1><i>Structures in C</i></h1>
        <div id="padding">
        <h4>What is a Structure?</h4>
        <p>
          A structure in C is a user-defined data type that allows you to combine variables of different types into a single unit. It is helpful for grouping related data.
        </p>
      
        <h4>Declaring a Structure</h4>
        <pre><code>struct structure_name {
          data_type member1;
          data_type member2;
          ...
      };</code></pre>
      
        <p>Example:</p>
        <pre><code>struct Person {
          char name[50];
          int age;
      };</code></pre>
      
        <h4>Accessing Structure Members</h4>
        <pre><code>struct Person p1;
      p1.age = 25;
      strcpy(p1.name, "Alice");</code></pre>
      
        <h4>Example: Structure for Student Info</h4>
        <button class="btn" onclick="toggleCode('structCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="structCode" class="code-box">
      #include &lt;stdio.h&gt;
      #include &lt;string.h&gt;
      
      struct Student {
          char name[50];
          int roll;
          float marks;
      };
      
      int main() {
          struct Student s1;
      
          strcpy(s1.name, "Rahim");
          s1.roll = 101;
          s1.marks = 89.5;
      
          printf("Student Name: %s\\n", s1.name);
          printf("Roll: %d\\n", s1.roll);
          printf("Marks: %.2f\\n", s1.marks);
      
          return 0;
      }
        </div>
      
        <h4>Why Use Structures?</h4>
        <ul>
          <li>Group related data (e.g., name, roll, marks) in one place</li>
          <li>Improves code organization and readability</li>
          <li>Used to build complex data types (e.g., linked lists, trees)</li>
        </ul>
      
        <h4>Nested Structures</h4>
        <p>Structures can contain other structures:</p>
        <pre><code>struct Date {
          int day, month, year;
      };
      
      struct Student {
          char name[50];
          struct Date dob;
      };</code></pre>
      
        <h4>Summary</h4>
        <ul>
          <li>Structure = group of variables of different types.</li>
          <li>Use dot operator (<code>.</code>) to access members.</li>
          <li>Structures can be nested or passed to functions.</li>
        </ul>
        </div>
      </div>

      <div id="file-handling" class="section">
        <h1><i>File Handling in C</i></h1>
        <div id="padding">
        <h4>What is File Handling?</h4>
        <p>
          File handling in C allows you to create, open, read, write, and close files. It helps in storing data permanently, unlike variables that are temporary (stored in RAM).
        </p>
      
        <h4>File Operations</h4>
        <ul>
          <li><code>fopen()</code> – Opens a file</li>
          <li><code>fprintf()</code> / <code>fscanf()</code> – Writes/reads from a file</li>
          <li><code>fclose()</code> – Closes a file</li>
          <li><code>fgets()</code>, <code>fputs()</code> – Read/write strings</li>
        </ul>
      
        <h4>Opening a File</h4>
        <pre><code>FILE *fp;
      fp = fopen("file.txt", "w");  // open file to write</code></pre>
        <p><strong>Modes:</strong> <code>"r"</code> (read), <code>"w"</code> (write), <code>"a"</code> (append), <code>"r+"</code> (read+write)</p>
      
        <h4>Example: Write to a File</h4>
        <button class="btn" onclick="toggleCode('writeFileCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="writeFileCode" class="code-box">
      #include &lt;stdio.h&gt;
      
      int main() {
          FILE *fp;
          fp = fopen("data.txt", "w");  // Open file in write mode
      
          if (fp == NULL) {
              printf("Error opening file!\\n");
              return 1;
          }
      
          fprintf(fp, "Hello File Handling in C!\\n");
          fclose(fp);  // Close the file
          return 0;
      }
        </div>
      
        <h4>Example: Read from a File</h4>
        <button class="btn" onclick="toggleCode('readFileCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="readFileCode" class="code-box">
      #include &lt;stdio.h&gt;
      
      int main() {
          FILE *fp;
          char content[100];
      
          fp = fopen("data.txt", "r");  // Open file in read mode
      
          if (fp == NULL) {
              printf("File not found!\\n");
              return 1;
          }
      
          while (fgets(content, sizeof(content), fp)) {
              printf("%s", content);
          }
      
          fclose(fp);
          return 0;
      }
        </div>
      
        <h4>Summary</h4>
        <ul>
          <li>Use <code>FILE *</code> pointer for file operations.</li>
          <li><code>fopen()</code> opens a file, <code>fclose()</code> closes it.</li>
          <li>Use <code>fprintf()</code> and <code>fscanf()</code> for writing/reading.</li>
          <li>Always check if the file exists before reading it.</li>
        </ul>
      </div>
      </div>

      <div id="dynamic-memory" class="section">
        <h1><i>Dynamic Memory Allocation in C</i></h1>
        <div id="padding">
        <h4>What is Dynamic Memory Allocation?</h4>
        <p>
          In static memory allocation, the size of memory is fixed at compile time. But in dynamic memory allocation, you can allocate or free memory during runtime using special functions from <code>&lt;stdlib.h&gt;</code>.
        </p>
      
        <h4>Functions for Dynamic Memory Allocation</h4>
        <ul>
          <li><code>malloc()</code> – Allocates memory and returns a pointer</li>
          <li><code>calloc()</code> – Allocates memory and initializes it to zero</li>
          <li><code>realloc()</code> – Resizes previously allocated memory</li>
          <li><code>free()</code> – Frees allocated memory</li>
        </ul>
      
        <h4>Example: Using malloc()</h4>
        <button class="btn" onclick="toggleCode('mallocCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="mallocCode" class="code-box">
      #include &lt;stdio.h&gt;
      #include &lt;stdlib.h&gt;
      
      int main() {
          int *ptr;
          int n = 5;
      
          ptr = (int*) malloc(n * sizeof(int));  // Allocate memory
      
          if (ptr == NULL) {
              printf("Memory not allocated!\\n");
              return 1;
          }
      
          for (int i = 0; i < n; i++) {
              ptr[i] = i + 1;
          }
      
          printf("Allocated array: ");
          for (int i = 0; i < n; i++) {
              printf("%d ", ptr[i]);
          }
      
          free(ptr);  // Free memory
          return 0;
      }
        </div>
      
        <h5>calloc() vs malloc()</h4>
        <p>
          <code>calloc()</code> initializes memory to zero, while <code>malloc()</code> leaves it with garbage values.
        </p>
      
        <h5>realloc() Example</h4>
        <button class="btn" onclick="toggleCode('reallocCode')">Show Code</button>
        <a class="btn try-btn" href="https://www.onlinegdb.com/online_c_compiler" target="_blank">Try It Yourself
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
          </svg>
        </a>
      
        <div id="reallocCode" class="code-box">
      #include &lt;stdio.h&gt;
      #include &lt;stdlib.h&gt;
      
      int main() {
          int *ptr = malloc(2 * sizeof(int));
          ptr[0] = 1;
          ptr[1] = 2;
      
          ptr = realloc(ptr, 4 * sizeof(int));  // Resize to 4 integers
          ptr[2] = 3;
          ptr[3] = 4;
      
          for (int i = 0; i < 4; i++) {
              printf("%d ", ptr[i]);
          }
      
          free(ptr);  // Free the resized memory
          return 0;
      }
        </div>
      
        <h5>Summary</h4>
        <ul>
          <li><code>malloc()</code> and <code>calloc()</code> allocate memory at runtime.</li>
          <li><code>realloc()</code> changes the size of the allocated memory.</li>
          <li><code>free()</code> must be used to release allocated memory to avoid memory leaks.</li>
        </ul>
      </div>
      </div>
    
    </div>
</div>
<footer class="footer">
  &copy; 2025 MySite. All rights reserved.
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>