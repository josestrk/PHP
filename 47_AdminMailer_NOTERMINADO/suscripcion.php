<div class="container">
    <?php
//Top Navigation
echo '<div style="display:block;text-align:left"><a href="' . $_SERVER['PHP_SELF'] . '" class="btn" >&lt;&lt Volver</a></div>';

echo '<div class="header">
	<h3>Suscripción</h3>	
  	</div>
    <center>
    <form class="formLS" action="' . $_SERVER['PHP_SELF'] . '" method = "POST">
    <div><span>Email:</span><input name="email" type="mail" style="margin:auto;" required /></div>
    <span>Subscribir a:</span><div>';

echo '<select name="list" multiple style="margin:auto;" required>';
echo '<option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>';
echo'</select></div>
<div><input type="submit" value=">>" class="sb" style="width:50px" required /></div>
</form>
    </div></center>';
    ?>
</div>