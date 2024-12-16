document.addEventListener("DOMContentLoaded", function () {
    const logins = document.getElementById("logins");




    logins.addEventListener("click", function(){
        /* var email = document.getElementById("email").value;
        var psword = document.getElementById("password").value; 
        alert(`http://localhost/info2180-finalproject/login.php?email=${email}&password=${psword}`) */
        location.replace(`http://localhost/info2180-finalproject/login.php?email=admin@project2.com&password=password123`);

    // Redirect to the new location with encoded parameters
    });        


    
})
