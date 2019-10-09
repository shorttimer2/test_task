<div class='row'>
<div class= 'col-md-12 block'>
<h4>Задачи</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <?php 
      $namesort = 'n0';
      if($sort == $namesort)
          $namesort = 'n1';
      $emailsort = 'e0';
      if($sort == $emailsort)
          $emailsort = 'e1';
      $statussort = 's0';
      if($sort == $statussort)
          $statussort = 's1';
      ?>
      <th class="col-3"><a class="page-link" href="/index.php?page=<?= $page ?>&sort=<?= $namesort ?>">Имя</a></th>
      <th class="col-3"><a class="page-link" href="/index.php?page=<?= $page ?>&sort=<?= $emailsort ?>">е-mail</a></th>    
      <th class="col-3">Текст</th>
	  <th class="col-3"><a class="page-link" href="/index.php?page=<?= $page ?>&sort=<?= $statussort ?>">Статус</a></th>
    </tr>
  </thead>  
  <tbody class="tasktable">
  <?php 
  $count = 0;
  for($i=$count; $i < 3;$i++)
  {
      $count++;
      echo '<tr class="tline">
            <th scope="row">'. $count .'</th>';
      echo '<td>'. $result[$i]['name'] . '</td>';
      echo '<td>'. $result[$i]['email'] . '</td>';
      echo '<td>'. $result[$i]['message'] . '</td>';
      switch($result[$i]['status'])
      {
          case 0:
          echo '<td>Не выполнено</td>';
          break;
          case 1:
            echo '<td>Выполнено</td>';
          break;
          case 2: 
            echo '<td>Выполнено отредактировано администратором</td>';
          break;
          default:
            echo '<td></td>';
      }
      echo '</tr>';
  }
  ?>
  </tbody>
</table>

<nav aria-label="Page navigation">
  <ul class="pagination">
    
     <!--  <a class="page-link" href="#" aria-label="Previous"> -->
      <?php 

      if($page != 1)
      {
          $prevaddr = $page;
          $prevaddr--;
          echo'<li class="page-item">';
          echo  '<a class="page-link" href="/index.php?page='. $prevaddr .'&sort='.  $sort  .'" aria-label="Previous">';
          echo '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
      }

    $totalpages++;
    for($i=1;$i < $totalpages;$i++)
    {
        if($i == $page)
            $active = 'active';
        else 
            $active = '';
            echo '<li class="page-item '. $active . '"><a class="page-link" href="/index.php?page='. $i .'&sort='. $sort .'">'. $i . '</a></li>';
    }
    
    if($page != --$totalpages)
    {
        $nextaddr = $page;
        $nextaddr++;
        echo'<li class="page-item">';
        echo  '<a class="page-link" href="/index.php?page='. $nextaddr .'&sort='.  $sort  .'" aria-label="Next">';
        echo '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
    }
    
    
    ?>

  </ul>
</nav>
</div>
<div class="col-md-12 block">
<h4>Добавить задачу</h4>
<div class="row">
<div class="col-md-12" style="margin-top: 8px;">
<form action="home" method="POST" >
	 <label class="myform"><?php echo $labeltext['name'] ?></label>
	 <input class='inp' type="text" name="name" <?php if(!empty($_POST['name']))echo 'value=' . $_POST['name']?> />
	 <label class="myform"><?php echo $labeltext['email'] ?></label>
	 <input class='inp' type="text" name="email" <?php if(!empty($_POST['email']))echo 'value=' . $_POST['email']?> />
	 <label class="myform"><?php echo $labeltext['text'] ?></label>
	 <textarea class='inp text' rows="5" cols="45" name="text"><?php if(!empty($_POST['text']))echo  $_POST['text']?></textarea>
     <input type="submit" class="formsubmit" name="a" value="Добавить" />  
</form>
<?php if($message != '') echo '<p>'.$message .'</p>'; ?>
</div>  
</div>
</div>