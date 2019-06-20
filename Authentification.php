<!DOCTYPE html>
<html lang="en">
    <?php session_start();?>
    <?php 

include './Services/UtilisateurService.php';
            $uti=new UtilisateurService();
            $a=0;
           
                    $_SESSION['username']='';
                    $_SESSION['password']='';
                    $_SESSION['profil']='';
            if (isset($_POST['ok']))
            {
                foreach ($uti->findAll() as $key)
            {
                if($key->getNom()==$_POST['username']and  $key->getMotdepasse()==$_POST['password'])
                {$_SESSION['username']=$key->getNom();
                    $_SESSION['password']=$key->getMotdepasse();
                    $_SESSION['profil']=$key->getProfil();
                    $a=$key->getProfil();
                    header('location: ./index.php');
                    //echo $key->getNom()."|".$key->getMotdepasse()."|".$key->getProfil();
                    break;
                }
                else
                {header('location: ./Authentification.php');
                }
            }
            }
            if($_SESSION['username']!='')
                    {header('location: ./index.php');}
           ?>
    <head> 
                <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
                <link rel="icon" href="rsc/logoRadeema.gif" />
		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="assets/css/main.css">
                <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
                <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
                <!------ Include the above in your HEAD tag ---------->
                <!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Authentification</title>
                <style>
                  
body {
position: absolute;
        top: 0; bottom: 0; left: 0; right: 0;
        height: 100%;
    margin:0;
    padding:0;
    background-size: 100% ;
    width:100%;  
    color:black;
}
body:before {
        content: "";
        position: fixed;
        height: 100%; width: 100%;
        background:url(rsc/radeema.jpg);
        background-size: cover;
        z-index: -1; /* Keep the background behind the content */     
        -webkit-filter: blur(8px);
    -webkit-background-size: cover; /* pour Chrome et Safari */
    -moz-background-size: cover; /* pour Firefox */
    -o-background-size: cover; /* pour Opera */
    background-size: cover; /* version standardisée */
    }

.main{
 	margin-top: 70px;
}

h1.title { 
	font-size: 50px;
	font-family: 'Passion One', cursive; 
	font-weight: 400; 
}

hr{
	width: 10%;
	color: #fff;
}

.form-group{
	margin-bottom: 15px;
}

label{
	margin-bottom: 15px;
}

input,
input::-webkit-input-placeholder {
    font-size: 11px;
    padding-top: 3px;
}

.main-login{
 	background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}

.main-center{
 	margin-top: 30px;
 	margin: 0 auto;
 	max-width: 330px;
    padding: 40px 40px;

}

.login-button{
	margin-top: 5px;
}

.login-register{
	font-size: 11px;
	text-align: center;
}

                </style>
	</head>
	<body>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Gestion Dotation</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="POST">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Nom Utilisateur</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                                        <input type="text" class="form-control" name="username" id="name"  placeholder="Enter votre identifant" required=""/>
                                                                        
                                                                </div>
							</div>
						</div>
                                                <div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Mot de pass</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                                        <input type="password" class="form-control" name="password" id="password"  placeholder="Enter votre mot de pass" required=""/>
								</div>
							</div>
						</div>
						<div class="form-group ">
                                                    <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="ok">Register</button>
						</div>
						
					</form>
				</div>
			</div>
		</div>


		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	</body>
</html>