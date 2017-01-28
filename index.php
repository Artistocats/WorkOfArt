<?php
require "database.php";
include "header.php";
?>



<body>
<!--INDEX AFTER LOGIN-->
<?php
	if ($conn)
    {
        include "menu.php";
        include "home.php";
    }
	else
	{
?>



<!--INDEX BEFORE LOGIN-->

<h1>Welcome to WorkOfArt</h1>

<!--LOGIN-->
<div id="login">

    <h2>Login</h2>
    <form action="do_login.php" method="post">
    <p>Username:
    <input type="text" name="username" maxlength="50" required/>
    </p>
    <p>Password:
    <input type="password" name="password" maxlength="50" required/>
    </p>
            <p><input type="submit" value="Login" class="button"/></p>
    </form>

    <!--LOGIN ERRORS-->
	<span>

	<?php
    	if(isset($_SESSION['fl']))
    	{
			if($_SESSION['fl']==1)
            {
				echo '<p class="error">Invalid Username or Password!</p>';
                unset($_SESSION['fl']);
            }
            else if($_SESSION['fl']==4)
            {
                echo '<p class="error">Please login first!</p>';
                unset($_SESSION['fl']);
            }
		}
	?>
	
    </span>

</div>
    



<!--SIGNUP-->
<div id="signup">
    <h2>Sign Up</h2>

    <form action="do_signup.php" method="post">
    <p>Username:
    <input type="text" name="username" maxlength="50" required/>
    </p>
    <p>Password:
    <input type="password" name="password" maxlength="50" required/>
    </p>
    <p class="email"> E-Mail:
    <input type="email" name="email" maxlength="50"/ required>
    </p>
            <p><input type="submit" value="Sign up"/></p>
    </form>



    <!--SIGNUP ERRORS-->
	<span>

	<?php
    	if(isset($_SESSION['fl']))
    	{
			if($_SESSION['fl']==2)
            {
            	echo '<p class="error">Please fill in all fields</p>';
                unset($_SESSION['fl']);
            }
            elseif($_SESSION['fl']==3)
            {
            	echo '<p class="error">Username/email already exists</p>';
                unset($_SESSION['fl']);
            }
		}
	?>
	</span>

</div>



<?php
}
include "footer.php";
?>
