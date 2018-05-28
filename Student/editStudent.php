<?php include '../header.php'; ?>
<div class="well form-horizontal" id="student-form">
  <a href="Student.php" class="btn btn-default"> Go Back</a>
  <fieldset>
    <legend><center><h2><b>Edit Student</b></h2></center></legend><br>
    <div class="form-group">
      <label class="col-md-4 control-label">Firstname</label>
      <div class="col-md-4 ">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="firstname" name="firstname" placeholder="First Name..." class="form-control" type="text" value="">
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">Lastname</label>
      <div class="col-md-4 ">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="lastname" name="lastname" placeholder="Last Name..." class="form-control" type="text" required value="">
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">Email</label>
      <div class="col-md-4 ">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="email" name="email" placeholder="Email..." class="form-control" type="text" required value="">
        </div>
      </div>
    </div>
    <br>
    <div class="form-group text-center">
      <label class="col-md-4 control-label"></label>
      <div class="col-md-2">
          <button type="button" name="button" class="btn btn-success btn-block" role="button" onclick="update()">Update</button>

      </div>
      <div class="col-md-2">
        <button type="button" name="button" class="btn btn-warning btn-block" role="button" onclick="remove();">Delete</button>
      </div><br><br>          
    </div>
</div>

<?php 
  if(isset($_GET['key'])){
    $key = $_GET['key'];
  }
?>
<input type="hidden" id="key" value="<?= $key ?>">

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

  // get Data from URL
  var key = $('#key').val();
  
  // retrieve value by ID then display into textfield
  firebase.database().ref('/student/' + key).once('value').then(function(snapshot) {
      $('#firstname').val(snapshot.val().student_firstname);
      $('#lastname').val(snapshot.val().student_lastname);
      $('#email').val(snapshot.val().student_email);
  });

  // execute when click
  function update(){
    var data = { 
      student_firstname: $('#firstname').val(),
      student_lastname: $('#lastname').val(),
      student_email: $('#email').val(), 
    }

    var updates = {};
    updates['/student/' + key] = data;
    var updateData = firebase.database().ref().update(updates);

    if(updateData){
      toastr.success('Data successfully updated','Updated');
      setTimeout(function(){
        window.location.reload();
      },2000);
    }else{
      toastr.error('Error updating data','Error');
    }
  }

  function remove(){
    var conFirm = confirm('Are you sure?');
    if(conFirm){
      var ref = firebase.database().ref();
      var deleteData = ref.child('/student/' + key).remove();

      if(deleteData){
        toastr.success('Data deleted successfully','Deleted');
        setTimeout(function(){
          window.location.href = 'student.php';
        },3000);
      }else{
        toastr.error('Error deleting data','Error');
      } 
    }else{
      return false;
    }

  }

</script>