function registerSubmit()
{
  /**
   *通过ajax的方式，将表单中的四个字段发送给服务端，并获取服务端回应，将回应信息alert出来。
   *如果注册成功，跳转到登录页面
   */
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var psw1 = document.getElementById("psw1").value;
  var psw2 = document.getElementById("psw2").value;

  if(psw1 != psw2){
    alert('两次密码不同');
    return;
  }
  var request = new XMLHttpRequest();
  request.open("POST","../../index/users/register",true);
  request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  request.send("username="+username+"&email="+email+"&psw="+psw1);
  request.onreadystatechange = function()
  {
    var SECCESS_RETURN = 1000;

    if (request.readyState==4 && request.status==200)
    {
      var responseObj = JSON.parse(request.responseText);
      switch (responseObj.code) {
        case SECCESS_RETURN:
          alert(responseObj.msg);
          window.location.href = "../../index.html";
          break;
        default:
          alert(responseObj.msg);
          break;
      }
    }
  }
}
