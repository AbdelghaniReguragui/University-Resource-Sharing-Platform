function openUpdate() {
  document.getElementById("updateName").style.display = "block";
}

function cancelUpdate() {
  document.getElementById("updateName").style.display = "none";
}


          function submitForm(id){
//           var form =
           document.getElementById(id).submit();
          console.log(id);
//           x[0].submit();
          
//             for (var i = 0; i < form.length; i ++) {
//         form[i].mySubmit.click();
    }
    
    function doSomething() {
    alert('Form submitted!');
    return false;
}


function openUpdateForm(id) {
    var form = document.getElementsByClassName('reset-form-popup');

    for (var i = 0; i < form.length; i ++) {
        form[i].style.display = 'none';
    }
    form = document.getElementsByClassName('delete-form-popup');

    for (var i = 0; i < form.length; i ++) {
        form[i].style.display = 'none';
    }
    form = document.getElementsByClassName('update-form-popup');

    for (var i = 0; i < form.length; i ++) {
        if(form[i].id!=arguments[0]){
            form[i].style.display = 'none';
        }
    }
//  document.getElementsByClassName('delete-form-popup').style.display="none";
  document.getElementById(arguments[0]).style.display = "block";
}

function closeUpdateForm(id) {
  document.getElementById(arguments[0]).style.display = "none";
}

function openDeleteForm(id) {
// document.getElementsByClassName('form-popup').style.display="block";
    var form = document.getElementsByClassName('update-form-popup');

    for (var i = 0; i < form.length; i ++) {
        form[i].style.display = 'none';
    }
    form = document.getElementsByClassName('reset-form-popup');

    for (var i = 0; i < form.length; i ++) {
        form[i].style.display = 'none';
    }
    form = document.getElementsByClassName('delete-form-popup');

    for (var i = 0; i < form.length; i ++) {
        if(form[i].id!=arguments[0]){
            form[i].style.display = 'none';
        }
    }
//  document.getElementsByClassName('delete-form-popup').style.display="none";
  document.getElementById(arguments[0]).style.display = "block";
}

function closeDeleteForm(id) {
  document.getElementById(arguments[0]).style.display = "none";
}

function openResetForm(id) {
// document.getElementsByClassName('form-popup').style.display="block";
    var form = document.getElementsByClassName('update-form-popup');

    for (var i = 0; i < form.length; i ++) {
        form[i].style.display = 'none';
    }
    form = document.getElementsByClassName('delete-form-popup');

    for (var i = 0; i < form.length; i ++) {
        form[i].style.display = 'none';
    }
    form = document.getElementsByClassName('reset-form-popup');

    for (var i = 0; i < form.length; i ++) {
        if(form[i].id!=arguments[0]){
            form[i].style.display = 'none';
        }
    }
//  document.getElementsByClassName('delete-form-popup').style.display="none";
  document.getElementById(arguments[0]).style.display = "block";
}

function closeResetForm(id) {
  document.getElementById(arguments[0]).style.display = "none";
}
