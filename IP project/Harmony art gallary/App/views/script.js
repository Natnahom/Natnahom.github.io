// const passwordBid = "1357";
// const passwordUp = "2468";

// Gives the user their bidding or uploading password
function func1(){
    var textBox = document.getElementById('textBox').value;
    var password = document.getElementById("textBox2").value;

    if (password === "" || textBox === ""){
        alert("Invalid Data!")
    }
    else {
        if (document.getElementById("select1").checked){
            alert("Welcome "+textBox+"\nCopy your bidding password and use it to bid on any art you want."+"\nBidding password: "+passwordBid);
        }

        else if(document.getElementById("select2").checked){
            alert("Welcome "+textBox+"\nCopy your uploading password and use it to upload your artwork."+"\nUploading password: "+passwordUp);
        }
    }
}

// Function that checks if the bidding password is correct and 
// when Bid button is clicked it has a functionality that allows the user to bid and also
// checks if the bid money the user entered is higher than the current bid amount

var previousBid=0;
function func2(){
    var textBox = document.querySelector("#textBox").value;

    if (textBox == passwordBid) {
        var artN = window.prompt("Enter the name in the brackets? ");
        var bid1 = window.prompt("How much money would you like to bid? "+"\nPlease double check your bid!");
        var artChar3 = artN[3];
        var artChar4 = artN[4];
        
        bid1 = Number(bid1);
        if (artN.length <= 4) {
            var labelEle = document.getElementById(`p${artChar3}`);
            var price;
            
            if (labelEle) {
                price = parseInt(labelEle.innerHTML);    
              }
             else{
                 price = previousBid;
             }

            if (bid1 <= price || bid1 === 0) {
                alert("Your bid cannot be less than the current bid!");
            }

            else{
                alert("You bid $"+bid1);
                document.querySelector(`#${artN}`).innerHTML = "Current Bid: $"+bid1; 
            }
        }
    
        else if (artN.length > 4){
            var labelEle2 = document.getElementById(`p${artChar3}${artChar4}`);
            var price2

            if (labelEle2) {
                price2 = parseInt(labelEle2.innerHTML);    
            }
            else{
                price2 = previousBid;
            }

            if (bid1 <= price2 || bid1 === 0) {
                alert("Your bid cannot be less than the current bid!");
            }

            else{
                alert("You bid $"+bid1);
                document.querySelector(`#${artN}`).innerHTML = "Current Bid: $"+bid1;
            }
        }
        
    }
        
    else {
        alert("Invalid password!");
    }

    previousBid = bid1;
}

// Function for checking if the password is correct when user is uploading a file
function func3(){
    var textBox = document.getElementById('textBox').value;
    var Fullname = document.getElementById("Fullname").value;
    var StDate = document.getElementById("StDate").value;
    var MinBid = document.getElementById("MinBid").value;
    
    if (textBox === passwordUp){
        alert("Artwork uploaded successfully!"+"\nFullname: "+Fullname+"\nStarting date: "+StDate+"\nMinimum bid: "+MinBid);
    }
    else{
        alert("Invalid password!");
    }
}

// Function for checking if password and confirm password match
function func4(){
    var userName = document.getElementById("textBox2").value;
    var pass = document.getElementById("pass").value;
    var confP = document.getElementById("confP").value;

   if (pass !== confP){
        alert("Passwords do not match!");
    }
    // else{
    //     alert("Registered successfully!"+"\nWelcome "+userName+"!");
    // }
}


// Set the countdown date and time
var countdownDate = new Date("June 29, 2024 00:00:00").getTime();

// Update the countdown every second
var countdown = setInterval(function() {
  var now = new Date().getTime();
  var distance = countdownDate - now;

  // Calculate days, hours, minutes, and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the countdown
  document.getElementById("countdown").innerHTML = "Remaining time: " + days + "d " + hours + "h "
    + minutes + "m " + seconds + "s " + "remains until the bidding ends.";

  // If the countdown is over, display a message
  if (distance < 0) {
    clearInterval(countdown);
     document.getElementById("countdown").innerHTML = "Bidding ended!";
     var sold = document.getElementsByClassName("sold");
     
     for (let i = 1; i <= 20; i++){
        document.getElementById(`btn${i}`).style.display = "none";
        for (var j = 0; j < 20; j++){
                sold[j].innerHTML = "SOLD!";
        }
    }
  }
}, 1000);