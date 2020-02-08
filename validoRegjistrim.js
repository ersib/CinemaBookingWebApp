function validoPass(){
  var pattern=/[a-zA-Z0-9]{6,}/;
  var pass=document.getElementById('pass').value;
   var div=document.getElementById('vpwd');
   if(!pattern.test(pass)){
   div.innerHTML='<p>(The password format is incorrect !</p><p> You can use only letters and digits !</p> <p>Minimun length : 6 characters !)</p>';
   return false;
   }
   else{
     div.innerHTML='';
     return true;
   }
}
  function checkpassword(){
    var pass=document.getElementById('pass').value;
     var cpass=document.getElementById('cpass').value;
     var div=document.getElementById('cpwd');
     if(pass!=cpass && validoPass()==true && cpass!=''){
     div.innerHTML='(The passwords dont match ! )';
     }
     else{
       div.innerHTML='';
     }
  }
  function checktel(){
    var tel=document.getElementById('tel').value;
    if(tel=='')
    return;
    var pattern=/^[06]+\d{8}$/;
     var div=document.getElementById('_tel');
     if(pattern.exec(tel) && (tel.length==10)){
     div.innerHTML='';
     }
     else{
       div.innerHTML='(The phone number is incorrect ! )';
     }
  }
  function checkemail(){
    var mail=document.getElementById('email').value;
    if(mail=='')
    return;
    var pattern=/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
     var div=document.getElementById('_email');
     if(pattern.exec(mail)){
     div.innerHTML='';
     }
     else{
       div.innerHTML='(The email is incorrect ! )';
     }
  }
