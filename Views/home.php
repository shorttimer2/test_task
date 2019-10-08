<div class='row'>
<div class= 'col-md-6'>
<h4>Задачи</h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Имя</th>
      <th>е-mail</th>
      <th>Текст</th>
      <th>Статус</th>
    </tr>
  </thead>  
  <tbody class="tasktable">
  <?php 
  $count = 0;
  for($i=$count; $i < 3;$i++)
  {
      $count++;
      echo '<tr>
            <th scope="row">'. $count .'</th>';
      echo '<td>'. $result[$i]['name'] . '</td>';
      echo '<td>'. $result[$i]['email'] . '</td>';
      echo '<td>'. $result[$i]['message'] . '</td>';
      switch($result[$i]['status'])
      {
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
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php
    $totalpages++;
    for($i=1;$i < $totalpages;$i++)
    {
        if($i == $page)
            $active = 'active';
        else 
            $active = '';
        echo '<li class="page-item '. $active . '"><a class="page-link" href="/index.php?page='. $i .'">'. $i . '</a></li>';
    }

    ?>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
</div>
<div class="col-md-6">
<h4>Добавить задачу</h4>
<div class="row">
<div class="col-md-12">
<form action="home" method="POST" >
	 <label class="myform"><?php echo $labeltext['name'] ?></label>
	 <input class='inp' type="text" name="name" <?php if(!empty($_POST['name']))echo 'value=' . $_POST['name']?> />
	 <label class="myform"><?php echo $labeltext['email'] ?></label>
	 <input class='inp' type="text" name="email" <?php if(!empty($_POST['email']))echo 'value=' . $_POST['email']?> />
	 <label class="myform"><?php echo $labeltext['text'] ?></label>
	 <textarea class='inp text' rows="5" cols="45" name="text"><?php if(!empty($_POST['text']))echo  $_POST['text']?></textarea>
     <input type="submit" class="formsubmit" name="a" value="Добавить" />  
</form>
</div>  
</div>
</div>