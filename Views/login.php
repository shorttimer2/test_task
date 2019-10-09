<div class="row justify-content-center" style="margin-top:50px">
<div class="col-6  align-item-center">
<h4>Вход в систему</h4>
<form action="admin" method="POST" >
<label class="myform"><?php echo $labeltext['name'] ?></label>
	 <input class='inp' type="text" name="name" <?php if(!empty($_POST['name']))echo 'value=' . $_POST['name']?> />
	 <label class="myform"><?php echo $labeltext['pass'] ?></label>
	 <input class='inp' type="password" name="pass" />
     <input type="submit" class="formsubmit" name="lg" value="Войти" />  
</form>
<?php if($message != '') echo '<p>'.$message .'</p>'; ?>
</div>  
</div>