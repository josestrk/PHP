<div>
    <ul class="create">
        <li><a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=erase&tp=usuario'; ?>><button class="root">usuario</button></a></li>
        <li><a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=erase&tp=lista'; ?>><button class="root">lista</button></a></li>
    </ul>
</div>
<?php
if(isset($_GET['tp'])){
    $tp=$_GET['tp'];
   if($tp=='usuario')
        echo '
    <div class="usuario">
        <form class="formLS" action="addUser.php" method = "POST">
            <div><h3>Nombre </h3></div><div><input name="name" type="text" style="margin:auto;" required /></div>
            <div><h3>Email </h3></div><div><input name="email" type="mail" style="margin:auto;" required /></div>
        </form>
    </div>';
    elseif($tp=='lista')
        echo '
    <div class="lista">
        <form class="formLS" action="addList.php" method = "POST">
            <div><h3>Nombre de lista</h3></div><div><input name="name" type="text" style="margin:auto;" required /></div>
        </form>
    </div>';
}
?>