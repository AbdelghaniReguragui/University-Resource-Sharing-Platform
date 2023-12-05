<?php
   include('config.php');
   session_start();
   if(empty($_SESSION['enseignant'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: deconnexion.php');
  exit();
}

	if(isset($_SESSION['id_filiere'])){
		
		$id_filiere = $_SESSION['id_filiere'];
   
		$ses_sql = mysqli_query($link,"select * from filiere where id_filiere = '$id_filiere' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
						$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
   
		$nom_filiere = $row['nom_filiere'];
   
		$_SESSION['nom_filiere'] = $nom_filiere ;
		}
	}
   
   
   if(isset($_SESSION['id_af'])){
	   
		$id_af = $_SESSION['id_af'];
   
		$ses_sql = mysqli_query($link,"select * from annee_formation where id_af = '$id_af' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
				$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
   
		$nom_af = $row['nom_af'];
   
		$_SESSION['nom_af'] = $nom_af;
		}
   
   }
      
   
   if(isset($_SESSION['id_module'])){
	   
		$module = $_SESSION['id_module'];
   
		$ses_sql = mysqli_query($link,"select * from module where id_module = '$module' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
				$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
   
		$nom_module = $row['nom_module'];
   
		$_SESSION['nom_module'] = $nom_module ;
		}
   }
   
         
   
	if(isset($_SESSION['id_element_module'])){
		
		$element_module = $_SESSION['id_element_module'];
   
		$ses_sql = mysqli_query($link,"select * from element_module where id_element_module = '$element_module' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
		$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
   
            $nom_element_module = $row['nom_element_module'];
    
            $_SESSION['nom_element_module'] = $nom_element_module ;
        }
	}
   
   
   
   if(isset($_SESSION['enseignant'])){
	   
		$user_check = $_SESSION['enseignant'];
   
		$ses_sql = mysqli_query($link,"select * from enseignant where email = '$user_check' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
				$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
   
            $login_session = $row['email'];
    
            $nom_enseignant = $row['nom_enseignant'];
    
            $prenom_enseignant = $row['prenom_enseignant'];
    
            $id_enseignant = $row['id_enseignant'];
            $session_id=$id_enseignant;
            }
   }
   
   if(isset($_SESSION['id_em'])){
		
		$element_module = $_SESSION['id_em'];
   
		$ses_sql = mysqli_query($link,"select * from element_module where id_element_module = '$element_module' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
				$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
    
            $nom_element_module = $row['nom_element_module'];
    
            $_SESSION['nom_em'] = $nom_element_module ;
            
            $_SESSION['id_mod'] = $row['id_module']; 
        }
	}
   
   
   if(isset($_SESSION['id_mod'])){
		
		$module = $_SESSION['id_mod'];
   
		$ses_sql = mysqli_query($link,"select * from module where id_module = '$module' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
				$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
   
		$nom_module = $row['nom_module'];
   
		$_SESSION['nom_mod'] = $nom_module ;
		
		$id_af = $row['id_af'];
		
		$_SESSION['id_annee']=$id_af ;
		}
		
	}
	
	if(isset($_SESSION['id_annee'])){
		
		$af = $_SESSION['id_annee'];
   
		$ses_sql = mysqli_query($link,"select * from annee_formation where id_af = '$af' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
				$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
   
		$nom_af = $row['nom_af'];
   
		$_SESSION['nom_annee'] = $nom_af ;
		
		$id_f = $row['id_filiere'];
		
		$_SESSION['id_f'] = $id_f;
		}
	}
	
	if(isset($_SESSION['id_f'])){
		
		$filiere = $_SESSION['id_f'];
   
		$ses_sql = mysqli_query($link,"select * from filiere where id_filiere = '$filiere' ");
   
		$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
    		$count = mysqli_num_rows ($ses_sql);
        if ($count>0){
		$nom_filiere = $row['nom_filiere'];
   
		$_SESSION['nom_f'] = $nom_filiere ;
		}
	}
   
   
   
   if(!isset($_SESSION['enseignant'])){
      header("location:enseignant_login.php");
      die();
   }
?>
