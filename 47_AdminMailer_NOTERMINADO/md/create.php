<div>
    <ul class="create">
        <li><a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=create&tp=mensaje'; ?>><button class="root">Mensaje</button></a></li>
        <li><a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=create&tp=usuario'; ?>><button class="root">usuario</button></a></li>
        <li><a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=create&tp=lista'; ?>><button class="root">lista</button></a></li>
    </ul>
</div>
<?php
if(isset($_GET['tp'])){
    $tp=$_GET['tp'];
    if($tp=="mensaje")
    echo '
    <div class="mensaje">
    <form class="formLS" action="sender.php" method = "POST">
        <div><h3>Lista de suscriptores</h3></div><div><select name="list" style="margin:auto;width:100%" required>
        loadList();
        </select></div>
        <h3>Mensaje</h3><textarea name="ms" style="margin: 2px; width: 450px; height: 200px;resice:none; max-width:490px; min-width:490px;"></textarea>
        <div><input type="submit" value="Enviar" class="sb" style="width:300px" required /></div>
    </form>
    </div>';
    elseif($tp=='usuario')
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