$("#userLogin").click(function(){
  alert(0)
  var name=$("#inputEmail3").text();
  var password=$("#inputPassword3").text();
  setCookie("user",name);
  setCookie("password",password);
  alert(getCookie("user"))
  alert(getCookie("password"))
})

// setCookie("name","hayden");
// alert(getCookie("name"));
