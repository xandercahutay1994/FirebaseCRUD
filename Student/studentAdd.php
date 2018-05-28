<?php include '../header.php'; ?>
<div class="well form-horizontal" id="student-form">
  <fieldset>
    <legend><center><h2><b>Registration Form</b></h2></center></legend><br>
    <div class="form-group">
      <label class="col-md-4 control-label">Firstname</label>
      <div class="col-md-4 ">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="firstname" name="firstname" placeholder="First Name..." class="form-control" type="text" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">Lastname</label>
      <div class="col-md-4 ">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="lastname" name="lastname" placeholder="Last Name..." class="form-control" type="text" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">Email</label>
      <div class="col-md-4 ">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="email" name="email" placeholder="Email..." class="form-control" type="text" required>
        </div>
      </div>
    </div>
    <br>
    <div class="form-group text-center">
      <label class="col-md-4 control-label"></label>
      <div class="col-md-4">
          <button type="button" name="button" class="btn btn-success btn-block" role="button" onclick="register()">Register</button>
          <a href="Student.php" class="btn btn-default btn-block"> Go Back</a>
      </div>
    </div>
</div>

<!-- ADDING THE DATA IN FIREBASE -->
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

  var databaseRef = firebase.database().ref('student');

  // WHEN BUTTON REGISTER CLICK
  function register(){
    // check if fields are not empty
    if($('#firstname').val() != "" || $('#lastname').val() != "" || $('#email').val() != ""){
      // data to be post in firebase database
      var postData = databaseRef.push().set({
                      // unique id
                      // student_id: Math.random().toString(36).substr(2, 16), 
                      student_firstname: $('#firstname').val(),
                      student_lastname: $('#lastname').val(),
                      student_email: $('#email').val(),
                    });

      // check if data save
      if(postData){
        toastr.success('Added successfully','Added');
        // clear the fields after added to database
        $('#student-form').find('input:text').val('');
        // $('#student-form').find('input:email').val('');
      }else{
        toastr.error('Error adding the data','Error');
      }
    }else{
      // toastr message
      toastr.error('All fields must be fill in','Error Saving');
    }
  }
</script>