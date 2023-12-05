<?php
   include('session.php');
?>
<html class="h-100">
   
   <head>
        <title>Admin</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/style.css" rel="stylesheet">
        <style>
            .img-responsive {
                width: auto;
                height: 150px;
            }

        </style>
   </head>
   
   <body class="h-100">
   <div class="container-fluid pr-0 pl-0 h-100 d-flex flex-column">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        
        <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
            <a class="navbar-brand" href="admin_page.php">Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                    <a class="nav-item nav-link " href="gestion_etudiants.php">Etudiants</a>
                    <a class="nav-item nav-link " href="gestion_enseignants.php">Enseignants<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="gestion_filieres.php">Filieres</a>
                </div>
                <div class="navbar-nav ml-auto">
                    <span class="nav-item nav-link"><?php echo $admin_name; ?></span>
                    <a class="nav-item nav-link bg-danger rounded" href = "admin_logout.php">Deconnexion</a>
                </div>
            </div>
        </nav>
      


    <div class="jumbotron" >
        <div class="row d-flex justify-content-center ">
            <div class="card col-md-3 mb-2 mr-sm-2">
                <img class="left-block img-responsive" src="../images/enseignant.jpeg"  alt="" />
                <div class="card-body d-flex flex-column">
                    <h5>Gestion des enseignants</h5>
                    <hr>
                    <ul class="list-group">
                        <li class="list-item ">Ajouter enseignant</li>
                        <li class="list-item">Modifier enseignant</li>
                        <li class="list-item">Supprimer enseignant</li>
                    </ul>
                    <hr>                
                    <a  href="gestion_enseignants.php" class="btn bg-success stretched-link d-flex justify-content-center mt-auto">Gérer</a>
                </div>    
            </div>
            
            
            <div class="card col-md-3 mb-2 mr-sm-2 ">
                <img class="left-block img-responsive" src="../images/etudiant.jpeg"  alt="" />
                <div class="card-body d-flex flex-column">
                        <h5>Gestion des etudiants</h5>
                        <hr>
                        <ul class="list-group">
                            <li class="list-item ">Ajouter etudiant</li>
                            <li class="list-item">Affecter étudiant</li>
                            <li class="list-item">Modifier étudiant</li>
                            <li class="list-item">Supprimer étudiant</li>
                        </ul>
                        <hr>
                    <a  href="gestion_etudiants.php"  class="btn bg-success stretched-link d-flex justify-content-center mt-auto">Gérer</a>
                </div>    
            </div>
            
            
            <div class="card col-md-3 mb-2 mr-sm-2">
                <img class="left-block img-responsive" src="../images/filiere.jpg"  alt="" />
                <div class="card-body d-flex flex-column">
                        <h5>Gestion des filiéres</h5>
                        <hr>
                        <ul class="list-group">
                            <li class="list-item ">Ajouter une filiére</li>
                            <li class="list-item">Affecter un chef de filiére</li>
                            <li class="list-item">Ajouter une année de formation</li>
                            <li class="list-item">Supprimer filiére</li>
                            <li class="list-item">Supprimer année de formation</li>
                            <li class="list-item">Gerer les etudiant par année de formation</li>

                        </ul>
                    <a  href="gestion_filieres.php"  class="btn bg-success stretched-link ">Gérer</a>
                </div>    
            </div>
        </div>
        
    </div>
                        
        
      
      

                <footer id="footer" class="d-flex justify-content-center mt-auto py-4 bg-dark text-white-50 ">
                    <div class="text-center">
                        <small>Copyright &copy; Abdelghani & Saad</small>
                    </div>
                </footer>
  </div>
  
                         
      
     
   </body>
   
</html>
