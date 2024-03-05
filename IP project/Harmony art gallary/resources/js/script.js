const passwordBid = "1357";
const passwordUp = "2468";

function func1(){
    var textBox = document.getElementById('textBox').value;

    if (document.getElementById("select1").checked){
        alert("Welcome "+textBox+"\nCopy your bidding password and use it to bid on any art you want."+"\nBidding password: "+passwordBid);
    }

    else if(document.getElementById("select2").checked){
        alert("Welcome "+textBox+"\nCopy your uploading password and use it to upload your artwork."+"\nUploading password: "+passwordUp);
    }
}

function func2(){
    var textBox = document.querySelector("#textBox").value;

    if (textBox == passwordBid) {
        var artN = window.prompt("Enter the name in the brackets? ");
        var bid1 = window.prompt("How much money would you like to bid? "+"\nPlease double check your bid!");
        // var artChar3 = artN[3];
        // var price = document.querySelector("#p"+artChar3).value;
        // price = Number(price);

        bid1 = Number(bid1);
        
        if (bid1 < 1500) {
            alert("Your bid cannot be less than the current bid!");
        }
        
        else{
            alert("You bid $"+bid1);
            document.querySelector(`#${artN}`).innerHTML = "Current Bid: $"+bid1;

            // setTimeout(function func3(){
            //     if(attempt < 3){
            //         alert("Another customer bid $"+(bid1+bid2));
            //         document.querySelector(`#${artN}`).innerHTML = "Current Bid: $"+(bid1+bid2);
            //     }
            // }, 2000);

            // if (attempt > 2){
            //     alert("You can't outbid your self more than 2 times!");
            //     alert("Congratulations the other bidder retracted their bid!"+"\nYou bought the art for $"+bid1);
            //     document.querySelector(`#${artN}`).innerHTML = "$"+bid1+" SOLD!!";
            //     if (artN.length > 4){
            //         document.querySelector(`#btn${artN[3]}${artN[4]}`).style.display = "none";
            //     }
            //     else{
            //         document.querySelector(`#btn${artN[3]}`).style.display = "none";
            //     }
            // }
            
        }
    }
        
    else {
        alert("Invalid password!");
    }
    
}

// Function for checking if the password is correct when user is uploading a file
function func4(){
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
function func5(){
    var userName = document.getElementById("textBox2").value;
    var pass = document.getElementById("pass").value;
    var confP = document.getElementById("confP").value;

   if (pass !== confP){
        alert("Passwords do not match!");
    }
    else{
        alert("Registered successfully!"+"\nWelcome "+userName+"!");
    }
}


// Set the countdown date and time
var countdownDate = new Date("March 6, 2024 00:00:00").getTime();

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
     for (let i = 1; i <= 20; i++){
        document.getElementById(`btn${i}`).style.display = "none";
     }
  }
}, 1000);

// // Set the countdown date and time
// var countdownDate = new Date("March 6, 2024 00:00:00").getTime();

// // Update the countdown every second
// var countdown = setInterval(function() {
//   var now = new Date().getTime();
//   var distance = countdownDate - now;

//   // Calculate days, hours, minutes, and seconds
//   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//   var seconds = Math.floor((distance % (1000 * 60)) / 1000);

//   // Display the countdown
//   var countdownElements = document.getElementsByClassName("countdown");
//   for (var i = 0; i < countdownElements.length; i++) {
//     countdownElements[i].innerHTML = days + "d " + hours + "h "
//       + minutes + "m " + seconds + "s ";
//   }

//   // If the countdown is over, display a message
//   if (distance < 0) {
//     clearInterval(countdown);
//     for (var i = 0; i < countdownElements.length; i++) {
//         countdownElements[i].innerHTML = "Countdown expired!";
//         document.getElementsByClassName("view-auction")[i].style.display = "none";
//     }
//   }
// }, 1000);
// // }