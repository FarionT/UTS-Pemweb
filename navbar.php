<nav class="navbar navbar-expand-lg" style="background-color:white">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
        <a data-aos="fade-right" data-aos-duration="1000" href="index.php" class="ms-5 navbar-brand logo"><img style="width: 190px; height: 50px;" src="img/logo.png"/></a>
        <ul class="navbar-nav me-auto my-lg-0 col-6 navScroll navbar-nav-scroll d-flex justify-content-between mx-auto" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
                <a href="index.php?kategori=all" aria-current="page" class=" nav-link nav-scroll h3 text-decoration-none mt-2 text-hover" style="color:#FFB800;font-weight:bold;">ALL</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=C" class=" nav-link text-decoration-none mt-2 text-hover"style="color:black;">C</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=PHP" class="nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">PHP</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Python" class= " nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Python</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Java" class=" nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Java</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Javascript" class="nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Javascript</a>
            </li>


        </ul>
        <div class="d-flex me-5">
            <div class="profile d-flex my-auto align-middle"  data-aos="fade-down" data-aos-duration="1000">
                <?php
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
                    <a data-aos="fade-right" data-aos-duration="1000" href="#" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover" data-bs-toggle="modal" data-bs-target="#modal_create">Create</a>
                <?php
                } else { ?>
                    <a data-aos="fade-right" data-aos-duration="1000" href="login.php" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover">Create</a>
                <?php
                }
                ?>
                <h2 class="">&nbsp;|&nbsp;</h2>
                <?php
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { 
                    $sqlprofile = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
                    $result = $db->query($sqlprofile);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                ?>
                    <a href="profile.php?id_user_profile=<?= $row['id'] ?>"><img class="align-middle rounded-circle " src=<?=$row['profile']?> style="width: 50px;"/></a>
                    <a  href="profile.php?id_user_profile=<?= $row['id'] ?>" class="align-middle h2 text-body text-decoration-none text-gradient"><?=$row['username']?></a>
                
                <?php
                } else {
                ?>
                    <a href="login.php" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover">Log In</a>
                <?php
                }
                ?>
                </div>
            </div>
        
        </div>
    </div>
    </nav>