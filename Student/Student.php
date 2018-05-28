<?php include '../header.php'; ?>
  <h3> STUDENT MANAGEMENT </h3>
  <div class="nav nav-tabs w3-teal">
    <li><a href="#home">HOME</a></li>
    <li><a href="Student.php" href="#student">STUDENT</a></li>
    <li><a href="#course">COURSE </a></li>
    <li><a href="#payment">PAYMENT</a></li>
    <li><a href="#report">REPORT</a></li>
  </div>
  <br>
  <div class="container" style="overflow-x: auto;">
    <a href="studentAdd.php" class="btn btn-primary" name="button" >+ADD</a>
    <br><br>
    <table class="table table-responsive table-striped">
      <thead class="thead-dark w3-large">
        <th>ID</th>
        <th>Fullname</th>
        <th>Email</th>
        <th>Action</th>
      </thead>
    </table>
  </div>


<!-- FETCH/RETRIEVE DATA FROM DATABASE -->
<script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>
<script>
   // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBJbEWqxcNsiZDRM030_50K9j4n7szLM-s",
    authDomain: "itcongress-a93fe.firebaseapp.com",
    databaseURL: "https://itcongress-a93fe.firebaseio.com",
    projectId: "itcongress-a93fe",
    storageBucket: "",
    messagingSenderId: "561980507832"
  };
  firebase.initializeApp(config);

  var databaseRef = firebase.database().ref('student').orderByChild('student_lastname');

  databaseRef.once('value',function(data){
    if(data.exists()){

      // iterate/looping the data
      data.forEach(function(value){
          var key = value.key; 
          var Fullname= value.val().student_lastname + ', ' + value.val().student_firstname;
          var Email= value.val().student_email;
          
          $('.table').append("<tr>" +
                 // "<td>" + ID + "</td>" +
                 "<td>" + key + "</td>" +
                 "<td>" + Fullname + "</td>" +
                 "<td>" + Email + "</td>" +
                 "<td> <div style='font-size:20px'>" +
                           "<a id='edit' href=editStudent.php?key=" + key +"><button class='btn btn-primary'><i class='far fa-edit'></i> Manage </button></a>"+
                     "</div></td>"+
           "</tr>");
          function del(){
            return confirm("Are");
          }
      });
    } 
    
  });

</script>