const fs = require('fs');
const express = require('express');
const path = require('path');
const multer = require('multer');

// Create an Express app
const app = express();

// Enable JSON parsing for the request body
app.use(express.json());

// Serve static files from the public directory
app.use(express.static('public'));

// Serve the index.html file for the root URL
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'UPI_index.html'));
});

// Upload image
const upload = multer({ dest: 'uploads/' });

app.post('/upload', upload.single('image'), (req, res) => {
  if (!req.file) {
    res.status(400).send('No file uploaded.');
    return;
  }
  
  // Get the original filename from the uploaded file
  const originalname = req.file.originalname;
  
  // Move the uploaded file to a new location with the new filename
  const newFilePath = path.join('uploads/', originalname);
  fs.renameSync(req.file.path, newFilePath);
  
  res.send(`File uploaded successfully. Original Filename: ${originalname}`);
});

app.listen(3000, () => {
  console.log('Server is running on port 3000');
});












// // server.js
// const express = require('express');
// const mysql = require('mysql2');
// const path = require('path');

// // Create a MySQL connection pool
// const pool = mysql.createPool({
//   host: '127.0.0.1',
//   user: 'root',
//   password: '122112n@t',
//   database: 'test',
//   waitForConnections: true,
//   connectionLimit: 10,
//   queueLimit: 0,
// });

// // Create an Express app
// const app = express();

// // Enable JSON parsing for the request body
// app.use(express.json());

// // Serve static files from the public directory
// app.use(express.static('public'));

// // Create the users table if it doesn't exist
// pool.query(
//   `CREATE TABLE IF NOT EXISTS users (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     name VARCHAR(255) NOT NULL,
//     username VARCHAR(255) NOT NULL,
//     password VARCHAR(255) NOT NULL
//   )`,
//   (err, results) => {
//     if (err) {
//       console.error(err);
//     }
//   }
// );

// // Handle user signup
// app.post('/signup', (req, res) => {
//   const { name, username, password } = req.body;

//   // Insert a new user into the database
//   pool.query(
//     'INSERT INTO users (name, username, password) VALUES (?, ?, ?)',
//     [name, username, password],
//     (err, results) => {
//       if (err) {
//         console.error(err);
//         res.status(500).send('Error signing up');
//       } else {
//         res.status(200).send('Signup successful');
//       }
//     }
//   );
// });

// // Handle user login
// app.post('/login', (req, res) => {
//   const { username, password } = req.body;

//   // Find the user in the database
//   pool.query(
//     'SELECT * FROM users WHERE username = ? AND password = ?',
//     [username, password],
//     (err, results) => {
//       if (err) {
//         console.error(err);
//         res.status(500).send('Error logging in');
//       } else if (results.length === 0) {
//         res.status(401).send('Invalid username or password');
//       } else {
//         res.status(200).send('Login successful');
//       }
//     }
//   );
// });

// // Serve the index.html file for the root URL
// app.get('/', (req, res) => {
//   res.sendFile(path.join(__dirname, 'index.html'));
// });

// // Start the server
// app.listen(3000, () => {
//   console.log('Server started on http://localhost:3000');
// });

// //upload image
// //const express = require('express');
// const multer = require('multer');

// //const app = express();
// const upload = multer({ dest: 'uploads/' });

// app.use(express.static('public'));

// app.post('/upload', upload.single('image'), (req, res) => {
//   if (!req.file) {
//     res.status(400).send('No file uploaded.');
//     return;
//   }
  
//   // Process the uploaded file as needed
//   const filename = req.file.filename;
//   // Additional processing logic here
  
//   res.send(`File uploaded successfully. Filename: ${filename}`);
// });

// app.listen(3000, () => {
//   console.log('Server is running on port 3000');
// });










// document.getElementById("btn").addEventListener("mouseover", function func1(e){
//     var demo = document.getElementById("demo");
//     var textB = document.getElementById("textB").value;

//     if (textB === "1"){
//         demo.innerHTML = "CORRECT!!";
//     }

//     else{
//         demo.innerHTML = "WRONG!!";
//     }
// });







// function generatePassword(length, includeLowCase, includeUpCase, includeNum, includeSym){

//     const lowerCaseChars = "abcdefghijklmnopqrstuvwxyz";
//     const upperCaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//     const numberChars = "0123456789";
//     const symbolChars = "!@#$%^&*+=";

//     let allowedChars = "";
//     let password = "";

//     allowedChars += includeLowCase ? lowerCaseChars : "";
//     allowedChars += includeUpCase ? upperCaseChars : "";
//     allowedChars += includeNum ? numberChars : "";
//     allowedChars += includeSym ? symbolChars : "";

//     if (length <= 0){
//         return `(Password length must be at least 1)`;
//     }

//     if(allowedChars.length === 0){
//         return `(At least 1 set of characters must be selected)`;
//     }

//     for (let i = 0; i < length; i++){
//         const randomindex = Math.floor(Math.random() * allowedChars.length);
//         password += allowedChars[randomindex];
//     }

//     return password;
// }

// const passLength = 8;
// const includeLowCase = true;
// const includeUpCase = true;
// const includeNum = true;
// const includeSym = true;

// const password = generatePassword(passLength, 
//                                 includeLowCase, 
//                                 includeUpCase, 
//                                 includeNum, 
//                                 includeSym);

// console.log(`Generated password: ${password}`);




    // var randomNum = Math.floor(Math.random() * 100) + 1;
    // var num;
    // let attempts = 0;
    // let running = true;
    
    
    // while (running){

    //     num = window.prompt("Guess a number from 1 - 100: ");
    //     num = Number(num);

    //     if (isNaN(num)){
    //         window.alert("Invalid number");
    //     }

    //     else {

    //         attempts++;
            
    //         if (num > randomNum){
    //             window.alert("Too high!");
    //         }
    //         else if (num < randomNum){
    //             window.alert("Too low!");
    //         }
    //         else {
    //             window.alert("Congratulations you got it!"+" It took you "+attempts+" attempts.");
    //             running = false;
    //         }
    //     }
    // }



    
// function myfunc(){
//     const num1 = document.getElementById("num1").value;
//     const opp = document.getElementById("opp").value;
//     const num2 = document.getElementById("num2").value;
//     var answer;
    
//     if (opp === "+"){
//         answer = Number(num1) + Number(num2);    
//     }
//     else if (opp === "-"){
//         answer = num1 - num2;
//     }
//     else if (opp === "*"){
//         answer = num1 * num2;
//     }
//     else if (opp === "/"){
//         answer = num1 / num2;
//     }
//     else if (opp === "%"){
//         answer = num1 % num2;
//     }

//     document.write("Answer: "+answer);
// }